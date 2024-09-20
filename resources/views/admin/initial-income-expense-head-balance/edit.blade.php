@extends('layouts.app')

{{--Important Variables--}}

<?php


$moduleName = " Initial Ledger Balance";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-balance-scale";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Transaction';
$ParentRouteName = 'initial_income_expense_head_balance';



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
                <a class="btn btn-sm btn-info waves-effect" href="{{ url()->previous() }}">Back</a>
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
                            <h2>
                                {{ $createItemName  }}
                                <smAll>Edit {{ $moduleName  }} Information</smAll>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.update',['id'=>$item->voucher_no]) }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">

                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control  show-tick"
                                                            name="branch_id"
                                                            id="">
                                                        <option value="0">Select Project Name</option>
                                                        @if (App\Branch::All()->count() >0 )

                                                            @foreach( App\Branch::All() as $branch_id )
                                                                <option @if ( $branch_id->id == $item->branch_id))
                                                                        selected
                                                                        @endif value="{{ $branch_id->id  }}">{{ $branch_id->name  }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control  show-tick"
                                                            name="income_expense_head_id"
                                                            id="">
                                                        <option value="0">Select Income/Expense Head Head</option>
                                                        @if (App\IncomeExpenseHead::All()->count() >0 )

                                                            @foreach( App\IncomeExpenseHead::All() as
                                                            $income_expense_head_id )
                                                                <option @if ( $income_expense_head_id->id ==
                                                                $item->income_expense_head_id )
                                                                        selected
                                                                        @endif value="{{ $income_expense_head_id->id  }}">{{ $income_expense_head_id->name  }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $item->amount }}" name="amount"
                                                           type="number"
                                                           class="form-control">
                                                    <label class="form-label">Amount</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line " id="bs_datepicker_container1">
                                                    <input autocomplete="off" value="{{ $item->voucher_date }}"
                                                           name="voucher_date" type="text"
                                                           class="form-control"
                                                           placeholder="Please choose a voucher date...">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea class="form-control"
                                                              name="particulars">{{ $item->particulars  }}</textarea>
                                                    <label class="form-label">Particulars</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    Update
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
                income_expense_head_id: 'select[name=income_expense_head_id]',

                amount: 'input[name=amount]',
                voucher_date: 'input[name=voucher_date]',

            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_branch_id: document.querySelector(DOMString.branch_id),
                        get_income_expense_head_id: document.querySelector(DOMString.income_expense_head_id),
                        get_amount: document.querySelector(DOMString.amount),
                        get_voucher_date: document.querySelector(DOMString.voucher_date),

                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {

                        branch_id: Fields.get_branch_id.value == "" ? 0 : Fields.get_branch_id.value,
                        income_expense_head_id: Fields.get_income_expense_head_id.value == "" ? 0 : Fields.get_income_expense_head_id.value,
                        amount: Fields.get_amount.value == "" ? 0 : Fields.get_amount.value,
                        voucher_date: Fields.get_voucher_date.value == "" ? 0 : Fields.get_voucher_date.value,

                    }
                },

            }
        })();

        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function () {

                Fields.get_form.addEventListener('submit', validation);

            };

            var validation = function (e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();




                if (input_values.voucher_date == 0) {
                    toastr["error"]('Set Voucher Date');
                    e.preventDefault();
                }

                if (input_values.amount == 0) {
                    toastr["error"]('Set Amount');
                    e.preventDefault();
                }

                if (input_values.income_expense_head_id == 0) {
                    toastr["error"]('Select Income Expense Head Name');
                    e.preventDefault();
                }

                if (input_values.branch_id == 0) {
                    toastr["error"]('Select Branch Name');
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
