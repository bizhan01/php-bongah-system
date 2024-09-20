<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\RoleManageController;
use App\Setting;


class ProductController extends Controller
{


    //    Important properties
    public $parentModel = Product::class;
    public $parentRoute = 'product';
    public $parentView = "admin.product";



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

        $request["product_unique_id"] = $request->branch_id.'-'.$request->flat_type.'-'.$request->floor_number;


        $request->validate([
            'branch_id' => 'required',
            'flat_type' => 'required',
            'floor_number' => 'required',

            'flat_size' => 'required',
            'unite_price' => 'required',
            'total_flat_price' => 'required',

            'net_sells_price' => 'required',
            'product_unique_id' => 'required|unique:products',


        ]);

        if (!$request->total_flat_price == $request->flat_size * $request->unite_price) {
            Session::flash('error', "Total Flat Price Not equal to (Flat Size  X Unite Price)");
            return redirect()->back();
        }

        $netSallsPrice = $request->total_flat_price;

        if (!empty($request->car_parking_charge)) {
            $netSallsPrice += $request->car_parking_charge;
        }

        if (!empty($request->utility_charge)) {
            $netSallsPrice += $request->utility_charge;
        }

        if (!empty($request->additional_work_charge)) {
            $netSallsPrice += $request->additional_work_charge;
        }

        if (!empty($request->other_charge)) {
            $netSallsPrice += $request->other_charge;
        }

        if (!empty($request->discount_or_deduction)) {
            $netSallsPrice -= $request->discount_or_deduction;
        }

        if (!empty($request->refund_additional_work_charge)) {
            $netSallsPrice -= $request->refund_additional_work_charge;
        }

        if ($request->net_sells_price != $netSallsPrice) {
            Session::flash('error', "Net Sells Price Not Match");
            return redirect()->back();
        }


        $product_new_img = '';
        if ($request->hasFile('product_img')) {

            $product_img = $request->product_img;
            $temporaryName = time() . $product_img->getClientOriginalName();
            $product_img->move("upload/product/", $temporaryName);
            $product_new_img = 'upload/product/' . $temporaryName;
        }


        $this->parentModel::create([
            'product_unique_id' => $request->product_unique_id,
            'branch_id' => $request->branch_id,
            'flat_type' => $request->flat_type,
            'floor_number' => $request->floor_number,
            'flat_size' => $request->flat_size,
            'unite_price' => $request->unite_price,
            'total_flat_price' => $request->total_flat_price,
            'car_parking_charge' => $request->car_parking_charge,
            'utility_charge' => $request->utility_charge,
            'additional_work_charge' => $request->additional_work_charge,
            'other_charge' => $request->other_charge,
            'discount_or_deduction' => $request->discount_or_deduction,
            'refund_additional_work_charge' => $request->refund_additional_work_charge,
            'net_sells_price' => $request->net_sells_price,

            'product_img' => $product_new_img,


            'description' => $request->description,

            'create_by' => \Auth::user()->email,

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

        $request["product_unique_id"] = $request->branch_id . '-' . $request->flat_type . '-' . $request->floor_number;


        $request->validate([
            'product_unique_id' => 'required|unique:products,product_unique_id,'.$id,
            'branch_id' => 'required',
            'flat_type' => 'required',
            'floor_number' => 'required',

            'flat_size' => 'required',
            'unite_price' => 'required',
            'total_flat_price' => 'required',

            'net_sells_price' => 'required',

        ]);



        if (!$request->total_flat_price == $request->flat_size * $request->unite_price) {
            Session::flash('error', "Total Flat Price Not equal to (Flat Size  X Unite Price)");
            return redirect()->back();
        }

        $netSallsPrice = $request->total_flat_price;

        if (!empty($request->car_parking_charge)) {
            $netSallsPrice += $request->car_parking_charge;
        }

        if (!empty($request->utility_charge)) {
            $netSallsPrice += $request->utility_charge;
        }

        if (!empty($request->additional_work_charge)) {
            $netSallsPrice += $request->additional_work_charge;
        }

        if (!empty($request->other_charge)) {
            $netSallsPrice += $request->other_charge;
        }

        if (!empty($request->discount_or_deduction)) {
            $netSallsPrice -= $request->discount_or_deduction;
        }

        if (!empty($request->refund_additional_work_charge)) {
            $netSallsPrice -= $request->refund_additional_work_charge;
        }

        if ($request->net_sells_price != $netSallsPrice) {
            Session::flash('error', "Net Sells Price Not Match");
            return redirect()->back();
        }

        $items = $this->parentModel::find($id);

        $product_new_img = '';
        if ($request->hasFile('product_img')) {

            if (!empty($items->product_img)) {
                unlink($items->product_img); // Delete previous image file
            }

            $product_img = $request->product_img;
            $temporaryName = time() . $product_img->getClientOriginalName();
            $product_img->move("upload/product/", $temporaryName);
            $product_new_img = 'upload/product/' . $temporaryName;
        }

        $items->product_unique_id=$request->product_unique_id;

        $items->branch_id = $request->branch_id;
        $items->flat_type = $request->flat_type;
        $items->floor_number = $request->floor_number;

        $items->flat_size = $request->flat_size;
        $items->unite_price = $request->unite_price;
        $items->total_flat_price = $request->total_flat_price;

        $items->car_parking_charge = $request->car_parking_charge;
        $items->utility_charge = $request->utility_charge;
        $items->additional_work_charge = $request->additional_work_charge;
        $items->other_charge = $request->other_charge;
        $items->discount_or_deduction = $request->discount_or_deduction;
        $items->refund_additional_work_charge = $request->refund_additional_work_charge;
        $items->net_sells_price = $request->net_sells_price;

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
            'module_name' => 'Product Manage'
        );

        $pdf = PDF::loadView($this->parentView . '.pdf', ['items' => $item,  'extra' => $extra])->setPaper('a4', 'landscape');
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
        if (count((array)$this->parentModel::find($items->product_unique_id)->sell) > 0) {
            Session::flash('error', "You can not delete it. Because it already Sold");
            return redirect()->back();
        }



        $items->delete_by = \Auth::user()->email;

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
        $item = $this->parentModel::withTrashed()->where('id', $id)->first();

        if (count((array)$this->parentModel::withTrashed()->find($item->product_unique_id)->sell) > 0) {
            Session::flash('error', "You can not delete it. Because it already Sold");
            return redirect()->back();
        }


        $item->forceDelete();

        Session::flash('success', 'Permanently Delete');
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    {

        $request->validate([
            'search' => 'min:1'
        ]);

        $search = $request["search"];
        $items = $this->parentModel::where('flat_type', 'like', '%' . $search . '%')

            ->orWhereHas('branch', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhere('product_unique_id', 'like', '%' . $search . '%')
            ->orWhere('floor_number', 'like', '%' . $search . '%')
            ->orWhere('flat_size', 'like', '%' . $search . '%')
            ->orWhere('unite_price', 'like', '%' . $search . '%')
            ->orWhere('total_flat_price', 'like', '%' . $search . '%')
            ->orWhere('car_parking_charge', 'like', '%' . $search . '%')
            ->orWhere('utility_charge', 'like', '%' . $search . '%')
            ->orWhere('additional_work_charge', 'like', '%' . $search . '%')
            ->orWhere('other_charge', 'like', '%' . $search . '%')
            ->orWhere('discount_or_deduction', 'like', '%' . $search . '%')
            ->orWhere('refund_additional_work_charge', 'like', '%' . $search . '%')
            ->orWhere('net_sells_price', 'like', '%' . $search . '%')

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

        $items = $this->parentModel::where('flat_type', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhereHas('branch', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->onlyTrashed()
            ->orWhere('product_unique_id', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('floor_number', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('flat_size', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('unite_price', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('total_flat_price', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('car_parking_charge', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('utility_charge', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('additional_work_charge', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('other_charge', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('discount_or_deduction', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('refund_additional_work_charge', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('net_sells_price', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('description', 'like', '%' . $search . '%')

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
