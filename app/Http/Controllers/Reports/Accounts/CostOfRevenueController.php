<?php

namespace App\Http\Controllers\Reports\Accounts;

use App\Exports\CostOfRevenue\BranchWise;
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


class CostOfRevenueController extends Controller
{

    public function index()
    {
        return view('admin.accounts-report.cost-of-revenue.index');

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
            'module_name' => 'Cost Of Revenue Branch Wise Report',
            'voucher_type' => 'COST OF REVENUE BRANCH WISE REPORT'
        );


        if ($request->branch_id > 0) {
            $transaction_unique_branches = DB::table('transaction_branch_view')
                ->where('branch_id', $request->branch_id)
                ->get();
        } else {
            $transaction_unique_branches = DB::table('transaction_branch_view')
                ->get();
        }


        if (count($transaction_unique_branches) < 1) {
            Session::flash('error', "Item not found");
            return redirect()->route('reports.accounts.cost_of_revenue');
        }


        //  Income Expense
        //
        // Type Cost Of Revenue
        // Code  102 ( Construction Material Purchases)
        // Code  104 ( Construction Labour Expenses)
        // Code  114 ( Project Approval Expense)
        // Code  115 ( Other Expense )
        //

        $CostOfRevenueHeadTypes = IncomeExpenseType::whereIn('code', array(102, 104, 114, 115))
            ->orderBy('code', 'asc')
            ->get();

        $Transactions = new Transaction();

        foreach ($CostOfRevenueHeadTypes as $costOfRevenueHeadType) {
            $Balance[$costOfRevenueHeadType->id] = $Transactions->getBalanceByIncExpHeadTypeIdBranchesTwoDate(
                $costOfRevenueHeadType->id,
                $transaction_unique_branches,
                $request->start_from,
                $request->start_to,
                $request->end_from,
                $request->end_to
            );
        }


        $particulars = array(
            'OpeningConstructionMaterial' => 'Opening Construction Material',
            'ConstructionMaterialPurchases' => array(
                'id' => $CostOfRevenueHeadTypes[0]->id,
                'name' => $CostOfRevenueHeadTypes[0]->name,
                'code' => $CostOfRevenueHeadTypes[0]->code,
                'balance' => $Balance[$CostOfRevenueHeadTypes[0]->id]['balance'],
            ),
            'MaterialAvailableForUsed' => 'Material Available For Used',
            'ClosingConstructionMaterial' => 'Closing Construction Material',
            'MaterialUsedDuringThePeriod' => 'Material Used During the Period',
            'ConstructionLabourExpense' => array(
                'id' => $CostOfRevenueHeadTypes[1]->id,
                'name' => $CostOfRevenueHeadTypes[1]->name,
                'code' => $CostOfRevenueHeadTypes[1]->code,
                'balance' => $Balance[$CostOfRevenueHeadTypes[1]->id]['balance'],
            ),
            'ProjectApprovalExpenses' => array(
                'id' => $CostOfRevenueHeadTypes[2]->id,
                'name' => $CostOfRevenueHeadTypes[2]->name,
                'code' => $CostOfRevenueHeadTypes[2]->code,
                'balance' => $Balance[$CostOfRevenueHeadTypes[2]->id]['balance'],
            ),
            'OtherExpense' => array(
                'id' => $CostOfRevenueHeadTypes[3]->id,
                'name' => $CostOfRevenueHeadTypes[3]->name,
                'code' => $CostOfRevenueHeadTypes[3]->code,
                'balance' => $Balance[$CostOfRevenueHeadTypes[3]->id]['balance'],
            ),
            'TotalCostTransferredToWorkInProcess' => 'Total Cost Transferred to Work in Process',
            'OpeningWorkInProcess' => 'Opening Work in Process',
            'ClosingWorkInProcess' => 'Closing Work in Process',
            'CostOfRevenue' => 'Cost Of Revenue',
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


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.cost-of-revenue.branch-wise.index')
                ->with('particulars', $particulars)
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }


        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.accounts-report.cost-of-revenue.branch-wise.pdf', [
                'particulars' => $particulars,
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
                'particulars' => $particulars,
                'extra' => $extra,
                'search_by' => $search_by,

            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');

        }


    }

    public function get_cost_of_revenue($transaction_unique_branches, $start_from, $start_to, $end_from, $end_to)
    {

        //  Income Expense
        //
        // Type Cost Of Revenue
        // Code  102 ( Construction Material Purchases)
        // Code  104 ( Construction Labour Expenses)
        // Code  114 ( Project Approval Expense)
        // Code  115 ( Other Expense )
        //

        $CostOfRevenueHeadTypes = IncomeExpenseType::whereIn('code', array(102, 104, 114, 115))
            ->orderBy('code', 'asc')
            ->get();

        $Transactions = new Transaction();

        foreach ($CostOfRevenueHeadTypes as $costOfRevenueHeadType) {
            $Balances[$costOfRevenueHeadType->code] = $Transactions->getBalanceByIncExpHeadTypeIdBranchesTwoDate(
                $costOfRevenueHeadType->id,
                $transaction_unique_branches,
                $start_from,
                $start_to,
                $end_from,
                $end_to
            );
        }
        $total_start_balance=0;
        $total_end_balance=0;
        foreach ($Balances as $balance)
        {
            $total_start_balance +=$balance['balance']['start_balance'];
            $total_end_balance +=$balance['balance']['end_balance'];
        }
        $cost_of_revenue=array(
            'start_balance'=>$total_start_balance,
            'end_balance'=>$total_end_balance,
        );
        return $cost_of_revenue;
    }


}
