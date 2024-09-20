<?php

namespace App\Http\Controllers\Reports\Sells;

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

use App\Branch;
use App\Customer;
use App\Employee;
use App\Product;
use App\ScheduleReceivable;
use App\ActualReceived;
use App\Exports\Selles\PartyLedgerSummery;
use App\Sell;

class SellsReportController extends Controller
{

    public function index()
    {
        return view('admin.sells-report.index');
    }

    public function customer_wise(Request $request)
    {
        $request->validate([
            'customer_id' => 'not_in:0',
            'product_id' => 'not_in:0',
        ]);

        $from = $request->from;
        $to = $request->to;

        $customer_info = Customer::findOrFail($request->customer_id);
        $product_info = Product::where('product_unique_id', $request->product_id)->get();
        $branch_info = Branch::findOrFail($product_info[0]->branch_id);

        $sells_info = Sell::where('product_id', $request->product_id)->get();
        $selles_id = $sells_info[0]->id;

        $schedule_receivable_info = ScheduleReceivable::where('sells_id', $selles_id)->get();
        $actual_received_info = ActualReceived::where('sells_id', $selles_id)->get();

        $customer_info = Customer::findOrFail($request->customer_id);
        $product_info = Product::where('product_unique_id', $request->product_id)->get();
        $branch_info = Branch::findOrFail($product_info[0]->branch_id);

        $sells_info = Sell::where('product_id', $request->product_id)->get();
        $selles_id = $sells_info[0]->id;


        if ($request->from != null) {
            $schedule_receivable_info = ScheduleReceivable::where('sells_id', $selles_id)
                ->where(function ($q) use ($from, $to) {
                    $q->whereBetween('schedule_date', [$from, $to])
                        ->get();
                })
                ->get();
            $actual_received_info = ActualReceived::where('sells_id', $selles_id)
                ->where(function ($q) use ($from, $to) {
                    $q->whereBetween('date_of_collection', [$from, $to])
                        ->get();
                })
                ->get();
        } else {

            $schedule_receivable_info = ScheduleReceivable::where('sells_id', $selles_id)->get();
            $actual_received_info = ActualReceived::where('sells_id', $selles_id)->get();
        }


        $infos = [
            'customer' => $customer_info,
            'product' => $product_info[0],
            'branch' => $branch_info,
            'schedule_receivable' => $schedule_receivable_info,
            'actual_received_info' => $actual_received_info,
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'selles_id' => $selles_id,
            'sells' => $sells_info[0],
        ];




        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Customer Wise Party Ledger',
            'voucher_type' => 'Party Ledger'
        );


        // Common items

        if ($request->from == null) {
            $from = null;
        } else {
            $from = date(config('settings.date_format'), strtotime($request->from));
        }

        if ($request->to == null) {
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
            return view('admin.sells-report.party-ledger.customer-wise.index')
                ->with('infos', $infos)
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.sells-report.party-ledger.customer-wise.pdf', [
                'infos' => $infos,
                'extra' => $extra,
                'search_by' => $search_by,
            ])
                ->setPaper('a4', 'landscape');

            return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            //return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
        }

        /* // Excel Action
        if ($request->action == 'Excel') {

            $BranchWise = new BalanceShet([
                'infos' => $infos,
                'extra' => $extra,
                'search_by' => $search_by,
            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');
        } */
    }

    public function summary_wise(Request $request)
    {


        $from = $request->from;
        $to = $request->to;



        if (empty($request->branch_id)) {

            if ($from != null) {

                $sells_info = DB::select(DB::raw("

                        SELECT customers.id AS customer_id, customers.NAME AS customer_name,employees.id AS employee_id,
                        employees.NAME AS employee_name, sells.sells_date,sells.id AS sells_id,
                        branches.id AS branch_id, branches.NAME AS branch_name, products.flat_type,
                        products.floor_number, products.total_flat_price,
                        products.car_parking_charge, products.utility_charge,
                        products.additional_work_charge, products.other_charge,
                        products.discount_or_deduction, products.refund_additional_work_charge,
                        products.net_sells_price, products.product_unique_id AS product_unique_id

                        FROM 
                        sells
                        INNER JOIN customers 
                        ON sells.customer_id = customers.id
                        INNER JOIN branches
                        ON sells.branch_id = branches.id
                        INNER JOIN products
                        ON sells.product_id=products.product_unique_id
                        INNER JOIN employees
                        ON sells.employee_id = employees.id
                        AND  sells.sells_date BETWEEN '" . $from . "' AND '" . $to . "'

                    "));
            } else {

                $sells_info = DB::select(DB::raw("

                    SELECT customers.id AS customer_id, customers.NAME AS customer_name,employees.id AS employee_id,
                        employees.NAME AS employee_name, sells.sells_date,sells.id AS sells_id,
                        branches.id AS branch_id, branches.NAME AS branch_name, products.flat_type,
                        products.floor_number, products.total_flat_price,
                        products.car_parking_charge, products.utility_charge,
                        products.additional_work_charge, products.other_charge,
                        products.discount_or_deduction, products.refund_additional_work_charge,
                        products.net_sells_price, products.product_unique_id AS product_unique_id

                    FROM 
                    sells
                    INNER JOIN customers 
                    ON sells.customer_id = customers.id
                    INNER JOIN branches
                    ON sells.branch_id = branches.id
                    INNER JOIN products
                    ON sells.product_id=products.product_unique_id
                    INNER JOIN employees
                    ON sells.employee_id = employees.id



                    "));
            }
        } else {

            if ($from != null) {

                $sells_info = DB::select(DB::raw("

                        SELECT customers.id AS customer_id, customers.NAME AS customer_name,employees.id AS employee_id,
                        employees.NAME AS employee_name, sells.sells_date,sells.id AS sells_id,
                        branches.id AS branch_id, branches.NAME AS branch_name, products.flat_type,
                        products.floor_number, products.total_flat_price,
                        products.car_parking_charge, products.utility_charge,
                        products.additional_work_charge, products.other_charge,
                        products.discount_or_deduction, products.refund_additional_work_charge,
                        products.net_sells_price, products.product_unique_id AS product_unique_id

                        FROM 
                        sells
                        INNER JOIN customers 
                        ON sells.customer_id = customers.id
                        INNER JOIN branches
                        ON sells.branch_id = branches.id
                        INNER JOIN products
                        ON sells.product_id=products.product_unique_id
                        INNER JOIN employees
                        ON sells.employee_id = employees.id
                        WHERE branches.id=" . $request->branch_id . "
                        AND  sells.sells_date BETWEEN '" . $from . "' AND '" . $to . "'

                    "));
            } else {


                $sells_info = DB::select(DB::raw("

                    SELECT customers.id AS customer_id, customers.NAME AS customer_name,employees.id AS employee_id,
                    employees.NAME AS employee_name, sells.sells_date,sells.id AS sells_id,
                    branches.id AS branch_id, branches.NAME AS branch_name, products.flat_type,
                    products.floor_number, products.total_flat_price,
                    products.car_parking_charge, products.utility_charge,
                    products.additional_work_charge, products.other_charge,
                    products.discount_or_deduction, products.refund_additional_work_charge,
                    products.net_sells_price, products.product_unique_id AS product_unique_id

                    FROM 
                    sells
                    INNER JOIN customers 
                    ON sells.customer_id = customers.id
                    INNER JOIN branches
                    ON sells.branch_id = branches.id
                    INNER JOIN products
                    ON sells.product_id=products.product_unique_id
                    INNER JOIN employees
                    ON sells.employee_id = employees.id
                    WHERE branches.id=" . $request->branch_id . "

                    "));
            }
        }

        $total_collection_amount = [];
        foreach ($sells_info as $key=>$sell) {
            $Actual_receiveds = ActualReceived::where('sells_id', $sell->sells_id)->get();
            $total_collection =0;
            foreach($Actual_receiveds as $Actual_received){
                $total_collection += $Actual_received->actual_amount;
            }
            $total_collection_amount[$key] = $total_collection; 
        }

        $infos= [
            'items' => $sells_info ,
            'total_collection' => $total_collection_amount,
        ];


        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');
        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Customer Wise Party Ledger',
            'voucher_type' => 'Customer Summery Party Ledger'
        );


        $search_by = array(
            'from' => $from,
            'to' => $to,
        );


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.sells-report.party-ledger.summery-wise.index')
                ->with('infos', $infos)
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.sells-report.party-ledger.summery-wise.pdf', [
                'infos' => $infos,
                'extra' => $extra,
                'search_by' => $search_by,
            ])
                ->setPaper('a4', 'landscape');

            return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            //return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
        }

         // Excel Action
        if ($request->action == 'Excel') {

            $BranchWise = new PartyLedgerSummery([
                'infos' => $infos,
                'extra' => $extra,
                'search_by' => $search_by,
                'view_url'=> 'admin.sells-report.party-ledger.summery-wise.excel'
            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');
        } 



    }

    public function seller_name_wise(Request $request)
    {



        $from = $request->from;
        $to = $request->to;



        if (empty($request->employee_id)) {

            if ($from != null) {

                $sells_info = DB::select(DB::raw("

                        SELECT customers.id AS customer_id, customers.NAME AS customer_name,employees.id AS employee_id,
                        employees.NAME AS employee_name, sells.sells_date,sells.id AS sells_id,
                        branches.id AS branch_id, branches.NAME AS branch_name, products.flat_type,
                        products.floor_number, products.total_flat_price,
                        products.car_parking_charge, products.utility_charge,
                        products.additional_work_charge, products.other_charge,
                        products.discount_or_deduction, products.refund_additional_work_charge,
                        products.net_sells_price, products.product_unique_id AS product_unique_id

                        FROM 
                        sells
                        INNER JOIN customers 
                        ON sells.customer_id = customers.id
                        INNER JOIN branches
                        ON sells.branch_id = branches.id
                        INNER JOIN products
                        ON sells.product_id=products.product_unique_id
                        INNER JOIN employees
                        ON sells.employee_id = employees.id
                        AND  sells.sells_date BETWEEN '" . $from . "' AND '" . $to . "'

                    "));
            } else {

                $sells_info = DB::select(DB::raw("

                    SELECT customers.id AS customer_id, customers.NAME AS customer_name,employees.id AS employee_id,
                        employees.NAME AS employee_name, sells.sells_date,sells.id AS sells_id,
                        branches.id AS branch_id, branches.NAME AS branch_name, products.flat_type,
                        products.floor_number, products.total_flat_price,
                        products.car_parking_charge, products.utility_charge,
                        products.additional_work_charge, products.other_charge,
                        products.discount_or_deduction, products.refund_additional_work_charge,
                        products.net_sells_price, products.product_unique_id AS product_unique_id

                    FROM 
                    sells
                    INNER JOIN customers 
                    ON sells.customer_id = customers.id
                    INNER JOIN branches
                    ON sells.branch_id = branches.id
                    INNER JOIN products
                    ON sells.product_id=products.product_unique_id
                    INNER JOIN employees
                    ON sells.employee_id = employees.id



                    "));
            }
        } else {

            if ($from != null) {

                $sells_info = DB::select(DB::raw("

                        SELECT customers.id AS customer_id, customers.NAME AS customer_name,employees.id AS employee_id,
                        employees.NAME AS employee_name, sells.sells_date,sells.id AS sells_id,
                        branches.id AS branch_id, branches.NAME AS branch_name, products.flat_type,
                        products.floor_number, products.total_flat_price,
                        products.car_parking_charge, products.utility_charge,
                        products.additional_work_charge, products.other_charge,
                        products.discount_or_deduction, products.refund_additional_work_charge,
                        products.net_sells_price, products.product_unique_id AS product_unique_id

                        FROM 
                        sells
                        INNER JOIN customers 
                        ON sells.customer_id = customers.id
                        INNER JOIN branches
                        ON sells.branch_id = branches.id
                        INNER JOIN products
                        ON sells.product_id=products.product_unique_id
                        INNER JOIN employees
                        ON sells.employee_id = employees.id
                        WHERE employees.id=" . $request->employee_id . "
                        AND  sells.sells_date BETWEEN '" . $from . "' AND '" . $to . "'

                    "));
            } else {


                $sells_info = DB::select(DB::raw("

                    SELECT customers.id AS customer_id, customers.NAME AS customer_name,employees.id AS employee_id,
                    employees.NAME AS employee_name, sells.sells_date,sells.id AS sells_id,
                    branches.id AS branch_id, branches.NAME AS branch_name, products.flat_type,
                    products.floor_number, products.total_flat_price,
                    products.car_parking_charge, products.utility_charge,
                    products.additional_work_charge, products.other_charge,
                    products.discount_or_deduction, products.refund_additional_work_charge,
                    products.net_sells_price, products.product_unique_id AS product_unique_id

                    FROM 
                    sells
                    INNER JOIN customers 
                    ON sells.customer_id = customers.id
                    INNER JOIN branches
                    ON sells.branch_id = branches.id
                    INNER JOIN products
                    ON sells.product_id=products.product_unique_id
                    INNER JOIN employees
                    ON sells.employee_id = employees.id
                    WHERE employees.id=" . $request->employee_id . "

                    "));
            }
        }

        $total_collection_amount = [];
        foreach ($sells_info as $key => $sell) {
            $Actual_receiveds = ActualReceived::where('sells_id', $sell->sells_id)->get();
            $total_collection = 0;
            foreach ($Actual_receiveds as $Actual_received) {
                $total_collection += $Actual_received->actual_amount;
            }
            $total_collection_amount[$key] = $total_collection;
        }

        $infos = [
            'items' => $sells_info,
            'total_collection' => $total_collection_amount,
        ];


        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');
        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Customer Wise Party Ledger',
            'voucher_type' => 'Customer Summery Party Ledger'
        );


        $search_by = array(
            'from' => $from,
            'to' => $to,
        );


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.sells-report.party-ledger.summery-wise.index')
                ->with('infos', $infos)
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.sells-report.party-ledger.summery-wise.pdf', [
                'infos' => $infos,
                'extra' => $extra,
                'search_by' => $search_by,
            ])
                ->setPaper('a4', 'landscape');

            return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            //return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
        }

        // Excel Action
        if ($request->action == 'Excel') {

            $BranchWise = new PartyLedgerSummery([
                'infos' => $infos,
                'extra' => $extra,
                'search_by' => $search_by,
                'view_url' => 'admin.sells-report.party-ledger.summery-wise.excel'
            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');
        } 



    }




    public function change_customer_get_sell(Request $request)
    {

        $items = Sell::where('customer_id', $request->id)->get();

        $products = [];
        foreach ($items as $item) {
            $products[$item->product_id] = $item->product_id;
        }

        echo json_encode($products);
    }
}
