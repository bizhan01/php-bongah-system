<?php

namespace App\Exports\GeneralReport\Ledger;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Group implements FromView
{
    protected $items;
    protected $extra;
    protected $search_by;

    public function __construct($branch_wise)
    {
        $this->items=$branch_wise['items'];
        $this->extra=$branch_wise['extra'];
        $this->search_by=$branch_wise['search_by'];

    }


    public function view(): View
    {
        return view('admin.general-report.ledger.group.date-wise.exl', [
            'items' => $this->items,
            'extra' => $this->extra,
            'search_by' => $this->search_by,
        ]);
    }
}
