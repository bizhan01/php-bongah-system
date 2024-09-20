@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = " Actual Payment Manage";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Create";

$breadcrumbMainIcon = "fas fa-user-graduate";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\ScheduleReceivable';
$ParentRouteName = 'receivable_schedule';


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
                <a class="btn btn-sm btn-info waves-effect"
                   href="{{ route('schedule_manage',['sells_id'=>$sells_id]) }}">Back</a>
            </div>

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href=""><i class="material-icons">home</i> Home</a></li>
                <li><a href="{{ route('sell') }}"> <i class="fas fa-dolly"></i> Sell</a></li>
                <li><a href="{{ route('schedule_manage',['id'=>$sells_id]) }}"><i class="material-icons">schedule</i>
                        Schedule Manage</a></li>
                <li class="active"><i class="material-icons">archive</i> Create</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ $createItemName  }}
                                <smAll>Put {{ $moduleName  }} Information</smAll>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route('actual_payment.store',['sells_id'=>$sells_id]) }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">

                                                    @php
                                                        $terms = [
                                                            'Booking Money'=>'Booking Money',
                                                            'Down Payment'=>'Down Payment',
                                                            'Additional Payment'=>'Additional Payment',
                                                            'Utility Charge'=>'Utility Charge',
                                                            'Other Charge'=>'Other Charge',
                                                            '1st InstAllment'=>'1st InstAllment',
                                                            '2nd InstAllment'=>'2nd InstAllment',
                                                            '3rd InstAllment'=>'3rd InstAllment',
                                                            '4th InstAllment'=>'4th InstAllment',
                                                            '5th InstAllment'=>'5th InstAllment',
                                                            '6th InstAllment'=>'6th InstAllment',
                                                            '7th InstAllment'=>'7th InstAllment',
                                                            '8th InstAllment'=>'8th InstAllment',
                                                            '9th InstAllment'=>'9th InstAllment',
                                                            '10th InstAllment'=>'10th InstAllment',
                                                            '11th InstAllment'=>'11th InstAllment',
                                                            '12th InstAllment'=>'12th InstAllment',
                                                            '13th InstAllment'=>'13th InstAllment',
                                                            '14th InstAllment'=>'14th InstAllment',
                                                            '15th InstAllment'=>'15th InstAllment',
                                                            '16th InstAllment'=>'16th InstAllment',
                                                            '17th InstAllment'=>'17th InstAllment',
                                                            '18th InstAllment'=>'18th InstAllment',
                                                            '19th InstAllment'=>'19th InstAllment',
                                                            '20th InstAllment'=>'20th InstAllment',
                                                        ];
                                                    @endphp

                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="term">
                                                        <option value="0">Select Term Name</option>
                                                        @foreach(  $terms as $term )
                                                            <option @if ( $term == old('term' ))
                                                                    selected
                                                                    @endif value="{{ $term  }}">{{ $term  }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('received_amount')  }}" name="received_amount"
                                                           type="number"
                                                           class="form-control">
                                                    <label class="form-label">Received Amount</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('adjustment')  }}" name="adjustment"
                                                           type="number"
                                                           class="form-control">
                                                    <label class="form-label">Adjustment</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <label class="form-label">Actual Amount</label>
                                                <div class="form-line">
                                                    <input readonly value="{{ old('actual_amount')  }}"
                                                           name="actual_amount" type="number"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <label class="form-label">Made of Payment</label>
                                                <div class="form-line">
                                                    <input value="{{ old('made_of_payment')  }}" name="made_of_payment"
                                                           type="text"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <label class="form-label">Cheque No</label>
                                                <div class="form-line">
                                                    <input value="{{ old('cheque_no')  }}" name="cheque_no" type="text"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('bank_name')  }}" name="bank_name" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Bank Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <label class="form-label">Date Of Collection</label>
                                                    <input autocomplete="off" value="{{ old('date_of_collection') }}"
                                                           name="date_of_collection"
                                                           type="text"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">

                                                    <textarea class="form-control" name="remark"
                                                              id="">{{ old('remark') }}</textarea>
                                                    <label class="form-label">Remark</label>
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



        // Validation and calculation
        var UiController = (function () {

            var DOMString = {
                submit_form: 'form.form',

                term: 'select[name=term]',
                received_amount: 'input[name=received_amount]',
                adjustment: 'input[name=adjustment]',
                actual_amount: 'input[name=actual_amount]',
                date_of_collection: 'input[name=date_of_collection]',
            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),

                        get_term: document.querySelector(DOMString.term),
                        get_received_amount: document.querySelector(DOMString.received_amount),
                        get_adjustment: document.querySelector(DOMString.adjustment),
                        get_actual_amount: document.querySelector(DOMString.actual_amount),
                        get_date_of_collection: document.querySelector(DOMString.date_of_collection),
                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {
                        term: Fields.get_term.value == "" ? 0 : Fields.get_term.value,
                        received_amount: Fields.get_received_amount.value == "" ? 0 : parseFloat(Fields.get_received_amount.value),
                        adjustment: Fields.get_adjustment.value == "" ? 0 : parseFloat(Fields.get_adjustment.value),
                        actual_amount: Fields.get_actual_amount.value == "" ? 0 : parseFloat(Fields.get_actual_amount.value),
                        date_of_collection: Fields.get_date_of_collection.value == "" ? 0 : Fields.get_date_of_collection.value,
                    }
                },

            }
        })();

        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function () {

                Fields.get_form.addEventListener('submit', validation);

                Fields.get_received_amount.addEventListener('keyup', ActualAmount);
                Fields.get_adjustment.addEventListener('keyup', ActualAmount);

            };

            var ActualAmount = function () {

                var input_values, Fields, received_amount, adjustment, actual_amount;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();

                received_amount = input_values.received_amount;
                adjustment = input_values.adjustment;

                actual_amount = received_amount - adjustment;

                total_actual_amount = received_amount - adjustment;
                Fields.get_actual_amount.value = total_actual_amount;
                console.log(total_actual_amount);
            }


            var validation = function (e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();

                if (input_values.date_of_collection == 0) {
                    toastr["error"]('Date Of Collection Is Required');
                    e.preventDefault();
                }

                if (input_values.actual_amount == 0) {
                    toastr["error"]('Actual Amount Is Required');
                    e.preventDefault();
                }

                if (input_values.received_amount == 0) {
                    toastr["error"]('Received Amount Is Required');
                    e.preventDefault();
                }


                if (input_values.term == 0) {
                    toastr["error"]('Term Is Required');
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
