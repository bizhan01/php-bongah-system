<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\RoleManageController;
use App\Setting;
use App\Transaction;
use Illuminate\Support\Facades\DB;

class InitialBankCashBalanceController extends Controller
{


//    Important properties
    public $parentModel = Transaction::class;
    public $parentRoute = 'initial_bank_cash_balance';
    public $parentView = "admin.initial-bank-cash-balance";


    public $voucher_type = "IBCBV";


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = $this->parentModel::where('voucher_type', $this->voucher_type)->orderBy('id', 'desc')->paginate(60);
        return view($this->parentView . '.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->parentView . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|numeric|min:1',
            'bank_cash_id' => 'required|numeric|min:1',
            'amount' => 'required',
            'voucher_date' => 'required',
        ]);

        $initial_exist_or_not = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->withTrashed()
            ->where('branch_id', '=', $request->branch_id)
            ->withTrashed()
            ->where('bank_cash_id', '=', $request->bank_cash_id)
            ->withTrashed()
            ->get();

        if (count($initial_exist_or_not) > 0) {
            Session::flash('error', "This Branch, Bank Cash Initial Balance already exit. Try another one");
            return redirect()->back();
        }

        $date = new \DateTime($request->voucher_date);
        $voucher_date = $date->format('Y-m-d'); // 31-07-2012 '2008-11-11'

        $voucher_info = $this->parentModel::where('voucher_type', $this->voucher_type)
            ->withTrashed()
            ->orderBy('voucher_no', 'dsc')
            ->get()
            ->first();

        if (!empty($voucher_info)) {
            $voucher_no = $voucher_info->voucher_no + 1;
        } else {
            $voucher_no = 1;
        }

        $this->parentModel::create([
            'voucher_no' => $voucher_no,
            'branch_id' => $request->branch_id,
            'bank_cash_id' => $request->bank_cash_id,
            'cheque_number' => $request->cheque_number,
            'voucher_type' => $this->voucher_type,
            'voucher_date' => $voucher_date,
            'particulars' => $request->particulars,

            'cr' => $request->amount,
            'created_by' => \Auth::user()->email,

        ]);
        Session::flash('success', "Successfully  Create");
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        //$item = $this->parentModel::find($request->id);
        $id = $request->id;
        $item = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->where(function ($q) use ($id) {
                $q->where('voucher_no', '=', $id);
            })
            ->get();

        if (count($item) < 1) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
        return view($this->parentView . '.show')->with('items', $item);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->where(function ($q) use ($id) {
                $q->where('voucher_no', '=', $id);
            })
            ->get()->first();

        if (empty($items)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }

        $date = new \DateTime($items->voucher_date);
        $voucher_date = $date->format('m/d/Y'); // 31-07-2012 '2008-11-11'


        return view($this->parentView . '.edit')->with('item', $items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'branch_id' => 'required|numeric|min:1',
            'bank_cash_id' => 'required|numeric|min:1',
            'amount' => 'required',
            'voucher_date' => 'required',
        ]);

        $date = new \DateTime($request->voucher_date);
        $voucher_date = $date->format('Y-m-d'); // 31-07-2012 '2008-11-11'

        $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->where(function ($q) use ($id) {
                $q->where('voucher_no', '=', $id);
            })
            ->get()->first();

        if (!(($request->branch_id == $items->branch_id) and ($request->bank_cash_id == $items->bank_cash_id))) {
            $initial_exist_or_not = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
                ->withTrashed()
                ->where('branch_id', '=', $request->branch_id)
                ->where('bank_cash_id', '=', $request->bank_cash_id)
                ->withTrashed()
                ->get();
            if (count($initial_exist_or_not) > 0) {
                Session::flash('error', "This Branch, Bank Cash Initial Balance already exit. Try another one");
                return redirect()->back();
            }
        }

        $items->branch_id = $request->branch_id;

        $items->bank_cash_id = $request->bank_cash_id;
        $items->cheque_number = $request->cheque_number;

        $items->cr = $request->amount;
        $items->voucher_date = $voucher_date;
        $items->particulars = $request->particulars;


        $items->updated_by = \Auth::user()->email;

        $items->save();
        Session::flash('success', "Update Successfully");
        return redirect()->route($this->parentRoute);

    }

    public function pdf(Request $request)
    {

        $id = $request->id;
        $item = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->where(function ($q) use ($id) {
                $q->where('voucher_no', '=', $id);
            })
            ->get();

        if (count($item) == 0) {
            Session::flash('error', "Item not found");
            return redirect()->route($this->parentRoute);
        }


        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');


        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Initial Bank Cash Balance Report',
            'voucher_type' => 'INITIAL BANK CASH BALANCE'
        );


        // return view('admin.dr-voucher.pdf');

        $pdf = PDF::loadView($this->parentView . '.pdf', ['items' => $item, 'extra' => $extra])->setPaper('a4', 'landscape');

       // return $pdf->stream($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');

        return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->where(function ($q) use ($id) {
                $q->where('voucher_no', '=', $id);
            })
            ->get()->first();

        if (empty($items)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }

        $items->deleted_by = \Auth::user()->email;
        $items->save();

        $items->delete();
        Session::flash('success', "Successfully Trashed");
        return redirect()->back();
    }


    public function trashed()
    {

        $items = $this->parentModel::onlyTrashed()->where('voucher_type', $this->voucher_type)->orderBy('id', 'desc')->paginate(60);
        return view($this->parentView . '.trashed')->with("items", $items);
    }


    public function restore($id)
    {
        //$items = $this->parentModel::onlyTrashed()->where('id', $id)->first();

        $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->onlyTrashed()
            ->where(function ($q) use ($id) {
                $q->where('voucher_no', '=', $id);
            })
            ->onlyTrashed()
            ->get()->first();


        $items->restore();

        $items->updated_by = \Auth::user()->email;
        $items->save();

        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }

    public function kill($id)
    {

        $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->withTrashed()
            ->where(function ($q) use ($id) {
                $q->where('voucher_no', '=', $id);
            })
            ->withTrashed()
            ->get()->first();


        $items->forceDelete();

        Session::flash('success', 'Permanently Delete');
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    {

        $request->validate([
            'search' => 'min:1'
        ]);

        $search = $request["search"];

        $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->where(function ($q) use ($search) {
                $q->where('voucher_no', '=', $search)
                    ->orWhere('voucher_date', 'like', date("Y-m-d", strtotime($search)))
                    ->orWhere('cheque_number', '=', $search)
                    ->orWhere('dr', '=', $search)
                    ->orWhere('cr', '=', $search)
                    ->orWhere('particulars', 'like', '%' . $search . '%')
                    ->orWhereHas('BankCash', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('Branch', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->paginate(60);


        return view($this->parentView . '.index')
            ->with('items', $items);

    }

    public function trashedSearch(Request $request)
    {

        $request->validate([
            'search' => 'min:1'
        ]);

        $search = $request["search"];

        $items = $this->parentModel::where('voucher_type', '=', $this->voucher_type)
            ->onlyTrashed()
            ->where(function ($q) use ($search) {
                $q->where('voucher_no', '=', $search)
                    ->orWhere('voucher_date', 'like', date("Y-m-d", strtotime($search)))
                    ->orWhere('cheque_number', '=', $search)
                    ->orWhere('dr', '=', $search)
                    ->orWhere('cr', '=', $search)
                    ->orWhere('particulars', 'like', '%' . $search . '%')
                    ->orWhereHas('BankCash', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('Branch', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->onlyTrashed()
            ->paginate(60);


        return view($this->parentView . '.trashed')
            ->with('items', $items);

    }


//    Fixed Method for all
    public function activeAction(Request $request)
    {

        $request->validate([
            'items' => 'required'
        ]);

        if ($request->apply_comand_top == 3 || $request->apply_comand_bottom == 3) {
            foreach ($request->items["id"] as $id) {
                $this->destroy($id);
            }

            return redirect()->back();

        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {

            foreach ($request->items["id"] as $id) {
                $this->kill($id);
            }
            return redirect()->back();

        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }

    }

    public function trashedAction(Request $request)
    {

        $request->validate([
            'items' => 'required'
        ]);

        if ($request->apply_comand_top == 1 || $request->apply_comand_bottom == 1) {

            foreach ($request->items["id"] as $id) {
                $this->restore($id);
            }

        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {

            foreach ($request->items["id"] as $id) {

                $this->kill($id);
            }
            return redirect()->back();

        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }
        return redirect()->back();
    }


}
