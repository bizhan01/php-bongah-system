@extends('layouts.app')


{{--Important Variable--}}

<?php

$moduleName = " Employee Manage";
$createItemName = "All" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-user-graduate";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\employee';
$ParentRouteName = 'employee';



$All = config('role_manage.Employee.All');
$create = config('role_manage.Employee.Create');
$delete = config('role_manage.Employee.Delete');
$edit = config('role_manage.Employee.Edit');
$pdf = config('role_manage.Employee.Pdf');
$permanently_delete = config('role_manage.Employee.PermanentlyDelete');
$restore = config('role_manage.Employee.Restore');
$show = config('role_manage.Employee.Show');
$trash_show = config('role_manage.Employee.TrashShow');

?>


@section('title')
    کارمندان
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
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> صفحه اصلی</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="{{ $breadcrumbMainIcon  }}"></i> کارمندان</a></li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon }}</i> همه ی کارمندان</li>
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
                                                    <option value="3">انقال به زباله دان</option>
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
                                            <th>نام</th>
                                            <th>شماره تماس</th>
                                            <th>ایمیل</th>
                                            <th>سمت</th>
                                            <th>دپارتمان</th>
                                            <th>آدرس</th>

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

                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->position }}</td>
                                                <td>{{ $item->department }}</td>
                                                <td>{{ $item->address }}</td>



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
                                                       class="btn btn-xs btn-success waves-effect ajaxCAll dis-none m-b-3"
                                                       href="{{  route($ParentRouteName.'.show',['id'=>$item->id])  }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Preview"><i
                                                                class="material-icons">pageview</i></a>


                                                    <a @if ($delete==0)

                                                       class="dis-none"
                                                       @endif class="btn btn-xs btn-danger waves-effect m-b-3"
                                                       href="{{ route($ParentRouteName.'.destroy',['id'=>$item->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="حذف"> <i
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

                                            <th>نام</th>
                                            <th>شماره تماس</th>
                                            <th>ایمیل</th>
                                            <th>سمت</th>
                                            <th>دپارتمان</th>
                                            <th>آدرس</th>

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



