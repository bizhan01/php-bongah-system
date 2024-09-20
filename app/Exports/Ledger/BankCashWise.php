<?php

namespace App\Exports\Ledger;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class BankCashWise implements FromView
{

    protected $items;
    protected $extra;
    protected $transaction_bank_cash_views;


    public function __construct($branch_wise_ledger)
    {
        $this->items=$branch_wise_ledger['items'];
        $this->extra=$branch_wise_ledger['extra'];
        $this->transaction_bank_cash_views=$branch_wise_ledger['transaction_bank_cash_views'];
    }


    public function view(): View
    {
        return view('admin.accounts-report.ledger.bank-cash-wise.exl', [
            'items' => $this->items,
            'extra' => $this->extra,
            'transaction_bank_cash_views' => $this->transaction_bank_cash_views,
        ]);
    }
}
