@extends('layouts.app')


{{--Important Variable--}}

<?php


$moduleName = " Product Manage";
$createItemName = "All" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

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


$curency_symble = (config('settings.is_code') == 'code') ? config('settings.currency_code') : config('settings.currency_symbol');

$transaction = new \App\Transaction();

?>




@section('title')
    فایل ها
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
                <a @if ($create==0)
                   class="dis-none"

                   @endif class="btn btn-sm btn-info waves-effect"
                   href="{{ route($ParentRouteName.'.create') }}">افزودن </a>

            </div>

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> خانه</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="{{ $breadcrumbMainIcon  }}"></i>مدیریت فایل ها</a></li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon }}</i>همه</li>
            </ol>

            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">

                            <a class="btn btn-xs btn-info waves-effect"
                               href="{{ route($ParentRouteName)  }}">همه({{ $ModelName::All()->count() }})</a>

                            <a @if ($trash_show==0)

                               class="dis-none"

                               @endif class="btn btn-xs btn-danger waves-effect text-black"
                               href="{{ route($ParentRouteName.'.trashed') }}">حذف شده({{ $ModelName::onlyTrashed()->count()  }}
                                )</a>


                            <ul class="header-dropdown m-r--5">
                                <form class="search" action="{{ route($ParentRouteName.'.active.search') }}"
                                      method="get">
                                    {{ csrf_field() }}
                                    <input autofocus type="search" name="search" class="form-control input-sm "
                                           placeholder="جستجو"/>
                                </form>
                            </ul>
                        </div>
                        <form class="actionForm" action="{{ route($ParentRouteName.'.active.action') }}"
                              method="get">
                            <div class="row body">
                                <div class="margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="apply_comand_top" id="">
                                                <option value="0">کارهای دسته جمعی</option>
                                                @if ($delete)
                                                    <option value="3">انتقال به زباله دان</option>
                                                    <option value="2">حذف کلی</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class=" margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <input class="btn btn-sm btn-info waves-effect" type="submit"
                                               value="تایید"
                                               name="ApplyTop">
                                    </div>
                                </div>
                                <div class=" margin-bottom-0 col-md-8 col-sm-8 col-xs-8">
                                    <div class="custom-paginate pull-right">
                                        {{ $items->links() }}
                                    </div>
                                </div>
                            </div>
                            <div class="body table-responsive">
                                {{ csrf_field() }}

                                @if( count($items) >0 )
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th class="checkbox_custom_style text-center">
                                                <input name="selectTop" type="checkbox" id="md_checkbox_p"
                                                       class="chk-col-cyan"/>
                                                <label for="md_checkbox_p"></label>
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top"
                                                title="( شامل شماره پروژه ، شماره طبقه ، مدل )">کد یکتا
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top" title="نام پروژه">نام
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top" title="متراژ فایل">متراژ</th>
                                            <th data-toggle="tooltip" data-placement="top"
                                                title="قیمت هر متر ( {{ $curency_symble }} )">قیمت واحد
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top"
                                                title="قیمت پایه ( {{ $curency_symble }} )">جمع کل
                                            </th>

                                            <th data-toggle="tooltip" data-placement="top"
                                                title="تعداد پارکینگ">پارکینگ
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top"
                                                title="امکانات فایل ( مثل آسانسور ، انباری )">امکانات
                                            </th>

                                            <th data-toggle="tooltip" data-placement="top"
                                                title="شارژ آپارتمان ( {{ $curency_symble }} )">هزینه اضافی
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top"
                                                title="سایر امکانات ( {{ $curency_symble }} ) ">سایر
                                            </th>


                                            <th data-toggle="tooltip" data-placement="top"
                                                title="کسورات بابت تعمیر ( {{ $curency_symble }} )">کسورات
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top"
                                                title="هزینه اجاره ( {{ $curency_symble }} )">بازپرداخت
                                            </th>

                                            <th data-toggle="tooltip" data-placement="top"
                                                title="قیمت نهایی فایل ( {{ $curency_symble }} )">قیمت کل
                                            </th>


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
                                                <td>{{ App\Product::find($item->id)->branch->name }}</td>

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


                                                {{--  <td>{{ $item->description }}</td> --}}

                                                <td class="tdTrashAction">
                                                    <a @if ($edit==0)

                                                       class="dis-none"

                                                       @endif class="btn btn-xs btn-info waves-effect m-b-3"
                                                       href="{{ route($ParentRouteName.'.edit',['id'=>$item->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="ویرایش"><i
                                                                class="material-icons">mode_edit</i></a>

                                                    <a @if ($show==0)

                                                       class="dis-none"

                                                       @endif  target="_blank"
                                                       data-target="#largeModal"
                                                       class="btn btn-xs btn-success waves-effect ajaxCAll m-b-3"
                                                       href="{{  route($ParentRouteName.'.show',['id'=>$item->id])  }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="نمایش"><i
                                                                class="material-icons">pageview</i></a>


                                                    <a @if ($delete==0)

                                                       class="dis-none"
                                                       @endif class="btn btn-xs btn-danger waves-effect m-b-3"
                                                       href="{{ route($ParentRouteName.'.destroy',['id'=>$item->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="انتقال به زباله دان"> <i
                                                                class="material-icons">delete</i></a>

                                                    <a @if ($pdf==0)

                                                       class="dis-none"

                                                       @endif  class="btn btn-xs btn-warning waves-effect m-b-3"
                                                       href="{{ route($ParentRouteName.'.pdf',['id'=>$item->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="چاپ"> <i
                                                                class="material-icons">picture_as_pdf</i></a>


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

                                            <th data-toggle="tooltip" data-placement="top"
                                                title="( شامل شماره پروژه ، شماره طبقه ، مدل )">کد یکتا
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top" title="نام پروژه">نام
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top" title="متراژ فایل">متراژ</th>
                                            <th data-toggle="tooltip" data-placement="top"
                                                title="قیمت هر متر ( {{ $curency_symble }} )">قیمت واحد
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top"
                                                title="قیمت پایه ( {{ $curency_symble }} )">جمع کل
                                            </th>

                                            <th data-toggle="tooltip" data-placement="top"
                                                title="تعداد پارکینگ">پارکینگ
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top"
                                                title="امکانات فایل ( مثل آسانسور ، انباری )">امکانات
                                            </th>

                                            <th data-toggle="tooltip" data-placement="top"
                                                title="شارژ آپارتمان ( {{ $curency_symble }} )">هزینه اضافی
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top"
                                                title="سایر امکانات ( {{ $curency_symble }} ) ">سایر
                                            </th>


                                            <th data-toggle="tooltip" data-placement="top"
                                                title="کسورات بابت تعمیر ( {{ $curency_symble }} )">کسورات
                                            </th>
                                            <th data-toggle="tooltip" data-placement="top"
                                                title="هزینه اجاره ( {{ $curency_symble }} )">بازپرداخت
                                            </th>

                                            <th data-toggle="tooltip" data-placement="top"
                                                title="قیمت نهایی فایل ( {{ $curency_symble }} )">قیمت کل
                                            </th>


                                            <th>گزینه ها</th>
                                        </tr>
                                        </thead>

                                        </tbody>
                                    </table>
                                @else
                                    <div class="body table-responsive">
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
                            <div class="row body">
                                <div class="m-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="apply_comand_bottom" id="">
                                                <option value="0">کارهای دسته جمعی</option>
                                                @if ($delete)
                                                    <option value="3">انتقال به زباله دان</option>
                                                    <option value="2">حذف کلی</option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <input class="btn btn-sm btn-info waves-effect" type="submit"
                                               value="تایید"
                                               name="ApplyButtom">
                                    </div>
                                </div>
                                <div class=" margin-bottom-0 col-md-8 col-sm-8 col-xs-8">
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



