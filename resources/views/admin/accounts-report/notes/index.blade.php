@extends('layouts.app')

{{--Important Variables--}}


@section('title')
    {{ config('settings.company_name')  }} -> Notes
@stop

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop
@section('content')

    <section class="content">
        <div class="header">
            <h2 class="text-center">Notes</h2>
            <br>
        </div>
        <div class="container-fluid">
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <!-- Ledger Type Wise Start -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                LEDGER TYPE WISE
                                <smAll>Anything is select show All</smAll>
                            </h2>
                        </div>
                        <br>
                        <div class="body">

                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route('reports.accounts.notes.type_wise.report')  }}">

                                    {{ csrf_field() }}


                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="income_expense_type_code">
                                                    <option value="0">Select Ledger Type Name</option>

                                                    @foreach( App\IncomeExpenseType::All() as $Type )
                                                        <option value="{{ $Type->code  }}">{{ $Type->name  }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="branch_id">
                                                    <option value="0">Select Project Name</option>
                                                    @if (App\Branch::All()->count() >0 )
                                                        @foreach( App\Branch::All() as $Branch )
                                                            <option value="{{ $Branch->id  }}">{{ $Branch->name  }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h2 class="card-inside-title">Period</h2>
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                            <div class="form-line">
                                                <input autocomplete="off" name="start_from" type="text"
                                                       class="form-control"
                                                       placeholder="Date start...">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="start_to" type="text"
                                                       class="form-control"
                                                       placeholder="Date end...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h2 class="card-inside-title">Period</h2>
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container1">
                                            <div class="form-line">
                                                <input autocomplete="off" name="end_from" type="text"
                                                       class="form-control"
                                                       placeholder="Date start...">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="end_to" type="text" class="form-control"
                                                       placeholder="Date end...">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-line">
                                            <input formtarget="_blank" name="action" value="Show" type="submit"
                                                   class="btn btn-primary m-t-15 waves-effect">
                                            <input name="action" value="Pdf" type="submit"
                                                   class="btn btn-primary m-t-15 waves-effect">
                                            <input name="action" value="Excel" type="submit"
                                                   class="btn btn-primary m-t-15 waves-effect">
                                        </div>
                                    </div>

                                </form>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- Ledger Type End -->

                <!-- Ledger Group Start -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                LEDGER GROUP WISE
                                <smAll>Anything is select show All</smAll>
                            </h2>
                        </div>
                        <br>
                        <div class="body">

                            <div class="row clearfix">
                                <form class="form1"  method="post"
                                      action="{{ route('reports.accounts.notes.group_wise.report')  }}">

                                    {{ csrf_field() }}

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="income_expense_group_code">
                                                    <option value="0">Select Ledger Group Name</option>

                                                    @foreach( App\IncomeExpenseGroup::All() as $Group )
                                                        <option value="{{ $Group->code  }}">{{ $Group->name  }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="branch_id">
                                                    <option value="0">Select Project Name</option>
                                                    @if (App\Branch::All()->count() >0 )
                                                        @foreach( App\Branch::All() as $Branch )
                                                            <option value="{{ $Branch->id  }}">{{ $Branch->name  }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h2 class="card-inside-title">Period</h2>
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container2">
                                            <div class="form-line">
                                                <input autocomplete="off" name="start_from1" type="text"
                                                       class="form-control"
                                                       placeholder="Date start...">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="start_to1" type="text"
                                                       class="form-control"
                                                       placeholder="Date end...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h2 class="card-inside-title">Period</h2>
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container3">
                                            <div class="form-line">
                                                <input autocomplete="off" name="end_from1" type="text"
                                                       class="form-control"
                                                       placeholder="Date start...">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="end_to1" type="text" class="form-control"
                                                       placeholder="Date end...">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-line">
                                            <input formtarget="_blank" name="action" value="Show" type="submit"
                                                   class="btn btn-primary m-t-15 waves-effect">
                                            <input name="action" value="Pdf" type="submit"
                                                   class="btn btn-primary m-t-15 waves-effect">
                                            <input name="action" value="Excel" type="submit"
                                                   class="btn btn-primary m-t-15 waves-effect">
                                        </div>
                                    </div>

                                </form>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- Ledger Group End -->


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
                submit_form1: 'form.form1',

                branch_id: 'select[name=branch_id]',
                start_from: 'input[name=start_from]',

                end_from: 'input[name=end_from]',

                start_from1: 'input[name=start_from1]',

                end_from1: 'input[name=end_from1]',



            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_form1: document.querySelector(DOMString.submit_form1),

                        get_start_from: document.querySelector(DOMString.start_from),
                        get_end_from: document.querySelector(DOMString.end_from),

                        get_start_from1: document.querySelector(DOMString.start_from1),
                        get_end_from1: document.querySelector(DOMString.end_from1),

                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {

                        start_from: Fields.get_start_from.value == "" ? 0 : Fields.get_start_from,
                        end_from: Fields.get_end_from.value == "" ? 0 : Fields.get_end_from,

                        start_from1: Fields.get_start_from1.value == "" ? 0 : Fields.get_start_from1,
                        end_from1: Fields.get_end_from1.value == "" ? 0 : Fields.get_end_from1,




                    }
                },

            }
        })();

        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function () {

                Fields.get_form.addEventListener('submit', validation);
                Fields.get_form1.addEventListener('submit', validation1);

            };

            var validation = function (e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();


                if (input_values.start_from == 0) {
                    toastr["error"]('Period is required');
                    e.preventDefault();
                }

                if (input_values.end_from == 0) {
                    toastr["error"]('Period is required');
                    e.preventDefault();
                }

            };

            var validation1 = function (e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();


                if (input_values.start_from1 == 0) {
                    toastr["error"]('Period is required');
                    e.preventDefault();
                }

                if (input_values.end_from1 == 0) {
                    toastr["error"]('Period is required');
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
