<?php

namespace App\Exports\Purchase;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PurchaseOrder implements FromView
{

    protected $infos;
    protected $extra;
    protected $search_by;
    protected $roles;
    protected $view_url;
    protected $branches;

    public function __construct($infos)
    {
        $this->infos = $infos['infos'];
        $this->extra = $infos['extra'];
        $this->search_by = $infos['search_by'];
        $this->view_url = $infos['view_url'];
        $this->branches = $infos['branches'];
    }


    public function view(): View
    {
        return view($this->view_url, [
            'infos' => $this->infos,
            'extra' => $this->extra,
            'search_by' => $this->search_by,
            'branches' => $this->branches,
        ]);
    }

}
