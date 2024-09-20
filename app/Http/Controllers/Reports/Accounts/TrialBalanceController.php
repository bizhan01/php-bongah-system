<?php

namespace App\Http\Controllers\Reports\Accounts;


use App\Exports\TrialBalance\BranchWise;
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


class TrialBalanceController extends Controller
{

    public function index()
    {

        return view('admin.accounts-report.trial-balance.index');

    }

    public function branch_wise(Request $request)
    {
        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');


        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Branch Wise Trial Balance Report',
            'voucher_type' => 'BRANCH WISE TRIAL BALANCE REPORT'
        );

        $transaction = new Transaction();
        $items = array();

        //  All null
        if ($request->branch_id == 0
            and $request->from == null and
            $request->to == null) {

            $Branches = DB::table('transaction_branch_view')
                ->orderBy('branch_id', 'asc')
                ->get();
            if (count($Branches) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }

            $items['branches'] = $Branches;
            foreach ($Branches as $branch) {
                $items['UniqueIncExpHeadDetails'][$branch->branch_id] = $transaction->GetUniqueIncomeExpenseHeadByBranch($branch->branch_id);
            }

            $UniqueBankCashes = DB::table('transaction_bank_cash_view')
                ->orderBy('bank_cash_id', 'asc')
                ->get();

            if (count($UniqueBankCashes) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }

            $items['bank_cashes'] = $UniqueBankCashes;

            foreach ($UniqueBankCashes as $uniqueBankCash) {
                $items['bank_cash_balance'][$uniqueBankCash->bank_cash_id] = $transaction->GetBankCashBalanceByBranchBankCashIdDate(null, $uniqueBankCash->bank_cash_id, null, null);
            }
        }

        //  branch_id has ( Date null )
        if ($request->branch_id > 0 and
            $request->from == null and
            $request->to == null) {

            $Branches = DB::table('transaction_branch_view')
                ->where('branch_id', $request->branch_id)
                ->orderBy('branch_id', 'asc')
                ->get();

            if (count($Branches) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }

            $items['branches'] = $Branches;
            foreach ($Branches as $branch) {
                $transaction = new Transaction();
                $items['UniqueIncExpHeadDetails'][$branch->branch_id] = $transaction->GetUniqueIncomeExpenseHeadByBranch($branch->branch_id);
            }

            $UniqueBankCashes = DB::select(DB::raw("
                SELECT DISTINCT transactions.bank_cash_id, bank_cashes.name
                FROM 
                transactions 
                INNER JOIN bank_cashes 
                ON transactions.bank_cash_id=bank_cashes.id
                WHERE transactions.branch_id =" . $request->branch_id . "
                AND transactions.deleted_at IS NULL
            "));

            if (count($UniqueBankCashes) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
            $items['bank_cashes'] = $UniqueBankCashes;

            foreach ($UniqueBankCashes as $uniqueBankCash) {
                $items['bank_cash_balance'][$uniqueBankCash->bank_cash_id] = $transaction->GetBankCashBalanceByBranchBankCashIdDate($request->branch_id, $uniqueBankCash->bank_cash_id, null, null);
            }
        }

        //  branch_id date wise has
        if ($request->branch_id > 0 and
            $request->from != null and
            $request->to != null) {

            $Branches = DB::table('transaction_branch_view')
                ->where('branch_id', $request->branch_id)
                ->orderBy('branch_id', 'asc')
                ->get();

            if (count($Branches) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }


            $items['branches'] = $Branches;
            foreach ($Branches as $branch) {
                $transaction = new Transaction();
                $items['UniqueIncExpHeadDetails'][$branch->branch_id] = $transaction->GetUniqueIncomeExpenseHeadByBranch( $branch->branch_id, date("Y-m-d", strtotime($request->from)),  date("Y-m-d", strtotime($request->to)));
            }

            $UniqueBankCashes = DB::select(DB::raw("
                SELECT DISTINCT transactions.bank_cash_id, bank_cashes.name
                FROM 
                transactions 
                INNER JOIN bank_cashes 
                ON transactions.bank_cash_id=bank_cashes.id
                WHERE transactions.branch_id =" . $request->branch_id . "
                AND transactions.voucher_date BETWEEN '" . date("Y-m-d", strtotime($request->from)) . "' and '" . date("Y-m-d", strtotime($request->to)) . "'
                AND transactions.deleted_at IS NULL
            "));

            if (count($UniqueBankCashes) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
            $items['bank_cashes'] = $UniqueBankCashes;

            foreach ($UniqueBankCashes as $uniqueBankCash) {
                $items['bank_cash_balance'][$uniqueBankCash->bank_cash_id] = $transaction->GetBankCashBalanceByBranchBankCashIdDate($request->branch_id, $uniqueBankCash->bank_cash_id, date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to)));
            }

        }


        //  All date wise has ( Branch null )
        if ($request->branch_id == 0 and
            $request->from != null and
            $request->to != null) {

            $Branches = DB::table('transaction_branch_view')
                ->orderBy('branch_id', 'asc')
                ->get();

            if (count($Branches) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }


            $items['branches'] = $Branches;
            foreach ($Branches as $branch) {
                $transaction = new Transaction();
                $items['UniqueIncExpHeadDetails'][$branch->branch_id] = $transaction->GetUniqueIncomeExpenseHeadByBranch( $branch->branch_id, date("Y-m-d", strtotime($request->from)),  date("Y-m-d", strtotime($request->to)));
            }

            $UniqueBankCashes = DB::select(DB::raw("
                SELECT DISTINCT transactions.bank_cash_id, bank_cashes.name
                FROM 
                transactions 
                INNER JOIN bank_cashes 
                ON transactions.bank_cash_id=bank_cashes.id
                WHERE transactions.voucher_date BETWEEN '" . date("Y-m-d", strtotime($request->from)) . "' and '" . date("Y-m-d", strtotime($request->to)) . "'
                AND transactions.deleted_at IS NULL
            "));

            if (count($UniqueBankCashes) == 0) {
                Session::flash('error', 'There Has No Transaction');
                return redirect()->back();
            }
            $items['bank_cashes'] = $UniqueBankCashes;

            foreach ($UniqueBankCashes as $uniqueBankCash) {
                $items['bank_cash_balance'][$uniqueBankCash->bank_cash_id] = $transaction->GetBankCashBalanceByBranchBankCashIdDate($request->branch_id, $uniqueBankCash->bank_cash_id, date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to)));
            }

        }




        // Common items

        if ($request->branch_id == 0) {
            $branch_name = null;
        } else {
            $branch_name = Branch::find($request->branch_id)->name;
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
            'branch_id' => $request->branch_id,
            'from' => $from,
            'to' => $to,
        );

        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.trial-balance.branch-wise.index')
                ->with('items', $items)
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.accounts-report.trial-balance.branch-wise.pdf', [
                'items' => $items,
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
                'items' => $items,
                'extra' => $extra,
                'search_by' => $search_by,
             ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');

        }



    }


}
