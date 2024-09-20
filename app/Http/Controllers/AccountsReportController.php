<?php

namespace App\Http\Controllers;

use App\BankCash;
use App\Branch;
use App\Exports\Ledger\BranchWiseLedger;
use App\Exports\Ledger\BankCashWise;
use App\Exports\Ledger\IncomeExpenseHeadWise;
use App\IncomeExpenseHead;
use App\Transaction;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\RoleManageController;
use App\Setting;
use Maatwebsite\Excel\Facades\Excel;


class AccountsReportController extends Controller
{

    public function ledger_index()
    {
        return view('admin.accounts-report.ledger.index');

    }

    public function ledger_branch_wise_report(Request $request)
    {

        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');


        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Branch Wise ledger Report',
            'voucher_type' => 'BRANCH WISE LEDGER REPORT'
        );

        //  All null
        if ($request->branch_id == 0 and $request->income_expense_head_id == 0
            and $request->from == null and $request->to == null) {

            $transactions = DB::table('transactions')
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }

        //  One Branch all null
        if ($request->branch_id > 0 and $request->income_expense_head_id == 0
            and $request->from == null and $request->to == null) {

            $transactions = DB::table('transactions')
                ->where('branch_id', $request->branch_id)
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        //  One Income Expense Head all null
        if ($request->branch_id == 0 and $request->income_expense_head_id > 0
            and $request->from == null and $request->to == null) {

            $transactions = DB::table('transactions')
                ->where('income_expense_head_id', $request->income_expense_head_id)
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }

        //  One from or to date all null
        if ($request->branch_id == 0 and $request->income_expense_head_id == 0
            and $request->from != null and $request->to != null) {


            $transactions = DB::table('transactions')
                ->where('deleted_at', null)
                ->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))))
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        //  One Branch and from date to date
        if ($request->branch_id > 0 and $request->income_expense_head_id == 0
            and $request->from != null and $request->to != null) {

            $transactions = DB::table('transactions')
                ->where('branch_id', $request->branch_id)
                ->where('deleted_at', null)
                ->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))))
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }

        //  One Income Expense Head and from date to date
        if ($request->branch_id == 0 and $request->income_expense_head_id > 0
            and $request->from != null and $request->to != null) {

            $transactions = DB::table('transactions')
                ->where('income_expense_head_id', $request->income_expense_head_id)
                ->where('deleted_at', null)
                ->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))))
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // One Branch and  One Income Expense Head Wise
        if ($request->branch_id > 0 and $request->income_expense_head_id > 0
            and $request->from == null and $request->to == null) {

            $transactions = DB::table('transactions')
                ->where('branch_id', $request->branch_id)
                ->where('income_expense_head_id', $request->income_expense_head_id)
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // One Branch, One Income Expense Head and from to date Wise
        if ($request->branch_id > 0 and $request->income_expense_head_id > 0
            and $request->from != null and $request->to != null) {

            $transactions = DB::table('transactions')
                ->where('branch_id', $request->branch_id)
                ->where('income_expense_head_id', $request->income_expense_head_id)
                ->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))))
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        /// Common Item for all ledger

        $id = 0;
        foreach ($transactions as $transaction) {
            if ($id == $transaction->branch_id) continue;
            $branch_ids[] = $id = $transaction->branch_id;
        }

        if ($request->branch_id == 0) {
            $branch_name = null;
        } else {
            $branch_name = Branch::find($request->branch_id)->name;
        }

        if ($request->income_expense_head_id == 0) {
            $income_expense_head_name = null;
        } else {
            $income_expense_head_name = IncomeExpenseHead::find($request->income_expense_head_id)->name;
        }

        if ($request->from == null) {
            $from = null;
        } else {
            $from = date(config('settings.date_format'), strtotime($request->from));
        }

        if ($request->to == null) {
            $to = null;
        } else {
            $to = date(config('settings.date_format'), strtotime($request->to));
        }

        $search_by = array(
            'branch_name' => $branch_name,
            'income_expense_head_name' => $income_expense_head_name,
            'from' => $from,
            'to' => $to,
        );

//        Show Action

        if ($request->action == 'Show') {
            return view('admin.accounts-report.ledger.branch-wise.index')
                ->with('items', $transactions)
                ->with('extra', $extra)
                ->with('branch_ids', $branch_ids)
                ->with('search_by', $search_by);
        }

//        Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.accounts-report.ledger.branch-wise.pdf', [
                'items' => $transactions,
                'extra' => $extra,
                'branch_ids' => $branch_ids,
                'search_by' => $search_by,
            ])
                ->setPaper('a4', 'landscape');

            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');

        }

        //  Exl Action

        if ($request->action == 'Excel') {

            $BranchWise = new BranchWiseLedger([
                'items' => $transactions,
                'extra' => $extra,
                'branch_ids' => $branch_ids,
            ]);
            return Excel::download($BranchWise, date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.xlsx');
        }


    }


    public function ledger_income_expense_head_wise_report(Request $request)
    {

        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');


        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Income Expense Head Wise ledger Report',
            'voucher_type' => 'LEDGER WISE REPORT'
        );


        //  ( All null )
        if ($request->income_expense_head_id == 0 and $request->branch_id == 0
            and $request->from == null and $request->to == null) {

            $transactions = DB::table('transactions')
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_income_expense_head_ids_names = DB::table('transaction_income_expense_head_ids_view')
                ->get();


            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // income_expense_head_id has but ( from to date branch id null )
        if ($request->income_expense_head_id > 0 and $request->branch_id == 0
            and $request->from == null and $request->to == null) {

            $transactions = DB::table('transactions')
                ->where('income_expense_head_id', $request->income_expense_head_id)
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_income_expense_head_ids_names = DB::table('transaction_income_expense_head_ids_view')
                ->where('income_expense_head_id', $request->income_expense_head_id)
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // Branch Id has but ( Income Expense head and from to date null )
        if ($request->income_expense_head_id == 0 and $request->branch_id > 0
            and $request->from == null and $request->to == null) {

            $transactions = DB::table('transactions')
                ->where('branch_id', $request->branch_id)
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_income_expense_head_ids_names = DB::table('transaction_income_expense_head_ids_view')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // from to date has but ( income expense head and branch id null )
        if ($request->income_expense_head_id == 0 and $request->branch_id == 0
            and $request->from != null and $request->to != null) {

            $transactions = DB::table('transactions')
                ->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))))
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_income_expense_head_ids_names = DB::table('transaction_income_expense_head_ids_view')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // All Has
        if ($request->income_expense_head_id > 0 and $request->branch_id > 0
            and $request->from != null and $request->to != null) {

            $transactions = DB::table('transactions')
                ->where('income_expense_head_id', $request->income_expense_head_id)
                ->where('branch_id', $request->branch_id)
                ->where('deleted_at', null)
                ->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))))
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_income_expense_head_ids_names = DB::table('transaction_income_expense_head_ids_view')
                ->where('income_expense_head_id', $request->income_expense_head_id)
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // (from to date null) and all has
        if ($request->income_expense_head_id > 0 and $request->branch_id > 0
            and $request->from == null and $request->to == null) {

            $transactions = DB::table('transactions')
                ->where('income_expense_head_id', $request->income_expense_head_id)
                ->where('branch_id', $request->branch_id)
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_income_expense_head_ids_names = DB::table('transaction_income_expense_head_ids_view')
                ->where('income_expense_head_id', $request->income_expense_head_id)
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // from to date and income Expense head has (branch id null)
        if ($request->income_expense_head_id > 0 and $request->branch_id == 0
            and $request->from != null and $request->to != null) {

            $transactions = DB::table('transactions')
                ->where('income_expense_head_id', $request->income_expense_head_id)
                ->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))))
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_income_expense_head_ids_names = DB::table('transaction_income_expense_head_ids_view')
                ->where('income_expense_head_id', $request->income_expense_head_id)
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }

        // Branch id and from to date has (income expense head null)
        if ($request->income_expense_head_id == 0 and $request->branch_id > 0
            and $request->from != null and $request->to != null) {


            $transactions = DB::table('transactions')
                ->where('branch_id', $request->branch_id)
                ->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))))
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_income_expense_head_ids_names = DB::table('transaction_income_expense_head_ids_view')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        /// Common Item for all ledger
        if ($request->branch_id == 0) {
            $branch_name = null;
        } else {
            $branch_name = Branch::find($request->branch_id)->name;
        }

        if ($request->income_expense_head_id == 0) {
            $income_expense_head_name = null;
        } else {
            $income_expense_head_name = IncomeExpenseHead::find($request->income_expense_head_id)->name;
        }

        if ($request->from == null) {
            $from = null;
        } else {
            $from = date(config('settings.date_format'), strtotime($request->from));
        }

        if ($request->to == null) {
            $to = null;
        } else {
            $to = date(config('settings.date_format'), strtotime($request->to));
        }

        $search_by = array(
            'branch_name' => $branch_name,
            'income_expense_head_name' => $income_expense_head_name,
            'from' => $from,
            'to' => $to,
        );


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.ledger.income-expense-head-wise.index')
                ->with('items', $transactions)
                ->with('transaction_income_expense_head_ids_names', $transaction_income_expense_head_ids_names)
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.accounts-report.ledger.income-expense-head-wise.pdf', [
                'items' => $transactions,
                'extra' => $extra,
                'transaction_income_expense_head_ids_names' => $transaction_income_expense_head_ids_names,
                'search_by' => $search_by,
            ])
                ->setPaper('a4', 'landscape');

            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
        }

        // Excel Action
        if ($request->action == 'Excel') {

            $IncomeExpenseHeadWise = new IncomeExpenseHeadWise([
                'items' => $transactions,
                'extra' => $extra,
                'transaction_income_expense_head_ids_names' => $transaction_income_expense_head_ids_names,
            ]);
            return Excel::download($IncomeExpenseHeadWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');

        }

    }

    public function ledger_bank_cash_wise_report(Request $request)
    {

        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');


        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Bank Cash Wise ledger Report',
            'voucher_type' => 'BANK CASH WISE LEDGER REPORT'
        );


//  ( All null )
        if ($request->bank_cash_id == 0 and $request->branch_id == 0
            and $request->from == null and $request->to == null) {

            $transactions = DB::table('transactions')
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_bank_cash_view = DB::table('transaction_bank_cash_view')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // bank_cash_id has but ( from to date branch id null )
        if ($request->bank_cash_id > 0 and $request->branch_id == 0
            and $request->from == null and $request->to == null) {

            $transactions = DB::table('transactions')
                ->where('bank_cash_id', $request->bank_cash_id)
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_bank_cash_view = DB::table('transaction_bank_cash_view')
                ->where('bank_cash_id', $request->bank_cash_id)
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // Branch Id has but ( Income Expense head and from to date null )
        if ($request->bank_cash_id == 0 and $request->branch_id > 0
            and $request->from == null and $request->to == null) {

            $transactions = DB::table('transactions')
                ->where('branch_id', $request->branch_id)
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();
            $transaction_bank_cash_view = DB::table('transaction_bank_cash_view')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // from to date has but ( income expense head and branch id null )
        if ($request->bank_cash_id == 0 and $request->branch_id == 0
            and $request->from != null and $request->to != null) {

            $transactions = DB::table('transactions')
                ->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))))
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();
            $transaction_bank_cash_view = DB::table('transaction_bank_cash_view')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // All Has
        if ($request->bank_cash_id > 0 and $request->branch_id > 0
            and $request->from != null and $request->to != null) {

            $transactions = DB::table('transactions')
                ->where('bank_cash_id', $request->bank_cash_id)
                ->where('branch_id', $request->branch_id)
                ->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))))
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_bank_cash_view = DB::table('transaction_bank_cash_view')
                ->where('bank_cash_id', $request->bank_cash_id)
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // (from to date null) and all has
        if ($request->bank_cash_id > 0 and $request->branch_id > 0
            and $request->from == null and $request->to == null) {

            $transactions = DB::table('transactions')
                ->where('bank_cash_id', $request->bank_cash_id)
                ->where('branch_id', $request->branch_id)
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_bank_cash_view = DB::table('transaction_bank_cash_view')
                ->where('bank_cash_id', $request->bank_cash_id)
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        // from to date and income Expense head has (branch id null)
        if ($request->bank_cash_id > 0 and $request->branch_id == 0
            and $request->from != null and $request->to != null) {

            $transactions = DB::table('transactions')
                ->where('bank_cash_id', $request->bank_cash_id)
                ->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))))
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_bank_cash_view = DB::table('transaction_bank_cash_view')
                ->where('bank_cash_id', $request->bank_cash_id)
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }

        // Branch id and from to date has (income expense head null)
        if ($request->bank_cash_id == 0 and $request->branch_id > 0
            and $request->from != null and $request->to != null) {


            $transactions = DB::table('transactions')
                ->where('branch_id', $request->branch_id)
                ->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))))
                ->where('deleted_at', null)
                ->orderBy('branch_id', 'asc')
                ->orderBy('voucher_date', 'asc')
                ->get();

            $transaction_bank_cash_view = DB::table('transaction_bank_cash_view')
                ->get();

            if (count($transactions) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
        }


        /// Common Item for all ledger
        if ($request->branch_id == 0) {
            $branch_name = null;
        } else {
            $branch_name = Branch::find($request->branch_id)->name;
        }

        if ($request->bank_cash_id == 0) {
            $bank_cash_name = null;
        } else {
            $bank_cash_name = BankCash::find($request->bank_cash_id)->name;
        }

        if ($request->from == null) {
            $from = null;
        } else {
            $from = date(config('settings.date_format'), strtotime($request->from));
        }

        if ($request->to == null) {
            $to = null;
        } else {
            $to = date(config('settings.date_format'), strtotime($request->to));
        }

        $search_by = array(
            'branch_name' => $branch_name,
            'bank_cash_name' => $bank_cash_name,
            'from' => $from,
            'to' => $to,
        );


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.ledger.bank-cash-wise.index')
                ->with('items', $transactions)
                ->with('transaction_bank_cash_views', $transaction_bank_cash_view)
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.accounts-report.ledger.bank-cash-wise.pdf', [
                'items' => $transactions,
                'extra' => $extra,
                'transaction_bank_cash_views' => $transaction_bank_cash_view,
                'search_by' => $search_by,
            ])
                ->setPaper('a4', 'landscape');

            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
        }

        // Excel Action
        if ($request->action == 'Excel') {

            $BankCashWise = new BankCashWise([
                'items' => $transactions,
                'extra' => $extra,
                'transaction_bank_cash_views' => $transaction_bank_cash_view,
            ]);
            return Excel::download($BankCashWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');

        }

    }


    public function getBankCashBalance($unique_branches, $start_from, $start_to, $end_from, $end_to)
    {

        $TransactionController = new TransactionController();
        $unique_bank_cashes = $TransactionController->getUniqueBankCashes(0);

        $TransactionModel = new Transaction();

        $start_balance = 0;
        $end_balance = 0;
        $bankCashesBalanceStart = array();
        $bankCashesBalanceEnd = array();


        foreach ($unique_branches as $branch) {
            foreach ($unique_bank_cashes as $unique_bank_cash) {

                $start_balance += $startBalance = $TransactionModel->GetBankCashBalanceByBranchBankCashIdDate($branch->branch_id, $unique_bank_cash->bank_cash_id, $start_from, $start_to);
                $end_balance += $endBalance = $TransactionModel->GetBankCashBalanceByBranchBankCashIdDate($branch->branch_id, $unique_bank_cash->bank_cash_id, $end_from, $end_to);

                if (array_key_exists($unique_bank_cash->name, $bankCashesBalanceStart)) {
                    $bankCashesBalanceStart[$unique_bank_cash->name] += $startBalance;
                } else {
                    $bankCashesBalanceStart[$unique_bank_cash->name] = $startBalance;
                }

                if (array_key_exists($unique_bank_cash->name, $bankCashesBalanceEnd)) {
                    $bankCashesBalanceEnd[$unique_bank_cash->name] += $endBalance;
                } else {
                    $bankCashesBalanceEnd[$unique_bank_cash->name] = $endBalance;
                }
            }
        }

        $balance = array(
            'balance' => array(
                'start_balance' => $start_balance,
                'end_balance' => $end_balance
            ),
            'BankCashDetails' => array(
                'StartDate' => $bankCashesBalanceStart,
                'EndDate' => $bankCashesBalanceEnd,
                'TotalBalance' => array(
                    'start_balance' => $start_balance,
                    'end_balance' => $end_balance
                ),
            )
        );
        return $balance;


    }


}
