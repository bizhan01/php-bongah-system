<?php

namespace App\Exports\TrialBalance;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class BranchWise implements FromView
{

    protected $items;
    protected $extra;
    protected $search_by;


    public function __construct($branch_wise_ledger)
    {
        $this->items=$branch_wise_ledger['items'];
        $this->extra=$branch_wise_ledger['extra'];
        $this->search_by=$branch_wise_ledger['search_by'];

    }


    public function view(): View
    {
        return view('admin.accounts-report.trial-balance.branch-wise.exl', [
            'items' => $this->items,
            'extra' => $this->extra,
            'search_by' => $this->search_by,
        ]);
    }

}
