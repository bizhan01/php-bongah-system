@extends('layouts.pdf')

@push('include-css')
    <link rel="stylesheet" href="{{ asset('asset/css/main-report.css') }}">
@endpush

@section('title')
    {{ config('settings.company_name')  }} -> {{ $extra['module_name']  }}
@endsection

@section('content')


    <?php
        $transaction = new \App\Transaction();
    ?>


    <div class="mid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
            <br>
            <h2 class="text-center">{{ config('settings.company_name')  }}</h2>
            <h6 class="text-center">{{ config('settings.address_1')  }}</h6>
            <br>
            <h4 class="text-center">{{ $extra['voucher_type']  }}</h4>
            <hr>
            </div>
        </div>
        
    </div>

    <div class="mid">
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Seller Name</th>
                    <th scope="col">Selles Date</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Product No</th>
                    <th scope="col">Apartment Value</th>
                    <th scope="col">Car Parking Charge</th>
                    <th scope="col">Uitility Charge</th>
                    <th scope="col">Additional Work Charge</th>
                    <th scope="col">Other Charge</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Refund Additional Work Charge	</th>
                    <th scope="col">Total</th>
                    <th scope="col">Total Collection</th>
                    <th scope="col">Total Due</th>
                    <th scope="col">Collection ( %  )</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $sl = 1;

                    $total_flat_price = 0;
                    $total_car_parking_charge = 0;
                    $total_utility_charge = 0;
                    $total_additional_work_charge = 0;
                    $total_other_charge = 0;
                    $total_discount_or_deduction = 0;
                    $total_refund_additional_work_charge = 0;
                    $total_net_sells_price = 0;

                    $total_collection1 = 0;
                    $total_due1 = 0;

                @endphp
                @foreach ($infos['items'] as $key=>$item )
                    
                @php
                    $net_sell_price= $item->net_sells_price;
                    $total_collection= $infos['total_collection'][$key];

                    $total_due= $infos['total_collection'][$key] - $total_collection;


                    if($total_collection==0){
                        $collection_percentage =0;
                    }else{
                        $collection_percentage = ($total_collection/$net_sell_price) * 100;
                    }


                    $total_flat_price += $item->total_flat_price;
                    $total_car_parking_charge += $item->car_parking_charge;
                    $total_utility_charge += $item->utility_charge;
                    
                    $total_additional_work_charge += $item->additional_work_charge;
                    $total_other_charge += $item->other_charge;
                    $total_discount_or_deduction += $item->discount_or_deduction;
                    $total_refund_additional_work_charge += $item->refund_additional_work_charge;
                    $total_net_sells_price += $item->net_sells_price;

                    $total_collection1 += $infos['total_collection'][$key];
                    $total_due1 += $infos['total_collection'][$key] - $total_collection;


                @endphp

                <tr>
                    <td>{{ $sl }}</td>
                    <td> {{ $item->customer_name }} </td>
                    <td> {{ $item->employee_name }} </td>
                    <td> {{ $transaction->date_format( $item->sells_date ) }} </td>
                    <td> {{  $item->branch_name }} </td>
                    <td> {{  $item->product_unique_id }} </td>

                    <td> {{ $transaction->convert_money_format( $item->total_flat_price ) }} </td>
                    <td> {{ $transaction->convert_money_format( $item->car_parking_charge ) }} </td>
                    <td> {{ $transaction->convert_money_format( $item->utility_charge ) }} </td>
                    <td> {{ $transaction->convert_money_format( $item->additional_work_charge ) }} </td>
                    <td> {{ $transaction->convert_money_format( $item->other_charge ) }} </td>
                    <td> {{ $transaction->convert_money_format( $item->discount_or_deduction ) }} </td>
                    <td> {{ $transaction->convert_money_format( $item->refund_additional_work_charge ) }} </td>
                    <td> {{ $transaction->convert_money_format( $item->net_sells_price ) }} </td>
                    <td> {{ $transaction->convert_money_format( $infos['total_collection'][$key] ) }} </td>
                    <td> {{ $transaction->convert_money_format(  $total_due ) }} </td>
                    <td> {{ $transaction->convert_money_format(  $collection_percentage ) }} % </td>

                </tr>

                @php
                    $sl++;
                @endphp

                @endforeach


                <tr class="font-w-b">
                    <td class="text-right" colspan="6">Total</td>

                    <td> {{ $transaction->convert_money_format( $total_flat_price ) }} </td>
                    <td> {{ $transaction->convert_money_format( $total_car_parking_charge ) }} </td>
                
                    <td> {{ $transaction->convert_money_format( $total_utility_charge ) }} </td>
                    <td> {{ $transaction->convert_money_format( $total_additional_work_charge ) }} </td>
                    <td> {{ $transaction->convert_money_format( $total_other_charge ) }} </td>
                    <td> {{ $transaction->convert_money_format( $total_discount_or_deduction ) }} </td>
                    <td> {{ $transaction->convert_money_format( $total_refund_additional_work_charge ) }} </td>
                    <td> {{ $transaction->convert_money_format( $total_net_sells_price ) }} </td>
                    <td> {{ $transaction->convert_money_format( $total_collection1 ) }} </td>
                    <td> {{ $transaction->convert_money_format(  $total_due1 ) }} </td>
                    <td> </td>

                </tr>

            </tbody>

        </table>

    </div>

 @stop