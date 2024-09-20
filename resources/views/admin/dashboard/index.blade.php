@extends('layouts.app')

@section('title')
    <?php $ApplicationName = Config::get('settings.company_name'); ?>
    {{ $ApplicationName }} -> میز کار
@stop


@section('top-bar')
    @include('includes.top-bar')
@stop

@section('left-sidebar')
    @include('includes.left-sidebar')
@stop



@push('include-js')

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('asset/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('asset/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('asset/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('asset/plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('asset/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('asset/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('asset/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('asset/plugins/flot-charts/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('asset/js/pages/index.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('asset/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>


@endpush


@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>میزکار</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>پروژه ها</h4></div>
                            <div class="number count-to" data-from="0" data-to="{{ count(App\Branch::All() ) }}"
                                 data-speed="1000"
                                 data-fresh-interval="0"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-amber hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>محصولات</h4></div>
                            <div class="number count-to" data-from="0" data-to="{{ count(App\Product::All() ) }}"
                                 data-speed="1000"
                                 data-fresh-interval="0"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-dolly"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>فروش</h4></div>
                            <div class="number count-to" data-from="0" data-to="{{ count(App\Sell::All() ) }}"
                                 data-speed="1000"
                                 data-fresh-interval="0"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>پرداخت های کلان</h4></div>
                            <div class="number count-to" data-from="0" data-to="{{ count(App\PurchaseRequisition::All() ) }}"
                                 data-speed="1000"
                                 data-fresh-interval="0"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-brown hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>تایید پرداخت</h4></div>
                            <div class="number count-to" data-from="0" data-to="{{ count(App\PurchaseOrder::All() ) }}"
                                 data-speed="1000"
                                 data-fresh-interval="0"></div>
                        </div>
                    </div>
                </div>





                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>مدل های هزینه</h4></div>
                            <div class="number count-to" data-from="0"
                                 data-to="{{ count(App\IncomeExpenseType::All()) }}" data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-purple hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>مخارج</h4></div>
                            <div class="number count-to" data-from="0"
                                 data-to="{{ count(App\IncomeExpenseGroup::All()) }}" data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>هزینه ها </h4></div>
                            <div class="number count-to" data-from="0"
                                 data-to="{{ count(App\IncomeExpenseHead::All()) }}" data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-blue-grey hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>تراکنش ها</h4></div>
                            <div class="number count-to" data-from="0" data-to="{{  count(App\BankCash::All()) }}"
                                 data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>مشاورین</h4></div>
                            <div class="number count-to" data-from="0" data-to="{{  count(App\User::All()) }}"
                                 data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-user-lock "></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>دسترسی ها</h4></div>
                            <div class="number count-to" data-from="0" data-to="{{  count(App\RoleManage::All()) }}"
                                 data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box bg-brown hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="content">
                            <div class="text"><h4>گزارشات</h4></div>
                            <div class="number count-to" data-from="0" data-to="14"
                                 data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>



                <!-- #END# Widgets -->

            </div>




            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 align="center">
                                پشتیبانی سریع
                            </h2>
                        </div>
                        <div class="body">
                            <div class="button-demo" align="center">
                                <a target="_blank" href="https://bc8.ir/hrman" type="button" class="btn bg-green waves-effect">برای آموزش کار با سیستم و پشتیبانی سریع کلیک کنید</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </section>




@stop


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

