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
                            <td class="text-center">{{ $items->requisition_id  }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">{{ $items->purchase_id  }}</td>
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
                <h5 class="text-center">{{ $extra['module_name']  }}</h5>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-10 col-sm-10 col-md-10 col-xl-10">
                <div class="vendor">
                    <?php $vendorDetials = App\Vendor::find($items->vendor_id); ?>
                    <span>{{ $vendorDetials->name  }}</span><br>
                    <span>{{ $vendorDetials->mailing_address  }}</span>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xl-2">
                <div class="dob">
                    <p class="text-right">{{ $transaction->date_format($items->date_of_delevery) }}</p>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xl-12">
                <div class="message-body">
                    <h6><strong>Attr: {{ $items->media_name  }}</strong></h6>
                    <h5>Subject : {{ $items->subject }}</h5>
                    <p>{{  $items->message_body  }}</p>

                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xl-12">
                <p><b>1. Price</b></p>
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">SL.NO.</th>
                        <th scope="col" class="text-left">Item Name</th>
                        <th scope="col" class="text-left">Unit</th>
                        <th scope="col" class="text-left">Description</th>
                        <th scope="col" class="text-left">Quantity</th>
                        <th scope="col" class="text-left">Unit Cost ( {{ $transaction->get_currency_code()  }} )</th>
                        <th scope="col" class="text-left">Total Price ( {{ $transaction->get_currency_code()  }} )</th>
                        <th scope="col" class="text-left">Remarks</th>

                    </tr>
                    </thead>
                    <tbody>

                    @php

                        $row_span= count($purchaseOrderItems)+1;

                        $sl= 1;
                    @endphp

                    @foreach($purchaseOrderItems as $item)

                        <tr>
                            <th scope="row" class="text-center">{{ $sl }}</th>
                            <td>{{ $item['income_expense_head_name']  }}</td>
                            <td>{{ $item['unit']  }}</td>
                            <td>{{  $item['description']  }}</td>
                            <td>{{ $transaction->convert_money_format( $item['qntity']) }}</td>
                            <td>{{ $transaction->convert_money_format( $item['rate']) }}</td>
                            <td>{{ $transaction->convert_money_format( $item['amount']) }}</td>

                            @if ( $sl ==1)
                                <td rowspan="{{ $row_span}}">{{ $items->comment  }}</td>
                            @endif
                        </tr>

                        <?php $sl++ ?>
                    @endforeach

                    <?php
                    if ($row_span - 1 == 5) {
                        $height = 350;
                    } elseif ($row_span - 1 >= 3) {
                        $height = 400;
                    } elseif ($row_span - 1 >= 1) {
                        $height = 450;
                    }
                    ?>

                    <tr height="{{ $height }}">
                        <th></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <th scope="row" colspan="6" class="text-right">Total =</th>
                        <th>{{ $transaction->convert_money_format( $items->totalAmount)  }}</th>
                        <th></th>
                    </tr>
                    </tbody>
                </table>
                <p>In word: <span
                            class="font-w-b"> {{ $transaction->convert_number_to_words($items->totalAmount) }}   {!! config('settings.currency_code') !!} </span>
                    only.
                </p>
                <span><b>2. Made Of Payment: </b> Payment will be made through bank deposit / Account payee cheque</span>
                <br><span><b>3. Date of Delivery: </b> {{ $transaction->date_format($items->date_of_delevery) }} </span>
                <br><span><b>4. Validity: </b> This order will be valid for 10 (ten) days from the date of issuing this order</span>

                <?php $branchInfos = App\Branch::find($items->branch_id) ?>
                <br><span><b>5. Place of Delivery: </b> {{  $branchInfos->name }} | {{ $branchInfos->location }}</span>

                <p>If any of the above items found in damaged condition at the time of delivery or instAllation, will
                    not be accepted. we hope you will find the order acceptable.</p>
            </div>
        </div>

        <div class="row margin-top-20 margin-bottom-10">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6">
                <table class=" ">
                    <tr>
                        <td>Contact Person</td>
                    </tr>
                    <tr>
                        <td>{{ $items->contract_person_1  }}</td>
                    </tr>
                    <tr>
                        <td>{{ $items->contract_person_2  }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6">
                <table class=" float-right">
                    <tr>
                        <td class="text-center"> - - - - -</td>
                    </tr>
                    <tr>
                        <td>Authorized Signature</td>
                    </tr>
                </table>
            </div>

        </div>


    </div>
@stop


