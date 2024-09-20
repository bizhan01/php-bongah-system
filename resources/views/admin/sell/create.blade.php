@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = " Sell Manage";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Create";

$breadcrumbMainIcon = "fas fa-dolly";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Sell';
$ParentRouteName = 'sell';


?>

@section('title')
    فروش فایل
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
                                class="{{ $breadcrumbMainIcon  }} "></i>مدیریت فروش</a>
                </li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon  }}</i>فروش فایل</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                فروش فایل
                                <smAll>اطلاعات فروش فایل را وارد کنید</smAll>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.store') }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="customer_id">
                                                        <option value="0">نام مشتری را انتخاب کنید</option>

                                                        @foreach( App\Customer::All() as $customer )
                                                            <option @if ( $customer->id == old('customer_id' ))
                                                                    selected
                                                                    @endif value="{{ $customer->id  }}">{{ $customer->name  }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="branch_id">
                                                        <option value="0">مدل فایل را انتخاب کنید</option>

                                                        @foreach( App\Branch::All() as $branch )
                                                            <option @if ( $branch->id == old('branch_id' ))
                                                                    selected
                                                                    @endif value="{{ $branch->id  }}">{{ $branch->name  }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select id="product_id" data-live-search="true"
                                                            class="form-control show-tick"
                                                            name="product_id">

                                                        <option value="0">فایل فروخته شده را انتخاب کنید</option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="employee_id">
                                                        <option value="0">نام کارمند فروشنده را انتخاب کنید</option>

                                                        @foreach( App\Employee::All() as $employee )
                                                            <option @if ( $employee->id == old('employee_id' ) )
                                                                    selected
                                                                    @endif value="{{ $employee->id  }}">{{ $employee->name  }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="{{ old('sells_date') }}"
                                                           name="sells_date"
                                                           type="text"
                                                           class="form-control"
                                                           placeholder=" تاریخ فروش">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    ثبت فروش
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                </form>

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



        // Validation and calculation
        var UiController = (function () {

            var DOMString = {
                submit_form: 'form.form',

                branch_id: 'select[name=branch_id]',
                customer_id: 'select[name=customer_id]',
                employee_id: 'select[name=employee_id]',
                product_id: 'select[name=product_id]',
                sells_date: 'input[name=sells_date]',


            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),

                        get_branch_id: document.querySelector(DOMString.branch_id),
                        get_customer_id: document.querySelector(DOMString.customer_id),
                        get_employee_id: document.querySelector(DOMString.employee_id),

                        get_product_id: document.querySelector(DOMString.product_id),

                        get_sells_date: document.querySelector(DOMString.sells_date),


                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {

                        branch_id: Fields.get_branch_id.value == "" ? 0 : parseFloat(Fields.get_branch_id.value),
                        customer_id: Fields.get_customer_id.value == "" ? 0 : parseFloat(Fields.get_customer_id.value),
                        employee_id: Fields.get_employee_id.value == "" ? 0 : parseFloat(Fields.get_employee_id.value),
                        product_id: Fields.get_product_id.value == "" ? 0 : parseFloat(Fields.get_product_id.value),
                        sells_date: Fields.get_sells_date.value == "" ? 0 : Fields.get_sells_date.value,


                    }
                },

            }
        })();

        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function () {

                Fields.get_form.addEventListener('submit', validation);

                Fields.get_branch_id.addEventListener('change', product_changed);

            };

            var product_changed = function (e) {
                var branch_id = e.target.value;
                $("#product_id").empty();
                let option = `<option value="0">Select Product ID</option>`;

                $("#product_id").html(option);
                $("#product_id").selectpicker('refresh');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "{{ route('sell.branch.change') }}",
                    data: {id: branch_id},
                    success: function (data) {

                        $("#product_id").selectpicker('refresh');
                        /* for (var key of Object.keys(data)) {

                            console.log(key + " -> " + data[key]);
                            Fields.get_product_id.innerHTML


                        } */

                        $("#product_id").empty();
                        let option = `<option value="0">Select Product ID</option>`;

                        for (let [key, value] of Object.entries(data)) {

                            option += `<option value="${value}">${value}</option>`;
                            $("#product_id").html(option);
                            $("#product_id").selectpicker('refresh');
                        }

                    }
                });


            }


            var validation = function (e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();

                if (input_values.sells_date == 0) {
                    toastr["error"]('Sells Date is Required');
                    e.preventDefault();
                }

                if (input_values.employee_id == 0) {
                    toastr["error"]('Employee is Required');
                    e.preventDefault();
                }

                if (input_values.product_id == 0) {
                    toastr["error"]('Product is Required');
                    e.preventDefault();
                }

                if (input_values.branch_id == 0) {
                    toastr["error"]('Project is Required');
                    e.preventDefault();
                }


                if (input_values.customer_id == 0) {
                    toastr["error"]('Customer is Required');
                    e.preventDefault();
                }


            };

            return {
                init: function () {
                    console.log("App Is running");
                    setUpEventListner();

                }
            }

        })(UiController);

        MainController.init();


    </script>

@endpush
