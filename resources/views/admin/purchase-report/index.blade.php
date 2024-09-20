@extends('layouts.app')

{{--Important Variables--}}


@section('title')
    Purchase Requisition & Order
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
            <h2 class="text-center">Purchase Requisition & Order Report</h2>
        </div>
        <div class="container-fluid">
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <!-- Branch Wise Start -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                PURCHASE REQUISITION
                                <smAll>No date select show start to now</smAll>
                            </h2>
                        </div>
                        <br>
                        <div class="body">

                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route('report.purchase.requisition')  }}">

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

                                    <input name="requisitionDate" type="hidden" value="0">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container3">
                                            <div class="form-line">
                                                <input autocomplete="off" name="from" type="text" class="form-control"
                                                       placeholder="Required Date start...">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="to" type="text" class="form-control"
                                                       placeholder="Required Date end...">
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

                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                REQUISITION ID
                                <smAll>Put Your Requisition Id</smAll>
                            </h2>
                        </div>
                        <br>
                        <div class="body">

                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route('report.purchase.requisition_id')  }}">

                                    {{ csrf_field() }}

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input autocomplete="off" name="requisition_id" type="text"
                                                       class="form-control" placeholder=" Requisition Id">
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

                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                PURCHASE REQUISITION
                                <smAll>No date select show start to now</smAll>
                            </h2>
                        </div>
                        <br>
                        <div class="body">

                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route('report.purchase.requisition')  }}">

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


                                    <input name="requisitionDate" type="hidden" value="1">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container1">
                                            <div class="form-line">
                                                <input autocomplete="off" name="from" type="text" class="form-control"
                                                       placeholder="Requisition Date start...">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="to" type="text" class="form-control"
                                                       placeholder="Requisition Date end...">
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
                <!-- Branch Wise End -->

                <!-- REQUISITION ID Wise Start -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                PURCHASE ORDER
                                <smAll>Anything is select show All</smAll>
                            </h2>
                        </div>
                        <br>
                        <div class="body">

                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route('report.purchase.order') }}">

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

                                    <input type="hidden" name="issuing_date" value="0">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container2">
                                            <div class="form-line">
                                                <input autocomplete="off" name="from" type="text" class="form-control"
                                                       placeholder="Delevery Date start...">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="to" type="text" class="form-control"
                                                       placeholder="Delevery Date end...">
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

                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                PURCHASE ORDER ID
                                <smAll>Put Your Order Id</smAll>
                            </h2>
                        </div>
                        <br>
                        <div class="body">

                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route('report.purchase.order_id')  }}">

                                    {{ csrf_field() }}

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input autocomplete="off" name="purchase_order_id" type="text"
                                                       class="form-control" placeholder="Purchase Order Id">
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

                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                PURCHASE ORDER
                                <smAll>Anything is select show All</smAll>
                            </h2>
                        </div>
                        <br>
                        <div class="body">

                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route('report.purchase.order') }}">

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

                                    <input type="hidden" name="issuing_date" value="1">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container4">
                                            <div class="form-line">
                                                <input autocomplete="off" name="from" type="text" class="form-control"
                                                       placeholder="Issuing Date start...">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="to" type="text" class="form-control"
                                                       placeholder="Issuing Date end...">
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
                <!-- REQUISITION ID Wise End -->

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
                requisition_id: 'input[name=requisition_id]',
                purchase_order_id: 'input[name=purchase_order_id]',

            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_requisition_id: document.querySelector(DOMString.requisition_id),
                        get_purchase_order_id: document.querySelector(DOMString.purchase_order_id),
                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {
                        requisition_id: Fields.get_requisition_id=="" ? 0 :  Fields.get_requisition_id,
                        purchase_order_id: Fields.get_purchase_order_id=="" ? 0 :  Fields.get_purchase_order_id,
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


                if (input_values.product_id == 0) {
                    toastr["error"]('Product is Required');
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
