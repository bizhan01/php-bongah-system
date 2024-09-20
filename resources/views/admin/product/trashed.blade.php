@extends('layouts.app')


{{--Important Variables--}}

<?php


$moduleName = " Product Manage";
$createItemName = "Trashed" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " trashed";

$breadcrumbMainIcon = "fas fa-boxes";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Product';
$ParentRouteName = 'product';



$All = config('role_manage.Product.All');
$create = config('role_manage.Product.Create');
$delete = config('role_manage.Product.Delete');
$edit = config('role_manage.Product.Edit');
$pdf = config('role_manage.Product.Pdf');
$permanently_delete = config('role_manage.Product.PermanentlyDelete');
$restore = config('role_manage.Product.Restore');
$show = config('role_manage.Product.Show');
$trash_show = config('role_manage.Product.TrashShow');


$curency_symble=(config('settings.is_code') == 'code') ? config('settings.currency_code') : config('settings.currency_symbol');

$transaction = new \App\Transaction();


?>
@section('title')
    زباله دان فایل ها
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
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> صفحه اصلی</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i class="{{ $breadcrumbMainIcon  }}"></i>فایل ها</a></li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon }}</i>زباله دان فایل ها</li>
            </ol>
            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">

                            <a  class="btn btn-xs btn-success waves-effect text-black"
                               href="{{ route($ParentRouteName)  }}">همه({{ $ModelName::All()->count() }})</a>


                            <a class="btn btn-xs btn-danger waves-effect"
                               href="{{ route($ParentRouteName.'.trashed') }}">حذف شده({{ $ModelName::onlyTrashed()->count()  }}
                                )</a>

                            <ul class="header-dropdown m-r--5">
                                <form class="search" action="{{ route($ParentRouteName.'.trashed.search') }}"
                                      method="get">
                                    {{ csrf_field() }}
                                    <input type="search" name="search" class="form-control input-sm "
                                           placeholder="Search"/>
                                </form>
                            </ul>
                        </div>
                        <form class="actionForm" action="{{ route($ParentRouteName.'.trashed.action') }}"
                              method="get">

                            <div class="body table-responsive">
                                <div class="row">
                                    <div class="margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control" name="apply_comand_top" id="">
                                                    <option value="0">کارهای دسته جمعی</option>
                                                    @if ($restore==1)
                                                        <option value="1">بازگردانی</option>
                                                    @endif

                                                    @if ($permanently_delete==1)
                                                        <option value="2">حذف کلی</option>
                                                    @endif


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                        <div class="form-group">
                                            <input class="btn btn-sm btn-info" type="submit" value="تایید"
                                                   name="ApplyTop">
                                        </div>
                                    </div>
                                    <div class=" margin-bottom-0 col-md-8 col-sm-8 col-xs-8">
                                        <div class="custom-paginate pull-right">
                                            {{ $items->links() }}
                                        </div>
                                    </div>
                                </div>
                                {{ csrf_field() }}

                                @if(count($items)>0)
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th class="checkbox_custom_style text-center">
                                                <input name="selectTop" type="checkbox" id="md_checkbox_p"
                                                       class="chk-col-cyan"/>
                                                <label for="md_checkbox_p"></label>
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top" title="شامل شماره پروژه ، شماره طبقه ، مدل">کد یکتا</th>
                                            <th  data-toggle="tooltip" data-placement="top" title="نام پروژه Name">نام</th>
                                            <th data-toggle="tooltip" data-placement="top" title="متراژ فایل">متراژ</th>
                                            <th data-toggle="tooltip" data-placement="top" title="قیمت واحد فایل">قیمت واحد</th>
                                            <th data-toggle="tooltip" data-placement="top" title="جمع کل قیمت واحد به تومان">جمع کل</th>

                                            <th data-toggle="tooltip" data-placement="top" title="تعداد پارکینگ">پارکینگ</th>
                                            <th data-toggle="tooltip" data-placement="top" title="امکانات فایل ( مثل آسانسور ، انباری )">امکانات</th>

                                            <th data-toggle="tooltip" data-placement="top" title="شارژ آپارتمان ( {{ $curency_symble }} )">هزینه اضافی</th>
                                            <th data-toggle="tooltip" data-placement="top" title="سایر امکانات ( {{ $curency_symble }} ) ">سایر</th>


                                            <th data-toggle="tooltip" data-placement="top" title="کسورات بابت تعمیر ( {{ $curency_symble }} )">کسورات</th>
                                            <th data-toggle="tooltip" data-placement="top" title="هزینه اجاره ( {{ $curency_symble }} )">بازپرداخت</th>

                                            <th data-toggle="tooltip" data-placement="top" title="قیمت نهایی فایل ( {{ $curency_symble }} )">قیمت نهایی</th>

                                            <th>گزینه ها</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $i = 1; ?>
                                        @foreach($items as $item)

                                            <tr>
                                                <th class="text-center">
                                                    <input name="items[id][]" value="{{ $item->id }}"
                                                           type="checkbox" id="md_checkbox_{{ $i }}"
                                                           class="chk-col-cyan selects "/>
                                                    <label for="md_checkbox_{{ $i }}"></label>
                                                </th>

                                                <td>{{ $item->product_unique_id }}</td>
                                                <td>{{ App\Product::onlyTrashed()->find($item->id)->branch->name }}</td>

                                                <td>{{ $item->flat_size }}</td>
                                                <td>{{  $transaction->convert_money_format($item->unite_price) }}  </td>
                                                <td class="text-bold">{{ $transaction->convert_money_format($item->total_flat_price) }}</td>

                                                <td>{{ $transaction->convert_money_format($item->car_parking_charge) }}</td>
                                                <td>{{ $transaction->convert_money_format($item->utility_charge) }}</td>
                                                <td>{{ $transaction->convert_money_format($item->additional_work_charge) }}</td>
                                                <td>{{ $transaction->convert_money_format($item->other_charge) }}</td>
                                                <td>{{ $transaction->convert_money_format($item->discount_or_deduction) }}</td>
                                                <td>{{ $transaction->convert_money_format($item->refund_additional_work_charge) }}</td>
                                                <td class="text-bold">{{ $transaction->convert_money_format($item->net_sells_price) }}</td>


                                                <td class="tdAction">
                                                    <a @if ($restore==0)
                                                       class="dis-none"
                                                       @endif class="btn btn-xs btn-info waves-effect m-b-3"
                                                       href="{{ route($ParentRouteName.'.restore',['id'=>$item->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="بازگردانی"><i
                                                                class="material-icons">restore</i></a>

                                                    <a
                                                       data-target="#largeModal"
                                                       class="btn btn-xs btn-success waves-effect ajaxCAll dis-none m-b-3"
                                                       href="#"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Preview"><i
                                                                class="material-icons">pageview</i></a>

                                                    <a @if ($permanently_delete==0)

                                                       class="dis-none"

                                                       @endif  class="btn btn-xs btn-danger waves-effect m-b-3"
                                                       href="{{ route($ParentRouteName.'.kill',['id'=>$item->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="حذف کلی"> <i
                                                                class="material-icons">delete</i></a>

                                                </td>
                                            </tr>
                                        <?php $i++; ?>
                                        @endforeach
                                        <thead>
                                        <tr>
                                            <th class="checkbox_custom_style text-center">
                                                <input name="selectBottom" type="checkbox" id="md_checkbox_footer"
                                                       class="chk-col-cyan"/>
                                                <label for="md_checkbox_footer"></label>
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top" title="شامل شماره پروژه ، شماره طبقه ، مدل">کد یکتا</th>
                                            <th  data-toggle="tooltip" data-placement="top" title="نام پروژه Name">نام</th>
                                            <th data-toggle="tooltip" data-placement="top" title="متراژ فایل">متراژ</th>
                                            <th data-toggle="tooltip" data-placement="top" title="قیمت واحد فایل">قیمت واحد</th>
                                            <th data-toggle="tooltip" data-placement="top" title="جمع کل قیمت واحد به تومان">جمع کل</th>

                                            <th data-toggle="tooltip" data-placement="top" title="تعداد پارکینگ">پارکینگ</th>
                                            <th data-toggle="tooltip" data-placement="top" title="امکانات فایل ( مثل آسانسور ، انباری )">امکانات</th>

                                            <th data-toggle="tooltip" data-placement="top" title="شارژ آپارتمان ( {{ $curency_symble }} )">هزینه اضافی</th>
                                            <th data-toggle="tooltip" data-placement="top" title="سایر امکانات ( {{ $curency_symble }} ) ">سایر</th>


                                            <th data-toggle="tooltip" data-placement="top" title="کسورات بابت تعمیر ( {{ $curency_symble }} )">کسورات</th>
                                            <th data-toggle="tooltip" data-placement="top" title="هزینه اجاره ( {{ $curency_symble }} )">بازپرداخت</th>

                                            <th data-toggle="tooltip" data-placement="top" title="قیمت نهایی فایل ( {{ $curency_symble }} )">قیمت نهایی</th>

                                            <th>گزینه ها</th>
                                        </tr>
                                        </thead>

                                        </tbody>
                                    </table>
                                @else
                                    <div class="body">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="text-danger text-center">فعلا چیزی موجود نیست !</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                @endif

                            </div>

                            <div class="row p-l-30">
                                <div class="m-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="apply_comand_bottom" id="">
                                                <option value="0">کارهای دسته جمعی</option>
                                                @if ($restore==1)
                                                    <option value="1">بازگردانی</option>
                                                @endif

                                                @if ($permanently_delete==1)
                                                    <option value="2">حذف کلی</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <input class="btn btn-sm btn-info" type="submit" value="تایید"
                                               name="ApplyTop">
                                    </div>
                                </div>
                                <div class="margin-bottom-0 col-md-8 col-sm-8 col-xs-8">
                                    <div class="custom-paginate pull-right">
                                        {{ $items->links() }}
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Hover Rows -->
        </div>
    </section>

@stop

@push('include-css')
    <!-- Wait Me Css -->
    <link href="{{ asset('asset/plugins/waitme/waitMe.css') }}" rel="stylesheet"/>

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


@endpush

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
