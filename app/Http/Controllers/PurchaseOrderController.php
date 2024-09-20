<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\PurchaseRequisition;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\RoleManageController;
use App\Setting;


class PurchaseOrderController extends Controller
{


    //    Important properties
    public $parentModel = PurchaseOrder::class;
    public $parentRoute = 'purchase_order';
    public $parentView = "admin.purchase.order";


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

            'branch_id' => 'not_in:0',
            'vendor_id' => 'not_in:0',
            'media_name' => 'required',
            'subject' => 'required',
            'message_body' => 'required',
            'issuing_date' => 'required',
            'date_of_delevery' => 'required',
            'requisition_id' => 'not_in:0',

        ]);


        $items = array();
        foreach ($request->income_expense_head_id as $key => $value) {

            if ($value == 0) {
                continue;
            }
            $item = array(
                'income_expense_head_id' => $request->income_expense_head_id[$key],
                'income_expense_head_name' => $request->income_expense_head_name[$key],
                'unit' => $request->unit[$key],
                'description' => $request->description[$key],
                'qntity' => $request->qntity[$key],
                'rate' => $request->rate[$key],
                'amount' => $request->amount[$key],
            );
            array_push($items, $item);
        }

        if (count($items) < 1) {
            Session::flash('error', "At least One item purchase");
            return redirect()->back();
        }


        $array_zip = [
            'items' => $items
        ];

        $item = json_encode($array_zip);

        $purchase_id = '';
        $requisiton = $this->parentModel::withTrashed()->orderBy('id', 'desc')->first();
        if (empty($requisiton)) {
            $purchase_id = $this->parentModel::getPurchaseId(1);
        } else {
            $purchase_id = $this->parentModel::getPurchaseId($requisiton->id + 1);
        }


        $this->parentModel::create([
            'branch_id' => $request->branch_id,
            'requisition_id' => $request->requisition_id,
            'purchase_id' => $purchase_id,
            'vendor_id' => $request->vendor_id,
            'media_name' => $request->media_name,
            'issuing_date' => $request->issuing_date,
            'date_of_delevery' => $request->date_of_delevery,
            'contract_person_1' => $request->contract_person_1,
            'contract_person_2' => $request->contract_person_2,
            'note' => $request->note,
            'subject' => $request->subject,
            'message_body' => $request->message_body,

            'item' => $item,

            'totalAmount' => $request->totalAmount,

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

        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Purchase Order'
        );

        $purchaseOrderItem = json_decode($item->item);
        $purchaseOrderItems = array();
        foreach ($purchaseOrderItem->items as $purchaseOrder) {
            $orderItems = (array)$purchaseOrder;
            array_push($purchaseOrderItems, $orderItems);
        }

        return view($this->parentView . '.show')
            ->with('items', $item)
            ->with('extra', $extra)
            ->with('purchaseOrderItems', $purchaseOrderItems);
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

//        if (!empty($items->requisition_id)) {
//            Session::flash('error', "You can not Edit it. Because this requisition already Confirmed");
//            return redirect()->back();
//        }
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

            'branch_id' => 'not_in:0',
            'vendor_id' => 'not_in:0',
            'media_name' => 'required',
            'subject' => 'required',
            'message_body' => 'required',
            'issuing_date' => 'required',
            'date_of_delevery' => 'required',
            'requisition_id' => 'not_in:0',

        ]);


        $items = array();
        foreach ($request->income_expense_head_id as $key => $value) {

            if ($value == 0) {
                continue;
            }
            $item = array(
                'income_expense_head_id' => $request->income_expense_head_id[$key],
                'income_expense_head_name' => $request->income_expense_head_name[$key],
                'unit' => $request->unit[$key],
                'description' => $request->description[$key],
                'qntity' => $request->qntity[$key],
                'rate' => $request->rate[$key],
                'amount' => $request->amount[$key],
            );
            array_push($items, $item);
        }

        if (count($items) < 1) {
            Session::flash('error', "At least One item purchase");
            return redirect()->back();
        }


        $array_zip = [
            'items' => $items
        ];

        $item = json_encode($array_zip);

        $items = $this->parentModel::find($id);


        $items->branch_id = $request->branch_id;
        $items->requisition_id = $request->requisition_id;
        $items->vendor_id = $request->vendor_id;
        $items->media_name = $request->media_name;
        $items->issuing_date = $request->issuing_date;
        $items->date_of_delevery = $request->date_of_delevery;
        $items->contract_person_2 = $request->contract_person_2;
        $items->note = $request->note;
        $items->subject = $request->subject;
        $items->message_body = $request->message_body;
        $items->totalAmount = $request->totalAmount;

        $items->item = $item;

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

//        if (!empty($items->requisition_id)) {
//            Session::flash('error', "You can not delete it.Because this requisition already Confirmed");
//            return redirect()->back();
//        }

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

//        if (!empty($items->requisition_id)) {
////            Session::flash('error', "You can not Restore it.Because this requisition already Confirmed");
////            return redirect()->back();
////        }

        $items->restore();
        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }

    public function kill($id)
    {
        $items = $this->parentModel::withTrashed()->where('id', $id)->first();

//        if (!empty($items->requisition_id)) {
//            Session::flash('error', "You can not delete it.Because this requisition already Confirmed");
//            return redirect()->back();
//        }

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

        $items = $this->parentModel::whereHas('branch', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
            ->orWhereHas('vendor', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhere('requisition_id', 'like', $search)
            ->orWhere('purchase_id', 'like', $search)
            ->orWhere('totalAmount', 'like', $search)
            ->orWhere('media_name', 'like', $search)
            ->orWhere('contract_person_1', 'like', $search)
            ->orWhere('contract_person_2', 'like', $search)
            ->orWhere('issuing_date', 'like', date("m/d/Y", strtotime($search)))
            ->orWhere('date_of_delevery', 'like', date("m/d/Y", strtotime($search)))
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


        $items = $this->parentModel::whereHas('branch', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
            ->onlyTrashed()
            ->orWhereHas('vendor', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->onlyTrashed()
            ->orWhere('requisition_id', 'like', $search)
            ->onlyTrashed()
            ->orWhere('purchase_id', 'like', $search)
            ->onlyTrashed()
            ->orWhere('totalAmount', 'like', $search)
            ->onlyTrashed()
            ->orWhere('media_name', 'like', $search)
            ->onlyTrashed()
            ->orWhere('contract_person_1', 'like', $search)
            ->onlyTrashed()
            ->orWhere('contract_person_2', 'like', $search)
            ->onlyTrashed()
            ->orWhere('issuing_date', 'like', date("m/d/Y", strtotime($search)))
            ->onlyTrashed()
            ->orWhere('date_of_delevery', 'like', date("m/d/Y", strtotime($search)))
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


    public function get_requisition_by_branch(Request $request)
    {

        $purchaseConfirmedItems = PurchaseRequisition::where([
            ['branch_id', '=', $request->id],
            ['requisition_id', '!=', '']
        ])
            ->orderBy('id', 'desc')
            ->get();
        echo json_encode($purchaseConfirmedItems);
    }

    public function get_requisition_items_by_requistion_id(Request $request)
    {

        $purchaseConfirmedItems = PurchaseRequisition::where([
            ['requisition_id', '=', $request->id]
        ])
            ->first();

        $newItems = json_decode($purchaseConfirmedItems->item);

        $result = array();
        foreach ($newItems->items as $item) {
            $arrayItem = (array)$item;
            array_push($result, $arrayItem);
        }
        echo json_encode($result);
    }

    public function get_order_items_by_requistion_id(Request $request)
    {
        $orderInfos = $purchaseOrderedItems = PurchaseOrder::withTrashed()->where([
            ['requisition_id', '=', $request->id]
        ])
            ->get();

        $newItems = array();
        foreach ($orderInfos as $orderInfo) {
            $items = json_decode($orderInfo->item);
            foreach ($items->items as $item) {
                $updatedItem = (array)$item;
                array_push($newItems, $updatedItem);
            }
        }

        $results = array();
        foreach ($newItems as $key => $item) {

            if ($key == 0) {
                array_push($results, $item);
            } else {

                $findItems = false;
                $findIndex = '';

                foreach ($results as $index => $result) {
                    if ($result['income_expense_head_id'] == $item['income_expense_head_id']) {
                        $findItems = true;
                        $findIndex = $index;
                        break;
                    }
                }
                if ($findItems == true) {
                    $results[$findIndex]['qntity'] = $results[$findIndex]['qntity'] + $item['qntity'];
                    $results[$findIndex]['amount'] = $results[$findIndex]['amount'] + $item['amount'];
                } else {
                    array_push($results, $item);
                }
            }
        }

        echo json_encode($results);

    }


}
