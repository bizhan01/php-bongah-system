<?php

namespace App\Http\Controllers\Reports\Accounts;

use App\Exports\Notes\LedgerGroupWise;
use App\Exports\Notes\LedgerTypeWise;
use App\IncomeExpenseGroup;
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


class NotesController extends Controller
{
    public function index()
    {
        return view('admin.accounts-report.notes.index');
    }

    public function type_wise(Request $request)
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
            'module_name' => 'Notes Type Wise Report',
            'voucher_type' => 'NOTES'
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
            return redirect()->route('reports.accounts.notes');
        }


        if ($request->income_expense_type_code > 0)
        {
            $IncomeExpenseTypes = IncomeExpenseType::where('code', $request->income_expense_type_code)
                ->get();

        }else{
            $IncomeExpenseTypes = IncomeExpenseType::orderBy('code','asc')
            ->get();
        }

        $Transactions = new Transaction();

        foreach ($IncomeExpenseTypes as $IncomeExpenseType) {

            $Balance[$IncomeExpenseType->name] = $Transactions->getBalanceByIncExpHeadTypeIdBranchesTwoDate(
                $IncomeExpenseType->id,
                $transaction_unique_branches,
                $request->start_from,
                $request->start_to,
                $request->end_from,
                $request->end_to
            );
            $income_expense_type_name =$IncomeExpenseType->name;


        }




        // Common items

        if ($request->branch_id == 0) {
            $branch_name = 'All Branch';
        } else {
            $branch_name = Branch::find($request->branch_id)->name;
        }


        if ($request->income_expense_type_code == 0) {
            $income_expense_type_name = 'All Ledger Type';
        }





        $start_from = date(config('settings.date_format'), strtotime($request->start_from));
        $start_to = date(config('settings.date_format'), strtotime($request->start_to));

        $end_from = date(config('settings.date_format'), strtotime($request->end_from));
        $end_to = date(config('settings.date_format'), strtotime($request->end_to));


        $search_by = array(
            'branch_name' => $branch_name,
            'branch_id' => $request->branch_id,
            'income_expense_type_name'=>$income_expense_type_name,
            'start_from' => $start_from,
            'start_to' => $start_to,

            'end_from' => $end_from,
            'end_to' => $end_to,
        );


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.notes.type-wise.index')
                ->with('particulars', $Balance)
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }


        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.accounts-report.notes.type-wise.pdf', [
                'particulars' => $Balance,
                'extra' => $extra,
                'search_by' => $search_by,

            ])
                ->setPaper('a4', 'landscape');

            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');

        }


        // Excel Action
        if ($request->action == 'Excel') {

            $BranchWise = new LedgerTypeWise([
                'particulars' => $Balance,
                'extra' => $extra,
                'search_by' => $search_by,
            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');

        }


    }


    public function group_wise(Request $request)
    {

        $request->validate([
            'end_from1' => 'required',
            'end_to1' => 'required',

            'start_from1' => 'required',
            'start_to1' => 'required',

        ]);


        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Ledger Group Wise Report',
            'voucher_type' => 'NOTES'
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
            return redirect()->route('reports.accounts.notes');
        }


        if ($request->income_expense_group_code > 0)
        {
            $IncomeExpenseGroups = IncomeExpenseGroup::where('code', $request->income_expense_group_code)
                ->get();

        }else{
            $IncomeExpenseGroups = IncomeExpenseGroup::orderBy('code','asc')
                ->get();
        }

        $Transactions = new Transaction();



        foreach ($IncomeExpenseGroups as $IncomeExpenseGroup) {

            $Balance[$IncomeExpenseGroup->name] = $Transactions->getBalanceByIncExpHeadGroupIdBranchesTwoDate(
                $IncomeExpenseGroup->id,
                $transaction_unique_branches,
                $request->start_from1,
                $request->start_to1,
                $request->end_from1,
                $request->end_to1
            );
            $income_expense_group_name =$IncomeExpenseGroup->name;


        }



        // Common items

        if ($request->branch_id == 0) {
            $branch_name = 'All Branch';
        } else {
            $branch_name = Branch::find($request->branch_id)->name;
        }


        if ($request->income_expense_group_code == 0) {
            $income_expense_group_name = 'All Ledger Group';
        }



        $start_from = date(config('settings.date_format'), strtotime($request->start_from1));
        $start_to = date(config('settings.date_format'), strtotime($request->start_to1));

        $end_from = date(config('settings.date_format'), strtotime($request->end_from1));
        $end_to = date(config('settings.date_format'), strtotime($request->end_to1));


        $search_by = array(
            'branch_name' => $branch_name,
            'branch_id' => $request->branch_id,
            'income_expense_group_name'=>$income_expense_group_name,
            'start_from' => $start_from,
            'start_to' => $start_to,

            'end_from' => $end_from,
            'end_to' => $end_to,
        );


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.notes.group-wise.index')
                ->with('particulars', $Balance)
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }


        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.accounts-report.notes.group-wise.pdf', [
                'particulars' => $Balance,
                'extra' => $extra,
                'search_by' => $search_by,

            ])
                ->setPaper('a4', 'landscape');

            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
             return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');

        }


        // Excel Action
        if ($request->action == 'Excel') {

            $BranchWise = new LedgerGroupWise([
                'particulars' => $Balance,
                'extra' => $extra,
                'search_by' => $search_by,
            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');

        }





    }


}
