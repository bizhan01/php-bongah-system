<?php

namespace App\Http\Controllers\Reports\Accounts;

use App\Exports\FixedAssetSchedule\BranchWise;
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


class FixedAssetScheduleController extends Controller
{
    public function index()
    {
        return view('admin.accounts-report.fixed-asset-schedule.index');
    }


    public function branch_wise(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);

        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Fixed Assets Schedule Branch Wise Report',
            'voucher_type' => 'FIXED ASSETS SCHEDULE'
        );

        // Common items

        if ($request->branch_id == 0) {
            $branch_name = 'All Branch';
        } else {
            $branch_name = Branch::find($request->branch_id)->name;
        }

        $from = date(config('settings.date_format'), strtotime($request->from));
        $to = date(config('settings.date_format'), strtotime($request->to));

        $search_by = array(
            'branch_name' => $branch_name,
            'branch_id' => $request->branch_id,
            'from' => $from,
            'to' => $to,
        );

        $FixedAssetSchedule = $this->getFixedAssetSchedule($request->branch_id, $from, $to);


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.fixed-asset-schedule.branch-wise.index')
                ->with('particulars', $FixedAssetSchedule )
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.accounts-report.fixed-asset-schedule.branch-wise.pdf', [
                'particulars' => $FixedAssetSchedule,
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
                'particulars' => $FixedAssetSchedule,
                'extra' => $extra,
                'search_by' => $search_by,

            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');

        }

    }


    public function getFixedAssetSchedule($Branch_id, $from, $to)
    {

//        Get Fixed Asset Schedule Starting date from global varibable setting system

        $FixedAssetScheduleStartingDate = date('Y-m-d', strtotime(config('settings.fixed_asset_schedule_starting_date')));

        // Property, Plant & Equipment Code 119
        $TransactionsModel = new Transaction();
        $TransactionsController = new TransactionController();
        $uniqueBranches = $TransactionsController->getUniqueBranches($Branch_id);

        $CostOfRevenueHeadTypes = IncomeExpenseType::whereIn('code', array(119))
            ->orderBy('code', 'asc')
            ->get();


        foreach ($CostOfRevenueHeadTypes as $costOfRevenueHeadType) {
            $FixedAssetDetails[$costOfRevenueHeadType->code] = $TransactionsModel->getBalanceByIncExpHeadTypeIdBranchesTwoDate($costOfRevenueHeadType->id, $uniqueBranches, $FixedAssetScheduleStartingDate, $from, $FixedAssetScheduleStartingDate, $to);
        }

        return $FixedAssetDetails[119]['headDetails'];


    }


}
