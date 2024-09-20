@extends('layouts.pdf')

@section('title')
    {{ $extra['module_name']  }}
@endsection

@push('include-css')
    {{--<link rel="stylesheet" href="{{ asset('asset/css/only-voucher.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('asset/css/report.css') }}">

@endpush

<?php
$transaction = new \App\Transaction();
?>

@section('content')

    <div class="mid_section">
        <div class="row ">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xl-12">
                <p class="mt-lg-1 mt-sm-1 mt-xl-1 mt-md-1 mb-lg-1 mb-sm-1 mb-xl-1 mb-md-1">Printing Date &
                    Time: {{ $extra['current_date_time']  }}</p>
            </div>

        </div>
        <div class="row mt-2">
            <div class="col-lg-6 col-md-6 col-xl-6 col-sm-6 ">
                <div class="company_logo ">
                    <img src="{{ asset( config('settings.company_logo')) }}"
                         alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xl-6 col-sm-6 ">
                <div class="requisition_no  float-lg-right float-md-right float-sm-right float-xl-right mt-lg-2 mt-md-2 mt-sm-2 mt-xl-2">
                    <table class="table table-bordered table-sm">
                        <tbody>
                        <tr>
                            <td class="text-center">Requisition No.</td>
                        </tr>
                        <tr>
                            <td class="text-center">{{ $items->requisition_id  }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xl-12">
                <div class="border-bottom">
                    <h3 class="text-center">{{ config('settings.company_name')  }}</h3>
                    <p class="text-center">{{ config('settings.address_1')  }}</p>
                </div>
            </div>
        </div>
        <div class="row mt-2 ">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xl-12 ">
                <h5 class="text-center">Purchase Requisition</h5>
            </div>
        </div>

        <div class="row mt-3 ">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6 ">
                <div class="project_description pt-3 border p-3">
                    <p>Project Name : {{ App\Branch::find($items->branch_id)->name  }}</p>
                    <p>Project Address : {{ App\Branch::find($items->branch_id)->location  }}</p>
                    <p>Contract : {{ $items->contract_person  }}</p>
                    <p>Description : {{ $items->purpose }}</p>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6 ">
                <div class="project_description pt-3 border p-3">
                    <p>Requisition Date : {{ $transaction->date_format($items->requisition_date)  }}</p>
                    <p>Required Date: {{ $transaction->date_format($items->required_date) }}</p>
                    <p>Requisition Raised By : {{ App\Employee::find($items->employee_id)->name  }}</p>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xl-12">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">SL.NO.</th>
                        <th scope="col" class="text-left">Item Name</th>
                        <th scope="col" class="text-left">Unit</th>
                        <th scope="col" class="text-left">Required Quantity</th>
                        <th scope="col" class="text-left">Approx/Unit Cost ( {{ $transaction->get_currency_code()  }} )</th>
                        <th scope="col" class="text-left">Total Approx Value ( {{ $transaction->get_currency_code()  }} )</th>
                        <th scope="col" class="text-left">Remarks</th>

                    </tr>
                    </thead>
                    <tbody>

                    @php
                        $encoded_item = json_decode($items->item);

                        $row_span=count($encoded_item->items)+1;

                        $sl= 1;
                    @endphp

                    @foreach($encoded_item->items as $item)
                        <tr>
                            <th scope="row" class="text-center">{{ $sl }}</th>
                            <td>{{ App\IncomeExpenseHead::find($item->income_expense_head_id)->name  }}</td>
                            <td>{{ App\IncomeExpenseHead::find($item->income_expense_head_id)->unit  }}</td>
                            <td>{{ $transaction->convert_money_format( $item->qntity ) }}</td>
                            <td>{{ $transaction->convert_money_format( $item->rate) }}</td>
                            <td>{{ $transaction->convert_money_format( $item->amount) }}</td>

                            @if ( $sl ==1)
                                <td rowspan="{{ $row_span}}">asdf</td>
                            @endif
                        </tr>

                        <?php $sl++ ?>
                    @endforeach

                    <?php
                    if($row_span-1==5){
                        $height= 350;
                    }elseif ($row_span-1>=3){
                        $height= 400;
                    }elseif ($row_span-1>=1){
                        $height= 450;
                    }
                    ?>

                    <tr height="{{ $height }}">
                        <th></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>


                    <tr>
                        <th scope="row" colspan="5" class="text-right">Total =</th>
                        <th>{{ $transaction->convert_money_format($encoded_item->total_requisition_amount)  }}</th>
                        <th></th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row mb-5">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xl-12">
                <p>In word: <span class="font-w-b"> {{ $transaction->convert_number_to_words($encoded_item->total_requisition_amount) }}   {!! config('settings.currency_code') !!} </span>
                    only.
                </p>
            </div>
        </div>

        <div class="row margin-top-20">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xl-12">
                <table class="table">
                    <tr>
                        <td class="text-center border-n">
                            - - - - -<br>
                            Prepared by
                        </td>
                        <td class="text-center border-n">
                            - - - - -<br>
                            Checked by
                        </td>
                        <td class="text-center border-n">
                            - - - - -<br>
                            Forward by
                        </td>
                        <td class="text-center border-n">
                            - - - - -<br>
                            Approved by
                        </td>
                    </tr>
                </table>
            </div>
        </div>

@stop


