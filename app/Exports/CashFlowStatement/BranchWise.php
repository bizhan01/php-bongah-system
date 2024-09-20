<?php

namespace App\Exports\CashFlowStatement;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class BranchWise implements FromView
{
    protected $particulars;
    protected $extra;
    protected $search_by;


    public function __construct($branch_wise)
    {
        $this->particulars=$branch_wise['particulars'];
        $this->extra=$branch_wise['extra'];
        $this->search_by=$branch_wise['search_by'];

    }


    public function view(): View
    {
        return view('admin.accounts-report.cash-flow.branch-wise.exl', [
            'particulars' => $this->particulars,
            'extra' => $this->extra,
            'search_by' => $this->search_by,
        ]);
    }
}
