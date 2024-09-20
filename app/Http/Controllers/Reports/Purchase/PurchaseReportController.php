<?php

namespace App\Http\Controllers\Reports\Purchase;

use App\Branch;
use App\PurchaseOrder;
use App\PurchaseRequisition;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\RoleManageController;
use App\Setting;
use Maatwebsite\Excel\Facades\Excel;


class PurchaseReportController extends Controller
{
    public function index()
    {
        return view('admin.purchase-report.index');
    }

    public function requisition(Request $request)
    {

        $branch_id = (integer)$request->branch_id;
        $from = $request->from;
        $to = $request->to;
        if ($branch_id > 0 and isset($from)) {

            if ($request->requisitionDate == 1) {
                $items = PurchaseRequisition::where('branch_id', $branch_id)
                    ->where(function ($q) use ($from, $to) {
                        $q->whereBetween('requisition_date', array($from, $to));
                    })
                    ->orderBy('branch_id', 'asc')
                    ->get();
            } else {
                $items = PurchaseRequisition::where('branch_id', $branch_id)
                    ->where(function ($q) use ($from, $to) {
                        $q->whereBetween('required_date', array($from, $to));
                    })
                    ->orderBy('branch_id', 'asc')
                    ->get();
            }

        } else if ($branch_id == 0 and !isset($from)) {

            $items = PurchaseRequisition::all();

        } else if ($branch_id > 0 and !isset($from)) {

            $items = PurchaseRequisition::where('branch_id', $branch_id)
                ->get();

        } else if ($branch_id == 0 and isset($from)) {

            if ($request->requisitionDate == 1) {
                $items = PurchaseRequisition::whereBetween('requisition_date', array($from, $to))
                    ->get();
            } else {
                $items = PurchaseRequisition::whereBetween('requisition_date', array($from, $to))
                    ->get();
            }
        }

        if (count($items) == 0) {
            Session::flash('error', "No Items Found");
            return redirect()->back();
        }

//      Added json items on $item array
        $uniqueBranches = array();
        foreach ($items as $item) {
            $newItem = json_decode($item->item);
            $item['formatedItem'] = $newItem->items;
            if (!in_array($item->branch_id, $uniqueBranches)) {
                array_push($uniqueBranches, $item->branch_id);
            }
        }
        sort($uniqueBranches);


        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Purchase Requisition',
            'voucher_type' => 'Purchase Requisition'
        );


        // Common items

        if ($from == null) {
            $from = null;
        } else {
            $from = date(config('settings.date_format'), strtotime($request->from));
        }

        if ($to == null) {
            $to = null;
        } else {
            $to = date(config('settings.date_format'), strtotime($request->to));
        }


        $search_by = array(
            'from' => $from,
            'to' => $to,
        );


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.purchase-report.purchase-requisition.index')
                ->with('infos', $items)
                ->with('extra', $extra)
                ->with('branches', $uniqueBranches)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.purchase-report.purchase-requisition.index', [
                'infos' => $items,
                'extra' => $extra,
                'branches' => $uniqueBranches,
                'search_by' => $search_by,
            ])
                ->setPaper('a4', 'landscape');

            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
        }

        // Excel Action
        if ($request->action == 'Excel') {

            $BranchWise = new \App\Exports\Purchase\PurchaseOrder([
                'infos' => $items,
                'extra' => $extra,
                'search_by' => $search_by,
                'branches' => $uniqueBranches,
                'view_url' => 'admin.purchase-report.purchase-requisition.excel',
            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');
        }


    }

    public function requisition_id(Request $request)
    {

        $request->validate([
            'requisition_id' => 'required'
        ]);

        $items = PurchaseRequisition::where('requisition_id', $request->requisition_id)
            ->get();


        if (count($items) == 0) {
            Session::flash('error', "No Items Found");
            return redirect()->back();
        }

//      Added json items on $item array
        $uniqueBranches = array();
        foreach ($items as $item) {
            $newItem = json_decode($item->item);
            $item['formatedItem'] = $newItem->items;
            if (!in_array($item->branch_id, $uniqueBranches)) {
                array_push($uniqueBranches, $item->branch_id);
            }
        }
        sort($uniqueBranches);


        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Purchase Requisition',
            'voucher_type' => 'Purchase Requisition'
        );


        // Common items

        $from = null;
        $to = null;

        if ($from == null) {
            $from = null;
        } else {
            $from = date(config('settings.date_format'), strtotime($request->from));
        }

        if ($to == null) {
            $to = null;
        } else {
            $to = date(config('settings.date_format'), strtotime($request->to));
        }


        $search_by = array(
            'from' => $from,
            'to' => $to,
        );


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.purchase-report.purchase-requisition.index')
                ->with('infos', $items)
                ->with('extra', $extra)
                ->with('branches', $uniqueBranches)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.purchase-report.purchase-requisition.index', [
                'infos' => $items,
                'extra' => $extra,
                'branches' => $uniqueBranches,
                'search_by' => $search_by,
            ])
                ->setPaper('a4', 'landscape');

            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
        }

        // Excel Action
        if ($request->action == 'Excel') {

            $BranchWise = new \App\Exports\Purchase\PurchaseOrder([
                'infos' => $items,
                'extra' => $extra,
                'search_by' => $search_by,
                'branches' => $uniqueBranches,
                'view_url' => 'admin.purchase-report.purchase-requisition.excel',
            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');
        }

    }

    public function order(Request $request)
    {

        $branch_id = (integer)$request->branch_id;
        $from = $request->from;
        $to = $request->to;
        if ($branch_id > 0 and isset($from)) {

            if ($request->issuing_date == 1) {
                $items = PurchaseOrder::where('branch_id', $branch_id)
                    ->where(function ($q) use ($from, $to) {
                        $q->whereBetween('issuing_date', array($from, $to));
                    })
                    ->whereNotNull('purchase_id')
                    ->orderBy('branch_id', 'asc')
                    ->get();
            } else {
                $items = PurchaseOrder::where('branch_id', $branch_id)
                    ->where(function ($q) use ($from, $to) {
                        $q->whereBetween('date_of_delevery', array($from, $to));
                    })
                    ->whereNotNull('purchase_id')
                    ->orderBy('branch_id', 'asc')
                    ->get();

            }

        } else if ($branch_id == 0 and !isset($from)) {

            $items = PurchaseOrder::whereNotNull('purchase_id')
                ->get();

        } else if ($branch_id > 0 and !isset($from)) {

            $items = PurchaseOrder::where('branch_id', $branch_id)
                ->whereNotNull('purchase_id')
                ->get();

        } else if ($branch_id == 0 and isset($from)) {


            if ($request->issuing_date == 1) {
                $items = PurchaseOrder::whereBetween('issuing_date', array($from, $to))
                    ->whereNotNull('purchase_id')
                    ->get();


            } else {
                $items = PurchaseOrder::whereBetween('date_of_delevery', array($from, $to))
                    ->whereNotNull('purchase_id')
                    ->get();
            }
        }


        if (count($items) == 0) {
            Session::flash('error', "No Items Found");
            return redirect()->back();
        }


//      Added json items on $item array
        $uniqueBranches = array();
        foreach ($items as $item) {
            $newItem = json_decode($item->item);
            $item['formatedItem'] = $newItem->items;
            if (!in_array($item->branch_id, $uniqueBranches)) {
                array_push($uniqueBranches, $item->branch_id);
            }
        }
        sort($uniqueBranches);


        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Purchase Order',
            'voucher_type' => 'Purchase Order'
        );


        // Common items

        if ($from == null) {
            $from = null;
        } else {
            $from = date(config('settings.date_format'), strtotime($request->from));
        }

        if ($to == null) {
            $to = null;
        } else {
            $to = date(config('settings.date_format'), strtotime($request->to));
        }


        $search_by = array(
            'from' => $from,
            'to' => $to,
        );


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.purchase-report.purchase-order.index')
                ->with('infos', $items)
                ->with('extra', $extra)
                ->with('branches', $uniqueBranches)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.purchase-report.purchase-order.index', [
                'infos' => $items,
                'extra' => $extra,
                'search_by' => $search_by,
                'branches' => $uniqueBranches,
            ])
                ->setPaper('a4', 'landscape');

            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
        }

        // Excel Action
        if ($request->action == 'Excel') {

            $BranchWise = new \App\Exports\Purchase\PurchaseOrder([
                'infos' => $items,
                'extra' => $extra,
                'search_by' => $search_by,
                'branches' => $uniqueBranches,
                'view_url' => 'admin.purchase-report.purchase-order.excel',
            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');
        }


    }

    public function order_id(Request $request)
    {
        $request->validate([
            'purchase_order_id' => 'required'
        ]);

        $items = PurchaseOrder::where('purchase_id', $request->purchase_order_id)
            ->get();


        if (count($items) == 0) {
            Session::flash('error', "No Items Found");
            return redirect()->back();
        }

//      Added json items on $item array
        $uniqueBranches = array();
        foreach ($items as $item) {
            $newItem = json_decode($item->item);
            $item['formatedItem'] = $newItem->items;
            if (!in_array($item->branch_id, $uniqueBranches)) {
                array_push($uniqueBranches, $item->branch_id);
            }
        }
        sort($uniqueBranches);


        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Purchase Order',
            'voucher_type' => 'Purchase Order'
        );


        // Common items

        $from = null;
        $to = null;

        if ($from == null) {
            $from = null;
        } else {
            $from = date(config('settings.date_format'), strtotime($request->from));
        }

        if ($to == null) {
            $to = null;
        } else {
            $to = date(config('settings.date_format'), strtotime($request->to));
        }


        $search_by = array(
            'from' => $from,
            'to' => $to,
        );

        // Show Action
        if ($request->action == 'Show') {
            return view('admin.purchase-report.purchase-order.index')
                ->with('infos', $items)
                ->with('extra', $extra)
                ->with('branches', $uniqueBranches)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.purchase-report.purchase-order.index', [
                'infos' => $items,
                'extra' => $extra,
                'search_by' => $search_by,
                'branches' => $uniqueBranches,
            ])
                ->setPaper('a4', 'landscape');

            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
        }

        // Excel Action
        if ($request->action == 'Excel') {

            $BranchWise = new \App\Exports\Purchase\PurchaseOrder([
                'infos' => $items,
                'extra' => $extra,
                'search_by' => $search_by,
                'branches' => $uniqueBranches,
                'view_url' => 'admin.purchase-report.purchase-order.excel',
            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');
        }


    }


}
