@extends('layouts.app')

{{--Important Variables--}}


@section('title')
    Sells Report
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
            <h2 class="text-center">Sells Report</h2>
        </div>
        <div class="container-fluid">
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <!-- Branch Wise Start -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                CUSTOMER WISE PARTY LEDGER
                                <smAll>No date select show start to now</smAll>
                            </h2>
                        </div>
                        <br>
                        <div class="body">

                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route('report.sells.party_ledger.customer_wise')  }}">

                                    {{ csrf_field() }}
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="customer_id">
                                                    <option value="0">Select Customer Name</option>

                                                    @foreach( App\Customer::All() as $customer )
                                                        <option value="{{ $customer->id  }}">{{ $customer->name  }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select id="product_id" data-live-search="true"
                                                        class="form-control show-tick"
                                                        name="product_id">
                                                    <option value="0">Select Product ID</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                            <div class="form-line">
                                                <input autocomplete="off" name="from" type="text" class="form-control"
                                                       placeholder="Date start...">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="to" type="text" class="form-control"
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

                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Branch Wise End -->

                <!-- Income Expense Head  Wise Start -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                CUSTOMER PARTY LEDGER SUMMARY
                                <smAll>Anything is select show All</smAll>
                            </h2>
                        </div>
                        <br>
                        <div class="body">

                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route('report.sells.party_ledger.summary_wise')  }}">

                                    {{ csrf_field() }}


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
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container1">
                                            <div class="form-line">
                                                <input autocomplete="off" name="from" type="text" class="form-control"
                                                       placeholder="Date start...">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="to" type="text" class="form-control"
                                                       placeholder="Date end...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-line">
                                            <input formtarget="_blank" name="action" value="Show" type="submit"
                                                   class="btn btn-primary m-t-15 waves-effect">
                                            {{-- <input name="action" value="Pdf" type="submit"
                                                   class="btn btn-primary m-t-15 waves-effect"> --}}
                                            <input name="action" value="Excel" type="submit"
                                                   class="btn btn-primary m-t-15 waves-effect">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Income Expense Head  End -->

                <!--Cash Bank Book Start -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                SELLER NAME WISE PARTY LEDGER
                                <smAll>Anything is select show All</smAll>
                            </h2>
                        </div>
                        <br>
                        <div class="body">

                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route('report.sells.party_ledger.seller_name_wise') }}">

                                    {{ csrf_field() }}


                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                        name="employee_id">
                                                    <option value="0">Select Seller Name</option>

                                                    @foreach( App\Employee::All() as $employee )
                                                        <option @if ( $employee->id == old('employee_id' ))
                                                                selected
                                                                @endif value="{{ $employee->id  }}">{{ $employee->name  }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container2">
                                            <div class="form-line">
                                                <input autocomplete="off" name="from" type="text" class="form-control"
                                                       placeholder="Date start...">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="to" type="text" class="form-control"
                                                       placeholder="Date end...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-line">
                                            <input formtarget="_blank" name="action" value="Show" type="submit"
                                                   class="btn btn-primary m-t-15 waves-effect">

                                            {{--        <input name="action" value="Pdf" type="submit"
                                                   class="btn btn-primary m-t-15 waves-effect"> --}}

                                            <input name="action" value="Excel" type="submit"
                                                   class="btn btn-primary m-t-15 waves-effect">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Branch Wise End -->

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


    </script>

    <script>


        // Validation and calculation
        var UiController = (function () {

            var DOMString = {
                submit_form: 'form.form',

                customer_id: 'select[name=customer_id]',
                product_id: 'select[name=product_id]',

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


                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {

                        customer_id: Fields.get_customer_id.value == "" ? 0 : parseFloat(Fields.get_customer_id.value),
                        product_id: Fields.get_product_id.value == "" ? 0 : parseFloat(Fields.get_product_id.value),

                    }
                },

            }
        })();

        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function () {

                Fields.get_form.addEventListener('submit', validation);

                Fields.get_customer_id.addEventListener('change', product_changed);

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
                    url: "{{ route('report.sells.party_ledger.change_customer_get_sell') }}",
                    data: {id: branch_id},
                    success: function (data) {

                        $("#product_id").selectpicker('refresh');

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


                if (input_values.product_id == 0) {
                    toastr["error"]('Product is Required');
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
