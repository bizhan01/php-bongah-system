<?php

namespace App\Exports\Notes;

use Maatwebsite\Excel\Concerns\FromCollection;


use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class LedgerGroupWise implements FromView
{

    protected $particulars;
    protected $extra;
    protected $search_by;
    protected $roles;


    public function __construct($type_wise)
    {
        $this->particulars=$type_wise['particulars'];
        $this->extra=$type_wise['extra'];
        $this->search_by=$type_wise['search_by'];

    }

    public function view(): View
    {
        return view('admin.accounts-report.notes.group-wise.exl', [
            'particulars' => $this->particulars,
            'extra' => $this->extra,
            'search_by' => $this->search_by
        ]);
    }


}
