@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = " Initial Bank Cash Balance";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Create";

$breadcrumbMainIcon = "fas fa-balance-scale";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Transaction';
$ParentRouteName = 'initial_bank_cash_balance';


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
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
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
                            <h2 class="m-b-20">
                                {{ $createItemName  }}
                                <smAll>Put {{ $moduleName  }} Information</smAll>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.store') }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">

                                        <div class="row clearfix">
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 field_area">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select data-live-search="true" class="form-control show-tick"
                                                                name="branch_id">
                                                            <option value="0">Select Project Name</option>
                                                            @if (App\Branch::All()->count() >0 )
                                                                @foreach( App\Branch::All() as $project )
                                                                    <option @if ( $project->id == old('branch_id' ))
                                                                            selected
                                                                            @endif value="{{ $project->id  }}">{{ $project->name  }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 field_area">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select data-live-search="true" class="form-control show-tick"
                                                                name="bank_cash_id"
                                                                id="">
                                                            <option value="0"> Select Bank Or Cash Name </option>
                                                            @if (App\BankCash::All()->count() >0 )
                                                                @foreach( App\BankCash::All() as $bank_cash )
                                                                    <option @if ( $bank_cash->id == old('bank_cash_id' ))
                                                                            selected
                                                                            @endif value="{{ $bank_cash->id  }}">{{ $bank_cash->name  }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input name="cheque_number"
                                                               type="text"
                                                               class="form-control">
                                                        <label class="form-label">Cheque Number</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autocomplete="off" value="{{ old('amount') }}" name="amount"
                                                           type="number"
                                                           class="form-control">
                                                    <label class="form-label">Amount</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line " id="bs_datepicker_container1">
                                                    <input autocomplete="off" value="{{ old('voucher_date') }}"
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
                                                              name="particulars">{{ old('particulars')  }}</textarea>
                                                    <label class="form-label">Particulars</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    Create
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



        // Validation and calculation on Cr Voucher
        var UiController = (function () {

            var DOMString = {
                submit_form: 'form.form',

                field_area: '.field_area',

                project_id: 'select[name=branch_id]',
                bankcash_id: 'select[name=bank_cash_id]',

                cheque_number: 'input[name=cheque_number]',

                amount: 'input[name=amount]',

                date: 'input[name=voucher_date]',
                particulars: 'textarea[name=particulars]',

                drCloset: '.dr',


            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),

                        get_project_id: document.querySelector(DOMString.project_id),

                        get_bankcash_id: document.querySelector(DOMString.bankcash_id),

                        get_cheque_number: document.querySelector(DOMString.cheque_number),
                        get_amount: document.querySelector(DOMString.amount),

                        get_date: document.querySelector(DOMString.date),
                        get_particulars: document.querySelector(DOMString.particulars),

                    }
                },
                getValues: function () {
                    var Fields = this.getFields();
                    return {
                        project_id: Fields.get_project_id.value == "" ? 0 : parseFloat(Fields.get_project_id.value),

                        bankcash_id: Fields.get_bankcash_id.value == "" ? 0 : parseFloat(Fields.get_bankcash_id.value),

                        cheque_number: Fields.get_cheque_number.value == "" ? 0 : parseFloat(Fields.get_cheque_number.value),

                        amount: Fields.get_amount.value == "" ? 0 : parseFloat(Fields.get_amount.value),

                        date: Fields.get_date.value == "" ? 0 : Fields.get_date.value,
                        particulars: Fields.get_particulars.value == "" ? 0 : Fields.get_particulars.value,

                    }
                },

                hide: function (Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);

                    if (Area) {
                        var fields=this.getFields();
                        fields.get_cheque_number.value=null;
                        Area.style.display = 'none';
                    }
                },
                show: function (Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);
                    if (Area) {
                        Area.style.display = 'block';
                    }
                },

            }
        })();


        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var Values;
            Values = UICnt.getValues();


            var setUpEventListner = function () {
                Fields.get_form.addEventListener('submit', validation);

                Fields.get_bankcash_id.addEventListener('change', function () {
                    bankcashChange(this.value);
                });


            };

            var validation = function (e) {
                var Values, Fields;
                Values = UICnt.getValues();
                Fields = UICnt.getFields();


                if (Values.project_id == 0) {
                    toastr["error"]('Select  branch name');
                    e.preventDefault();
                }

                if (Values.bankcash_id == 0) {
                    toastr["error"]('Select Bank Cash Name ');
                    e.preventDefault();
                }


                if (Values.amount == 0) {
                    toastr["error"]('Amount is required');
                    e.preventDefault();
                }

                if (Values.date == 0) {
                    toastr["error"]('Date is required');
                    e.preventDefault();
                }

            };

            var bankcashChange = function (bankcashID) {

                if (bankcashID <= 1) {
                    UICnt.hide(Fields.get_cheque_number);
                } else {
                    UICnt.show(Fields.get_cheque_number);
                }

            };


            return {
                init: function () {
                    console.log("App Is running");
                    setUpEventListner();

                    // Default hide fields

                    var Fields = UICnt.getFields();
                    UICnt.hide(Fields.get_cheque_number);

                }
            }

        })(UiController);

        MainController.init();


    </script>

@endpush
