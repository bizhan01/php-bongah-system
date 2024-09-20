@extends('layouts.app')

{{--Important Variables--}}

<?php


$moduleName = " Product Manage";
$createItemName = "show" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " show";

$breadcrumbMainIcon = "fas fa-boxes";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Product';
$ParentRouteName = 'product';



$curency_symble=(config('settings.is_code') == 'code') ? config('settings.currency_code') : config('settings.currency_symbol');

$transaction = new \App\Transaction();
?>

@section('title')
    نمایش اطلاعات فایل
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
                <a class="btn btn-sm btn-info waves-effect" href="{{ url()->previous() }}">بازگشت</a>
            </div>

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route($ParentRouteName) }}"><i class="material-icons">home</i> صفحه اصلی</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="{{ $breadcrumbMainIcon  }} "></i> فایل ها</a>
                </li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon  }}</i> مشاهده اطلاعات فایل</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table  table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>عنوان</th>
                                                <th>توضیحات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>کد یکتا فایل</td>
                                                    <td>{{ $items->product_unique_id }}</td>
                                                </tr>
                                                <tr>
                                                    <td>نوع فایل</td>
                                                    <td>{{ App\Product::find($items->id)->branch->name }}</td>
                                                </tr>

                                                <tr>
                                                    <td>مدل فایل</td>
                                                    <td>{{ $items->flat_type }}</td>
                                                </tr>
                                                <tr>
                                                    <td>شماره طبقه</td>
                                                    <td>{{ $items->floor_number }}</td>
                                                </tr>

                                                <tr>
                                                    <td>متراژ</td>
                                                    <td>{{ $items->flat_size }}</td>
                                                </tr>

                                                <tr>
                                                    <td>قیمت واحد ( {{ $curency_symble }} ) </td>
                                                    <td>{{ $transaction->convert_money_format($items->unite_price) }}</td>
                                                </tr>

                                                <tr class="text-bold">
                                                    <td>جمع کل( {{ $curency_symble }} ) </td>
                                                    <td>{{ $transaction->convert_money_format($items->total_flat_price) }}</td>
                                                </tr>

                                                <tr>
                                                    <td>پارکینگ </td>
                                                    <td>{{ $transaction->convert_money_format($items->car_parking_charge) }}</td>
                                                </tr>

                                                <tr>
                                                    <td>امکانات </td>
                                                    <td>{{ $transaction->convert_money_format($items->utility_charge) }}</td>
                                                </tr>

                                                <tr>
                                                    <td>شارژ ماهیانه( {{ $curency_symble }} ) </td>
                                                    <td>{{ $transaction->convert_money_format($items->additional_work_charge) }}</td>
                                                </tr>

                                                <tr>
                                                    <td>سایر امکانات </td>
                                                    <td>{{ $transaction->convert_money_format($items->other_charge) }}</td>
                                                </tr>

                                                <tr>
                                                    <td>کسورات( {{ $curency_symble }} ) </td>
                                                    <td>{{ $transaction->convert_money_format($items->discount_or_deduction) }}</td>
                                                </tr>

                                                <tr>
                                                    <td>اجاره( {{ $curency_symble }} ) </td>
                                                    <td>{{ $transaction->convert_money_format($items->refund_additional_work_charge) }}</td>
                                                </tr>

                                                <tr class="text-bold">
                                                    <td>قیمت تمام شده( {{ $curency_symble }} ) </td>
                                                    <td>{{ $transaction->convert_money_format($items->net_sells_price) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>توضیحات</td>
                                                    <td>{{ $items->description }}</td>
                                                </tr>

                                                <tr>
                                                    <td>تصویر محصول</td>
                                                <td><img width="50" height="50" src="{{ asset($items->product_img) }}" alt=""></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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

