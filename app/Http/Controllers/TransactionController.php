<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{

    public function getUniqueBranches($branch_id)
    {

        if ($branch_id > 0) {
            $transaction_unique_branches = DB::table('transaction_branch_view')
                ->where('branch_id', $branch_id)
                ->get();
        } else {
            $transaction_unique_branches = DB::table('transaction_branch_view')
                ->get();
        }

        return $transaction_unique_branches;

    }

    public function getUniqueBankCashes($bank_cash_id)
    {
        if ($bank_cash_id > 0) {
            $transaction_unique_bank_cashes = DB::table('transaction_bank_cash_view')
                ->where('bank_cash_id', $bank_cash_id)
                ->get();
        } else {
            $transaction_unique_bank_cashes = DB::table('transaction_bank_cash_view')
                ->get();
        }

        return $transaction_unique_bank_cashes;
    }

}
