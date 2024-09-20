<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\RoleManageController;
use App\Setting;

class VendorController extends Controller
{


    //    Important properties
    public $parentModel = Vendor::class;
    public $parentRoute = 'vendor';
    public $parentView = "admin.vendor";


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = $this->parentModel::orderBy('created_at', 'desc')->paginate(60);
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
            'name' => 'required|string|unique:vendors',
        ]);

        $this->parentModel::create([
            'name' => $request->name,
            'mailing_address' => $request->mailing_address,
            'website' => $request->website,
            'phone' => $request->phone,
            'email' => $request->email,
            'description' => $request->description,


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

        $item = $this->parentModel::find($request->id);
        if (empty($item)) {
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

        $items = $this->parentModel::find($id);

        if (empty($items)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }

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
            'name' => 'sometimes|string|unique:vendors,name,' . $id,
        ]);

        $items = $this->parentModel::find($id);

        $items->name = $request->name;
        $items->mailing_address = $request->mailing_address;
        $items->website = $request->website;
        $items->phone = $request->phone;
        $items->email = $request->email;
        $items->description = $request->description;


        $items->updated_by = \Auth::user()->email;


        $items->save();
        Session::flash('success', "Update Successfully");
        return redirect()->route($this->parentRoute);
    }

    public function pdf(Request $request)
    {

        $item = $this->parentModel::find($request->id);
        if (empty($item)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Vendor Manage'
        );

        $pdf = PDF::loadView($this->parentView . '.pdf', ['items' => $item, 'extra' => $extra])->setPaper('a4', 'landscape');
        //return $pdf->stream('invoice.pdf');
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

        $items = $this->parentModel::find($id);
        if (count($this->parentModel::find($id)->purchaseOrder) > 0) {
            Session::flash('error', "You can not delete it.Because it has Some Purchase Order");
            return redirect()->back();
        }


        $items->deleted_by = \Auth::user()->email;

        $items->delete();
        Session::flash('success', "Successfully Trashed");
        return redirect()->back();
    }


    public function trashed()
    {

        $items = $this->parentModel::onlyTrashed()->paginate(60);
        return view($this->parentView . '.trashed')->with("items", $items);
    }


    public function restore($id)
    {
        $items = $this->parentModel::onlyTrashed()->where('id', $id)->first();

        $items->restore();
        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }

    public function kill($id)
    {
        $items = $this->parentModel::withTrashed()->where('id', $id)->first();

        if (count($this->parentModel::withTrashed()->find($id)->purchaseOrder) > 0) {
            Session::flash('error', "You can not delete it.Because it has Some Purchase Order");
            return redirect()->back();
        }


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
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->orWhere('mailing_address', 'like', '%' . $search . '%')
            ->orWhere('website', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
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

        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('mailing_address', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('website', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('email', 'like', '%' . $search . '%')
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
