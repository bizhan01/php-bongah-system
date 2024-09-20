@extends('layouts.app')


@section('title')
    Schedule Manage
@stop

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop


@php
    $curency_symble=(config('settings.is_code') == 'code') ? config('settings.currency_code') : config('settings.currency_symbol');
    $transaction = new \App\Transaction();

@endphp

@section('content')


    <section class="content">
        <div class="container-fluid">

            <div class="block-header">
                <h3 class="text-center">Receivable Schedule Manage (
                    <span data-toggle="tooltip" data-placement="top"
                          title="Project Name"> {{ $items['branch']->name }} </span> ||

                    <span data-toggle="tooltip" data-placement="top"
                          title="Customer Name"> {{ $items['customer']->name }} </span> ||

                    <span data-toggle="tooltip" data-placement="top"
                          title="Product ID">  {{ $items['product']->product_unique_id }} </span> ||
                    <span data-toggle="tooltip" data-placement="top"
                          title="Net Sells Price ( {{ $curency_symble }} )">  {{ $transaction->convert_money_format($items['product']->net_sells_price) }} </span>
                    )

                </h3>
            </div>

            <div class="row block-header">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="text-left">
                        <a class="btn btn-sm btn-info waves-effect" href="{{ route('sell') }}">Back</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="text-center">
                        @php
                            if($items['due_amount'] > 0 ){
                                $class= 'btn-danger';
                            }else{
                               $class= 'btn-success'; 
                            }
                        @endphp

                        <a class="btn btn-sm {{ $class }}  waves-effect font-weight-bold"> <b class="font-s-16"> Till
                                Due Amount: {{ $transaction->convert_money_format($items['due_amount'])  }}
                                ( {{ $curency_symble }} )</b></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="text-right">
                        <a class="btn btn-sm btn-info waves-effect"
                           href="{{ route('receivable_schedule.create', ['selles_id'=>$items['sells_id']]) }}">Add
                            Schedule </a>
                    </div>

                </div>
            </div>

            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <table class="table table-striped table-sm table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Term</th>
                                <th scope="col">Payable Amount ( {{ $curency_symble }} )</th>
                                <th scope="col">Cumulative Receivable Amount ( {{ $curency_symble }} )</th>
                                <th scope="col">Schedule Date</th>
                                <th scope="col">Option</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $id= 1;
                                $comulative_payable_amount=0;
                            @endphp

                            @if (count($items['ScheduleReceivable']) > 0 )

                                @foreach ($items['ScheduleReceivable'] as $ScheduleReceivable)

                                    @php
                                        $payable_amount= $ScheduleReceivable->payable_amount;
                                        $comulative_payable_amount += $payable_amount;
                                    @endphp

                                    <tr>
                                        <th class="text-center" scope="row">{{ $id }}</th>
                                        <td>{{ $ScheduleReceivable->term }}</td>
                                        <td>{{ $transaction->convert_money_format($ScheduleReceivable->payable_amount) }}</td>

                                        <td>{{ $transaction->convert_money_format($comulative_payable_amount) }} </td>
                                        <td>{{ date(config('settings.date_format'), strtotime($ScheduleReceivable->schedule_date)) }}  </td>
                                        <td class="tdTrashAction">
                                            <a class="btn btn-xs btn-info waves-effect m-b-4"
                                               href="{{ route('receivable_schedule.edit',['id'=> $ScheduleReceivable->id , 'selles_id'=> $items['sells_id'] ])}}"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Edit"><i
                                                        class="material-icons">mode_edit</i></a>

                                            <a onclick="return confirm('Are you sure you want to delete this item?');"
                                               class="btn btn-xs btn-danger waves-effect m-b-4"
                                               href="{{ route('receivable_schedule.destroy',['id'=> $ScheduleReceivable->id ]) }}"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Trash"> <i
                                                        class="material-icons">delete</i></a>

                                        </td>
                                    </tr>

                                    @php
                                        $id++;
                                    @endphp
                                @endforeach


                            @else

                                <tr>
                                    <th colspan="6" class="text-danger text-center" scope="col">There Has No Received
                                        Schedule
                                    </th>
                                </tr>

                            @endif

                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Term</th>
                                <th scope="col">Payable Amount ( {{ $curency_symble }} )</th>
                                <th scope="col">Cumulative Receivable Amount ( {{ $curency_symble }} )</th>
                                <th scope="col">Schedule Date</th>
                                <th scope="col">Option</th>
                            </tr>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


            <div class="block-header">
                <h3 class="text-center">Actual Received Manage (
                    <span data-toggle="tooltip" data-placement="top"
                          title="Project Name"> {{ $items['branch']->name }} </span> ||

                    <span data-toggle="tooltip" data-placement="top"
                          title="Customer Name"> {{ $items['customer']->name }} </span> ||

                    <span data-toggle="tooltip" data-placement="top"
                          title="Product ID">  {{ $items['product']->product_unique_id }} </span> ||
                    <span data-toggle="tooltip" data-placement="top"
                          title="Net Sells Price ( {{ $curency_symble }} )">  {{ $transaction->convert_money_format($items['product']->net_sells_price) }} </span>
                    )

                </h3>
            </div>


            <div class="block-header pull-left">
                <a class="btn btn-sm btn-info waves-effect" href="{{ route('sell') }}">Back</a>
            </div>

            <div class="block-header pull-right">
                <a class="btn btn-sm btn-info waves-effect"
                   href="{{ route('actual_payment.create', ['selles_id'=>$items['sells_id']] ) }}">Add Actual </a>
            </div>


            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <table class="table table-striped table-sm table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Term</th>
                                <th scope="col">Received Amount ( {{ $curency_symble }} )</th>

                                <th scope="col">Adjustment ( {{ $curency_symble }} )</th>
                                <th scope="col">Actual Amount ( {{ $curency_symble }} )</th>

                                <th scope="col">Date of Collection</th>
                                <th scope="col">Made of Payment</th>
                                <th scope="col">Cheque No</th>
                                <th scope="col">Bank Name</th>
                                <th scope="col">Remark</th>

                                <th scope="col">Option</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $id= 1;
                                $total_received_amount=0;
                                $total_adjustment=0;
                                $total_actual_amount=0;
                            @endphp

                            @if (count($items['ActualReceived']) > 0 )



                                @foreach ($items['ActualReceived'] as $ScheduleReceivable)

                                    @php
                                        $total_received_amount +=$ScheduleReceivable->received_amount;
                                        $total_adjustment +=$ScheduleReceivable->adjustment;
                                        $total_actual_amount +=$ScheduleReceivable->actual_amount;
                                    @endphp
                                    <tr>
                                        <th class="text-center" scope="row">{{ $id }}</th>
                                        <td>{{ $ScheduleReceivable->term }}</td>
                                        <td>{{ $transaction->convert_money_format($ScheduleReceivable->received_amount) }}</td>

                                        <td>{{ $transaction->convert_money_format($ScheduleReceivable->adjustment) }} </td>
                                        <td>{{ $transaction->convert_money_format($ScheduleReceivable->actual_amount) }} </td>

                                        <td>{{ date(config('settings.date_format'), strtotime($ScheduleReceivable->date_of_collection)) }}  </td>
                                        <td>{{ $ScheduleReceivable->made_of_payment }}</td>
                                        <td>{{ $ScheduleReceivable->cheque_no }}</td>
                                        <td>{{ $ScheduleReceivable->bank_name }}</td>
                                        <td>{{ $ScheduleReceivable->remark }}</td>

                                        <td class="tdTrashAction">
                                            <a class="btn btn-xs btn-info waves-effect m-b-4"
                                               href="{{ route('actual_payment.edit',['id'=> $ScheduleReceivable->id , 'selles_id'=> $items['sells_id'] ])}}"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Edit"><i
                                                        class="material-icons">mode_edit</i></a>

                                            <a onclick="return confirm('Are you sure you want to delete this item?');"
                                               class="btn btn-xs btn-danger waves-effect m-b-4"
                                               href="{{ route('actual_payment.destroy',['id'=> $ScheduleReceivable->id ]) }}"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Trash"> <i
                                                        class="material-icons">delete</i></a>

                                        </td>
                                    </tr>

                                    @php
                                        $id++;
                                    @endphp
                                @endforeach

                                <tr class="font-bold">

                                    <td class="text-right" colspan="2"></td>
                                    <td>{{ $transaction->convert_money_format($total_received_amount) }}</td>
                                    <td>{{ $transaction->convert_money_format($total_adjustment) }}</td>
                                    <td>{{ $transaction->convert_money_format($total_actual_amount) }}</td>

                                    <td colspan="6"></td>
                                </tr>

                            @else

                                <tr class="font-bold">
                                    
                                    <td class="text-center text-danger" colspan="11">There Has No Actual Payment</td>
                                    
                                </tr>

                            @endif


                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Term</th>
                                <th scope="col">Received Amount ( {{ $curency_symble }} )</th>

                                <th scope="col">Adjustment ( {{ $curency_symble }} )</th>
                                <th scope="col">Actual Amount ( {{ $curency_symble }} )</th>

                                <th scope="col">Date of Collection</th>
                                <th scope="col">Made of Payment</th>
                                <th scope="col">Cheque No</th>
                                <th scope="col">Bank Name</th>
                                <th scope="col">Remark</th>

                                <th scope="col">Option</th>
                            </tr>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


        </div>
    </section>


@stop

@push('include-css')


    <!-- Wait Me Css -->
    <link href="{{ asset('asset/plugins/waitme/waitMe.css') }}" rel="stylesheet"/>

    <!-- Colorpicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet"/>

    <!-- Dropzone Css -->
    <link href="{{ asset('asset/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{ asset('asset/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="{{ asset('asset/plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('asset/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>

@endpush


@push('include-js')

    {{--<script src="{{ asset('asset/js/pages/ui/modals.js') }}"></script>--}}
    <script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

    <script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>
    <!-- Autosize Plugin Js -->


    <script>
        @if(Session::has('success'))
            toastr["success"]('{{ Session::get('success') }}');
        @endif

                @if(Session::has('error'))
            toastr["error"]('{{ Session::get('error') }}');
        @endif

                @if ($errors->any())
                @foreach ($errors->All() as $error)
            toastr["error"]('{{ $error }}');
        @endforeach
        @endif


    </script>

    {{--All datagrid --}}
    <script src="{{ asset('asset/js/dataTable.js')  }}"></script>
    <script>
        BaseController.init();
    </script>
@endpush