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
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2" scope="col">Customer Information</th>
                        </tr>
                        <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>File No.</td>
                            <td> {{ str_pad($infos['customer']->id, 4, '0', STR_PAD_LEFT)  }} </td>
                        </tr>
                        <tr>
                            <td>Customer Name</td>
                            <td>{{ $infos['customer']->name }}</td>
                        </tr>
                        <tr>
                            <td>Father Or Husband Name</td>
                            <td>{{ $infos['customer']->father_or_husband_name }}</td>
                        </tr>
                        <tr>
                            <td>Contract Address</td>
                            <td>{{ $infos['customer']->mailing_address }}</td>
                        </tr>
                        <tr>
                            <td>Phone No</td>
                            <td>{{ $infos['customer']->phone }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $infos['customer']->email }}</td>
                        </tr>

                        <tr>
                            <td>NID</td>
                            <td>{{ $infos['customer']->nid }}</td>
                        </tr>
                
                    </tbody>
                </table>


                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2" scope="col">Project Information</th>
                        </tr>
                        <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{ $infos['branch']->name }}</td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td>{{ $infos['branch']->location }}</td>
                        </tr>
                        <tr>
                            <td>Facing</td>
                            <td>{{ $infos['branch']->facing }}</td>
                        </tr>
                        <tr>
                            <td>Apt Type</td>
                            <td>{{  $infos['product']->flat_type  }}</td>
                        </tr>

                        <tr>
                            <td>Apt Size</td>
                            <td>{{  $infos['product']->flat_size  }}</td>
                        </tr>
                        
                        <tr>
                            <td>Unite Price</td>
                            <td>{{ $transaction->convert_money_format( $infos['product']->unite_price)  }}</td>
                        </tr>

                    </tbody>
                </table>


            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2" scope="col">Apartment Value Summery</th>
                        </tr>
                        <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $apartMentPrice=$infos['product']->total_flat_price;
                            $discount_or_deduction=$infos['product']->discount_or_deduction;
                            $total_price=$apartMentPrice-$discount_or_deduction;

                            $total_apartment_value=$total_price+$infos['product']->car_parking_charge+$infos['product']->utility_charge;



                        @endphp

                        <tr>
                            <td>Apartment Price</td>
                            <td>{{ $transaction->convert_money_format($apartMentPrice) }}</td>
                        </tr>
                        <tr>
                            <td>(-) Discount</td>
                            <td>{{ $transaction->convert_money_format($discount_or_deduction) }}</td>

                        </tr>
                        <tr class="font-w-b">
                            <td>Total Price</td>
                            <td>{{ $transaction->convert_money_format($total_price) }}</td>

                        </tr>
                        <tr>
                            <td>Parking Charge</td>
                            <td>{{ $transaction->convert_money_format($infos['product']->car_parking_charge) }}</td>

                        </tr>
                        <tr>
                            <td>Utility Charge</td>
                            <td>{{ $transaction->convert_money_format($infos['product']->utility_charge) }}</td>

                        </tr>

                        <tr class="font-w-b">
                            <td>Total Apartment Value</td>
                            <td>{{ $transaction->convert_money_format($total_apartment_value) }}</td>
                        </tr>
                        <tr>
                            <td>Additional Work Charge</td>
                            <td>{{ $transaction->convert_money_format($infos['product']->additional_work_charge) }}</td>
                        </tr>

                        <tr>
                            <td>Other Charge</td>
                            <td>{{ $transaction->convert_money_format($infos['product']->other_charge) }}</td>

                        </tr>
                        <tr>
                            <td>Refund Additional Work Charge</td>
                            <td>{{ $transaction->convert_money_format($infos['product']->refund_additional_work_charge) }}</td>

                        </tr>
                        <tr class="font-w-b">
                            <td>Total Apt Value with Additional Charge</td>
                            <td>{{ $transaction->convert_money_format($infos['product']->net_sells_price) }}</td>
                        </tr>
                        
                    </tbody>
                </table>



                <table class="table table-striped table-bordered table-sm">
                    
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2" scope="col">Project Information</th>
                        </tr>
                        <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Floor</td>
                            <td>{{  $infos['product']->floor_number  }}</td>
                        </tr>

                        <tr>
                            <td>Sales Date</td>
                            <td>{{ $transaction->date_format( $infos['sells']->sells_date)  }}</td>
                        </tr>
                        <tr>
                            <td>Handover Date</td>
                            <td> {{ $transaction->date_format( $infos['branch']->hand_over_date)  }} </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <div class="mid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2" scope="col">Payment History</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="3" scope="col">Schedule Payment</th>
                        </tr>

                        <tr>
                            <th class="text-center" scope="col">Term</th>
                            <th class="text-center" scope="col">Date</th>
                            <th class="text-center" scope="col">Payable Amount</th>
                        </tr>
                        
                    </thead>
                    <tbody>

                        @php
                            $total_payable_amount = 0;
                        @endphp
                        @foreach ($infos['schedule_receivable'] as $schedule )
                           @php
                               $total_payable_amount +=$schedule->payable_amount;
                           @endphp
                        <tr>
                            <td>{{ $schedule->term }}</td>
                            <td>{{ $transaction->date_format($schedule->schedule_date)  }}</td>
                            <td>{{ $transaction->convert_money_format( $schedule->payable_amount) }}</td>
                        </tr>
                        @endforeach

                        <tr>
                            <th class="text-right" colspan="2" scope="col">Total</th>
                            <th  scope="col">{{ $transaction->convert_money_format( $total_payable_amount) }}</th>
                        </tr>
                        
                    </tbody>
                </table>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="9" scope="col">Actual Payment</th>
                        </tr>

                        <tr>
                            <th class="text-center" scope="col">Term</th>
                            <th data-toggle="tooltip" data-placement="top" title="Date Of Collection" class="text-center" scope="col">Date</th>
                            <th data-toggle="tooltip" data-placement="top" title="Receive Amount ( {{ $transaction->get_currency_code() }} )" class="text-center" scope="col">Receive Amount</th>
                            <th data-toggle="tooltip" data-placement="top" title="Adjustment ( {{ $transaction->get_currency_code() }} )" class="text-center" scope="col">Adjustment</th>
                            <th data-toggle="tooltip" data-placement="top" title="Actual Amount ( {{ $transaction->get_currency_code() }} )" class="text-center" scope="col">Actual Amount</th>
                            <th class="text-center" scope="col">Mode of Payment</th>
                            <th class="text-center" scope="col">Cheque No</th>
                            <th class="text-center" scope="col">Bank Name</th>
                            <th class="text-center" scope="col">Remark</th>
                        </tr>

                    </thead>
                    <tbody>

                        @php
                            $total_received_amount =0;
                            $total_adjustment_amount =0;
                            $total_actual_amount =0;
                        @endphp

                        @foreach ($infos['actual_received_info'] as $actual_received )
                        
                        @php
                            $total_received_amount += $actual_received->received_amount;
                            $total_adjustment_amount += $actual_received->adjustment;
                            $total_actual_amount += $actual_received->actual_amount;
                        @endphp

                        <tr>
                            <td>{{ $actual_received->term }}</td>
                            <td>{{ $transaction->date_format( $actual_received->date_of_collection) }}</td>
                            <td>{{ $transaction->convert_money_format( $actual_received->received_amount) }}</td>
                            <td>{{ $transaction->convert_money_format( $actual_received->adjustment) }}</td>
                            <td>{{ $transaction->convert_money_format( $actual_received->actual_amount) }}</td>
                            <td>{{ $actual_received->made_of_payment }}</td>
                            <td>{{ $actual_received->cheque_no }}</td>
                            <td>{{ $actual_received->bank_name }}</td>
                            <td>{{ $actual_received->remark }}</td>
                        </tr>

                        @endforeach

                        @php
                            $due_amount= $total_payable_amount-$total_actual_amount;
                        @endphp

                        <tr>
                            <th class="text-right" scope="col" colspan="2">Total</th>
                            
                            <th  scope="col">{{ $transaction->convert_money_format( $total_received_amount) }}</th>
                            <th  scope="col">{{ $transaction->convert_money_format( $total_adjustment_amount) }}</th>
                            <th  scope="col">{{ $transaction->convert_money_format( $total_actual_amount) }}</th>

                            <th  scope="col" colspan="4"></th>
                        </tr>

                        <tr>
                            <th class="text-right" scope="col" colspan="4"><h5>Total Recieved Amount : {{ $transaction->convert_money_format( $total_actual_amount) }}</h5> </th>
                            
                            <th  scope="col" colspan="5"> <h5>Due Amount : {{ $transaction->convert_money_format( $due_amount) }} </h5></th>
                        </tr>


                    </tbody>
                </table>
            </div>
            


        </div>
    </div>
        



@stop