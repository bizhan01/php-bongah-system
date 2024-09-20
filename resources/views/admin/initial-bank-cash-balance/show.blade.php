@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = " Initial Bank Cash Balance";
$createItemName = "Show" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-balance-scale";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Transaction';
$ParentRouteName = 'initial_bank_cash_balance';




$transaction = new \App\Transaction();


?>

@section('title')
    {{ $moduleName }}->{{ $createItemName }}
@stop

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop
@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="block-header pull-left">
                <a class="btn btn-sm btn-info waves-effect" href="{{ route($ParentRouteName) }}">Back</a>
            </div>

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route($ParentRouteName) }}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="{{ $breadcrumbMainIcon  }} "></i>{{  $breadcrumbMainName }}</a>
                </li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon  }}</i> {{ $breadcrumbCurrentName  }}</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h3>{{ $moduleName }} ( {{ str_pad($items[0]->voucher_no, 4, '0', STR_PAD_LEFT)  }} )
                                Information</h3>
                        </div>

                        <div class="body">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td> Project Name: &nbsp; <span class="text-bold">{{ App\Transaction::find($items[0]->id)->Branch->name }}</span> </td>
                                    <td>Particulars: &nbsp; <span class="text-bold">{{ $items[0]->particulars  }}</span>  </td>
                                    <td> Voucher Date: &nbsp; <span class="text-bold">{{ date(config('settings.date_format'), strtotime($items[0]->voucher_date)) }}</span> </td>
                                </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="body">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Made Of Payment</th>
                                    <th>C.Q No</th>
                                    <th>Amount ( <?php echo (config('settings.is_code')=='code') ?
                                            config('settings.currency_code') :  config('settings.currency_symbol')  ?> )</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $dr_total_amount = 0; ?>
                                <?php $cr_total_amount = 0; ?>
                                @foreach($items as $item)

                                    <?php
                                    $dr_total_amount += $item->dr;

                                    $cr_total_amount += $item->cr;
                                    ?>

                                    <tr>

                                        <td>{{ App\Transaction::find($item->id)->BankCash->name }}</td>
                                        <td>{{  $item->cheque_number  }}</td>
                                        <td> <span class="text-bold">{{ $transaction->convert_money_format($item->cr)  }}  =/</span></td>

                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="2" class="text-right">Total=</th>
                                    <th>{{ $transaction->convert_money_format($cr_total_amount)  }} =/</th>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="body">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td>Created By: &nbsp; <span class="text-bold">{{ $items[0]->created_by  }}</span>  </td>
                                    <td>Created at: &nbsp; <span class="text-bold">{{ date( config('settings.date_format').' h:i:s',
                                    strtotime($items[0]->created_at)) }}</span>  </td>
                                    <td>Deleted By: &nbsp; <span class="text-bold">{{ $items[0]->deleted_by }}</span> </td>
                                    <td>Modified by: &nbsp; <span class="text-bold">{{ $items[0]->updated_by  }}</span> </td>
                                    <td>Modified at: &nbsp; <span class="text-bold">{{  date( config('settings.date_format').' h:i:s', strtotime($items[0]->updated_at))  }}</span> </td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- #END# Inline Layout | With Floating Label -->
            </div>

        </div>
    </section>

@stop

@push('include-css')

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



    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
          rel="stylesheet"/>

    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet"/>


    <!-- noUISlider Css -->
    <link href="{{ asset('asset/plugins/nouislider/nouislider.min.css') }}" rel="stylesheet"/>

    <!-- Sweet Alert Css -->
    <link href="{{ asset('asset/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet"/>


@endpush

@push('include-js')


    <!-- Moment Plugin Js -->
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>


    <!-- Sweet Alert Plugin Js -->
    <script src="{{ asset('asset/plugins/sweetalert/sweetalert.min.js') }}"></script>


    <!-- Autosize Plugin Js -->
    <script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>

    <script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>



@endpush

