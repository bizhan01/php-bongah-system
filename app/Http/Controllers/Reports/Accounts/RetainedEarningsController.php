<?php

namespace App\Http\Controllers\Reports\Accounts;

use App\Exports\RetainedEarnings\BranchWise;
use App\Http\Controllers\TransactionController;
use App\IncomeExpenseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Branch;
use App\IncomeExpenseHead;
use App\BankCash;
use App\Transaction;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\RoleManageController;
use App\Setting;
use Maatwebsite\Excel\Facades\Excel;


class RetainedEarningsController extends Controller
{
    public function index()
    {
        return view('admin.accounts-report.retained-earnings.index');

    }

    public function branch_wise(Request $request)
    {
        $request->validate([
            'end_from' => 'required',
            'end_to' => 'required',

            'start_from' => 'required',
            'start_to' => 'required',

        ]);

        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Retained Earnings Branch Wise Report',
            'voucher_type' => 'RETAINED EARNINGS'
        );


        // Common items

        if ($request->branch_id == 0) {
            $branch_name = 'All Branch';
        } else {
            $branch_name = Branch::find($request->branch_id)->name;
        }


        $start_from = date(config('settings.date_format'), strtotime($request->start_from));
        $start_to = date(config('settings.date_format'), strtotime($request->start_to));

        $end_from = date(config('settings.date_format'), strtotime($request->end_from));
        $end_to = date(config('settings.date_format'), strtotime($request->end_to));


        $search_by = array(
            'branch_name' => $branch_name,
            'branch_id' => $request->branch_id,
            'start_from' => $start_from,
            'start_to' => $start_to,

            'end_from' => $end_from,
            'end_to' => $end_to,
        );

        $RetainedEarnings = $this->getRetainedEarnings($request->branch_id, $request->start_from, $request->start_to, $request->end_from, $request->end_to);

        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.retained-earnings.branch-wise.index')
                ->with('particulars', $RetainedEarnings['Particulars'])
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.accounts-report.retained-earnings.branch-wise.pdf', [
                'particulars' => $RetainedEarnings['Particulars'],
                'extra' => $extra,
                'search_by' => $search_by,
            ])
                ->setPaper('a4', 'landscape');

            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');

        }

        // Excel Action
        if ($request->action == 'Excel') {

            $BranchWise = new BranchWise([
                'particulars' => $RetainedEarnings['Particulars'],
                'extra' => $extra,
                'search_by' => $search_by,
            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');

        }

    }


    public function getRetainedEarnings($branch_id, $start_from, $start_to, $end_from, $end_to)
    {


        //  Retained Earnings
        //
        //  Net Profit And Loss Previous Year ( Right hand Start Company date  To $end_from date
        //  Left Hand Net Profit and loss Right side
        // )
        //
        //  Net Profit And Loss During The Year ( getProfitOrLoss Function )
        //
        //  Dividend ( Balance from IncomeExpenseHeadType code 122 )
        //
        //  Net Profit and (Loss)  ( Net Profit And Loss Previous Year + Net Profit And Loss During The Year - Dividend)

        $CompanyStartingDate = config('settings.fixed_asset_schedule_starting_date');


        $date_start_from = new \DateTime($start_from);
        $start_from_date_minus_12_modify = $date_start_from->modify("-12 months"); // Last day 12 months ago
        $start_from_minus_12 = $start_from_date_minus_12_modify->format('Y-m-d');


        $date_end_from = new \DateTime($end_from);
        $end_from_date_minus_12_modify = $date_end_from->modify("-12 months"); // Last day 12 months ago
        $end_from_minus_12 = $end_from_date_minus_12_modify->format('Y-m-d');


        $ProfitOrLoss = new ProfitAndLossAccountController();

//        Net Profit And Loss Previous Year Right side

        $NetProfitAndLossPreviousYearRight = $ProfitOrLoss->getProfitOrLoss(
            $branch_id,
            $CompanyStartingDate,
            $end_from,
            $CompanyStartingDate,
            $end_from);


//        Net Profit And Loss During The Year
        $NetProfitAndLossDuringTheYear = $ProfitOrLoss->getProfitOrLoss(
            $branch_id,
            $start_from,
            $start_to,
            $end_from,
            $end_to);


        // Dividend  IncomeExpenseHeadType Code 122

        $TransactionsModel = new Transaction();
        $TransactionsController = new TransactionController();
        $uniqueBranches = $TransactionsController->getUniqueBranches($branch_id);
        $CostOfRevenueHeadTypes = IncomeExpenseType::whereIn('code', array(122))
            ->orderBy('code', 'asc')
            ->get();

        foreach ($CostOfRevenueHeadTypes as $costOfRevenueHeadType) {
            $DividendBalances[$costOfRevenueHeadType->code] = $TransactionsModel->getBalanceByIncExpHeadTypeIdBranchesTwoDate($costOfRevenueHeadType->id, $uniqueBranches, $start_from, $start_to, $end_from, $end_to);
        }


        $DividendBalance = $DividendBalances[$CostOfRevenueHeadTypes[0]->code]['balance'];


        $NetProfitOrLossPreviousYearRightSideBalance = $NetProfitAndLossPreviousYearRight['NetProfitOrLoss']['end_balance'];

        $rightSideProfitAndLoss= $NetProfitOrLossPreviousYearRightSideBalance + $NetProfitAndLossDuringTheYear['NetProfitOrLoss']['end_balance'] - $DividendBalance['end_balance'];

        $NetProfitOrLoss = array(
            'start_balance' => ( $rightSideProfitAndLoss + $NetProfitAndLossDuringTheYear['NetProfitOrLoss']['start_balance'] - $DividendBalance['start_balance']),
            'end_balance' => $rightSideProfitAndLoss,
        );

        $particulars = array(
            'NetProfitAndLossPreviousYear' => array(
                'name' => 'Net Profit And Loss Previous Year',
                'code' => 'NetProfitAndLossPreviousYear',
                'balance' => array(
                    'start_balance' => $NetProfitOrLoss['end_balance'],
                    'end_balance' => $NetProfitOrLossPreviousYearRightSideBalance
                ),
            ),
            'NetProfitAndLossDuringTheYear' => array(
                'name' => 'Net Profit And Loss During The Year',
                'code' => 'NetProfitAndLossDuringTheYear',
                'balance' => $NetProfitAndLossDuringTheYear['NetProfitOrLoss'],
            ),
            'DividendPaid' => array(
                'name' => $CostOfRevenueHeadTypes[0]->name,
                'code' => $CostOfRevenueHeadTypes[0]->code,
                'balance' => $DividendBalance,
            ),
            'NetProfitOrLoss' => array(
                'name' => 'Net Profit And (Loss)',
                'code' => 'NetProfitLoss',
                'balance' => $NetProfitOrLoss,
            ),

        );

        $data = array(
            'Particulars' => $particulars,
            'NetProfitOrLoss' => $NetProfitOrLoss,
        );

        return $data;
    }


}
