<?php

namespace App\Http\Controllers;

use App\ActualReceived;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class ActualReceivedController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sells_id)
    {
        return view('admin.schedule-manage.actual-payment.create')->with('sells_id', $sells_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $sells_id)
    {
        $request->validate([
            'term' => 'required|not_in:0',
            'received_amount' => 'numeric|not_in:0',
            'actual_amount' => 'numeric|min:1',
            'date_of_collection' => 'required',
        ]);

        if ($request->has('adjustment')) {

            if ($request->actual_amount != $request->received_amount - $request->adjustment) {
                Session::flash('error', 'Adjustment Error. Receive Amount - Adjustment = Actual amount');
                return redirect()->back()->withInput($request->input());
            }
        }

        $ActualReceives = ActualReceived::where('sells_id', $sells_id)->get();

        foreach ($ActualReceives as $ActualReceive) {
            $term = $ActualReceive->term;
            if ($term == $request->term) {
                Session::flash('error', "This Term Already been taken. Try another one");
                return redirect()->back()->withInput($request->input());
            }
        }


        ActualReceived::create([
            'sells_id' => $sells_id,
            'term' => $request->term,
            'received_amount' => $request->received_amount,
            'adjustment' => $request->adjustment,
            'actual_amount' => $request->actual_amount,
            'date_of_collection' => $request->date_of_collection,
            'made_of_payment' => $request->made_of_payment,
            'cheque_no' => $request->cheque_no,
            'bank_name' => $request->bank_name,
            'remark' => $request->remark,

            'created_by' => \Auth::user()->email,
        ]);

        Session::flash('success', "Successfully  Create");
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ScheduleReceivable  $scheduleReceivable
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $sells_id)
    {

        $ScheduleItem = ActualReceived::findOrFail($id);

        $infos = [
            'id' => $id,
            'sells_id' => $sells_id,
            'item' => $ScheduleItem,
        ];
        return view('admin.schedule-manage.actual-payment.edit')->with('infos', $infos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ScheduleReceivable  $scheduleReceivable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id, $sells_id)
    {

        $request->validate([
            'term' => 'required|not_in:0',
            'received_amount' => 'numeric|not_in:0',
            'actual_amount' => 'numeric|min:1',
            'date_of_collection' => 'required',
        ]);

        if ($request->has('adjustment')) {
            if ($request->actual_amount != $request->received_amount - $request->adjustment) {
                Session::flash('error', 'Adjustment Error. Receive Amount - Adjustment = Actual amount');
                return redirect()->back()->withInput($request->input());
            }
        }


        $updateActualItem = ActualReceived::findOrFail($id);
        if ($updateActualItem->term != $request->term) {
            $actualRecives = ActualReceived::where('sells_id', $sells_id)->get();
            foreach ($actualRecives as $actualReceive) {
                $term = $actualReceive->term;
                if ($term == $request->term) {
                    Session::flash('error', "This Term Already been taken. Try another one");
                    return redirect()->back()->withInput($request->input());
                }
            }
        }

        $updateActualItem->term = $request->term;
        $updateActualItem->received_amount = $request->received_amount;
        $updateActualItem->adjustment = $request->adjustment;
        $updateActualItem->actual_amount = $request->actual_amount;
        $updateActualItem->date_of_collection = $request->date_of_collection;
        $updateActualItem->made_of_payment = $request->made_of_payment;
        $updateActualItem->cheque_no = $request->cheque_no;
        $updateActualItem->bank_name = $request->bank_name;
        $updateActualItem->remark = $request->remark;


        if (!$updateActualItem->isDirty()) {
            Session::flash('error', "Nothing Changes Happened !");
            return redirect()->back()->withInput($request->input());
        }

        $updateActualItem->save();

        Session::flash('success', "Successfully  Updated");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ScheduleReceivable  $scheduleReceivable
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $scheduleItems = ActualReceived::findOrFail($id);

        $scheduleItems->delete();

        Session::flash('success', "Successfully  Deleted");
        return redirect()->back();
    }
}
