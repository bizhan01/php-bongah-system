<?php

namespace App\Exports\Ledger;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class IncomeExpenseHeadWise implements FromView
{

    protected $items;
    protected $extra;
    protected $transaction_income_expense_head_ids_names;


    public function __construct($branch_wise_ledger)
    {
        $this->items=$branch_wise_ledger['items'];
        $this->extra=$branch_wise_ledger['extra'];
        $this->transaction_income_expense_head_ids_names=$branch_wise_ledger['transaction_income_expense_head_ids_names'];
    }


    public function view(): View
    {
        return view('admin.accounts-report.ledger.income-expense-head-wise.exl', [
            'items' => $this->items,
            'extra' => $this->extra,
            'transaction_income_expense_head_ids_names' => $this->transaction_income_expense_head_ids_names,
        ]);
    }
}
