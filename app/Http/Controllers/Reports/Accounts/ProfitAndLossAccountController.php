<?php

namespace App\Http\Controllers\Reports\Accounts;

use App\Exports\ProfitOrLossAccount\BranchWise;
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


class ProfitAndLossAccountController extends Controller
{
    public function index()
    {

        return view('admin.accounts-report.profit-or-loss-account.index');


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
            'module_name' => 'Profit And Loss Account Branch Wise Report',
            'voucher_type' => 'PROFIT OR LOSS ACCOUNT'
        );

//        Get Profit Or Loss
        $ProfitOrLoss = $this->getProfitOrLoss(
            $request->branch_id,
            $request->start_from,
            $request->start_to,
            $request->end_from,
            $request->end_to);


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


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.profit-or-loss-account.branch-wise.index')
                ->with('particulars', $ProfitOrLoss['Particulars'])
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.accounts-report.profit-or-loss-account.branch-wise.pdf', [
                'particulars' => $ProfitOrLoss['Particulars'],
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
                'particulars' => $ProfitOrLoss['Particulars'],
                'extra' => $extra,
                'search_by' => $search_by,
            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');

        }



    }

    public function getProfitOrLoss($branch_id, $start_from, $start_to, $end_from, $end_to)
    {

        // Unique Branches or single
        $TransactionsController = new TransactionController();
        $transaction_unique_branches = $TransactionsController->getUniqueBranches($branch_id);


        //  Profit & Loss Account
        //
        // Code  105  ( Revenue )
        //
        //  Cost Of Revenue ( Get From Function get_cost_of_revenue )
        //
        // Gross Profit  ( Revenue - cost of revenue )
        //
        //
        // code  106  (Indirect Income)
        //
        // Income From Operation ( Gross Profit + Indirect Income )
        //
        // code 116  ( Administration Expenses )
        //
        // Income Before Tax & Interest ( Income From Operation - Administration Expenses )
        //
        // code 117 (Financial Expense)
        //
        // Income After Tax & Interest ( Income Before Tax & Interest -  Financial Expense)
        //
        //Provision & Tax Paid 0
        //
        //
        // Net Profit/ (Loss) ( Income After Tax & Interest )


        $CostOfRevenueHeadTypes = IncomeExpenseType::whereIn('code', array(105, 106, 116, 117))
            ->orderBy('code', 'asc')
            ->get();

        $Transactions = new Transaction();

        foreach ($CostOfRevenueHeadTypes as $costOfRevenueHeadType) {
            $Balance[$costOfRevenueHeadType->code] = $Transactions->getBalanceByIncExpHeadTypeIdBranchesTwoDate(
                $costOfRevenueHeadType->id,
                $transaction_unique_branches,
                $start_from,
                $start_to,
                $end_from,
                $end_to
            );
        }

//        Get Cost Of revenue
        $CostOfRevenueDetails = new CostOfRevenueController();
        $CostOfRevenue = $CostOfRevenueDetails->get_cost_of_revenue(
            $transaction_unique_branches,
            $start_from,
            $start_to,
            $end_from,
            $end_to
        );


        $Revenue = $Balance[$CostOfRevenueHeadTypes[0]->code]['balance'];

        $GrossProfit = array(
            'start_balance' => $Revenue['start_balance'] - $CostOfRevenue['start_balance'],
            'end_balance' => $Revenue['end_balance'] - $CostOfRevenue['end_balance'],
        );
        $IndirectIncome = $Balance[$CostOfRevenueHeadTypes[1]->code]['balance'];

        $IncomeFromOperation = array(
            'start_balance' => $GrossProfit['start_balance'] + $IndirectIncome['start_balance'],
            'end_balance' => $GrossProfit['end_balance'] + $IndirectIncome['end_balance'],
        );
        $AdministrationExpenses = $Balance[$CostOfRevenueHeadTypes[2]->code]['balance'];

        $IncomeBeforeTaxAndInterest = array(
            'start_balance' => $IncomeFromOperation['start_balance'] - $AdministrationExpenses['start_balance'],
            'end_balance' => $IncomeFromOperation['end_balance'] - $AdministrationExpenses['end_balance'],
        );
        $FinancialExpense = $Balance[$CostOfRevenueHeadTypes[3]->code]['balance'];

        $IncomeAfterTaxAndInterest = array(
            'start_balance' => $IncomeBeforeTaxAndInterest['start_balance'] - $FinancialExpense['start_balance'],
            'end_balance' => $IncomeBeforeTaxAndInterest['end_balance'] - $FinancialExpense['end_balance'],
        );

        $ProvisionAndTaxPaid = array(
            'start_balance' => 0,
            'end_balance' => 0,
        );

        $NetProfitOrLoss = $IncomeAfterTaxAndInterest;

        $particulars = array(
            'Revenue' => array(
                'name' => $CostOfRevenueHeadTypes[0]->name,
                'code' => $CostOfRevenueHeadTypes[0]->code,
                'balance' => $Revenue,
            ),
            'CostOfRevenue' => array(
                'name' => 'Cost Of Revenue',
                'code' => 'CostOfRevenue',
                'balance' => $CostOfRevenue,
            ),
            'GrossProfit' => array(
                'name' => 'Gross Profit',
                'code' => 'GrossProfit',
                'balance' => $GrossProfit,
            ),
            'IndirectIncome' => array(
                'name' => $CostOfRevenueHeadTypes[1]->name,
                'code' => $CostOfRevenueHeadTypes[1]->code,
                'balance' => $IndirectIncome,
            ),
            'IncomeFromOperation' => array(
                'name' => 'Income From Operation',
                'code' => 'IncomeFromOperation',
                'balance' => $IncomeFromOperation,
            ),
            'AdministrationExpenses' => array(
                'name' => $CostOfRevenueHeadTypes[2]->name,
                'code' => $CostOfRevenueHeadTypes[2]->code,
                'balance' => $AdministrationExpenses,
            ),
            'IncomeBeforeTaxAndInterest' => array(
                'name' => 'Income Before Tax And Interest',
                'code' => 'IncomeBeforeTaxAndInterest',
                'balance' => $IncomeBeforeTaxAndInterest,
            ),
            'FinancialExpense' => array(
                'name' => $CostOfRevenueHeadTypes[3]->name,
                'code' => $CostOfRevenueHeadTypes[3]->code,
                'balance' => $FinancialExpense,
            ),
            'IncomeAfterTaxAndInterest' => array(
                'name' => 'Income After Tax And Interest',
                'code' => 'IncomeAfterTaxAndInterest',
                'balance' => $IncomeAfterTaxAndInterest,
            ),
            'ProvisionAndTaxPaid' => array(
                'name' => 'Provision And Tax Paid',
                'code' => 'ProvisionAndTaxPaid',
                'balance' => $ProvisionAndTaxPaid,
            ),
            'NetProfitOrLoss' => array(
                'name' => 'Net Profit/ (Loss)',
                'code' => 'ProvisionAndTaxPaid',
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
