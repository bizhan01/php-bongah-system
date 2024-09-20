@extends('layouts.app')


{{--Important Variable--}}

<?php

$moduleName = " Purchase Requisition Manage";
$createItemName = "All" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-shopping-cart";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\PurchaseRequisition';
$ParentRouteName = 'purchase_requisition';



$All = config('role_manage.PurchaseRequisition.All');
$create = config('role_manage.PurchaseRequisition.Create');
$delete = config('role_manage.PurchaseRequisition.Delete');
$edit = config('role_manage.PurchaseRequisition.Edit');
$pdf = config('role_manage.PurchaseRequisition.Pdf');
$permanently_delete = config('role_manage.PurchaseRequisition.PermanentlyDelete');
$restore = config('role_manage.PurchaseRequisition.Restore');
$show = config('role_manage.PurchaseRequisition.Show');
$trash_show = config('role_manage.PurchaseRequisition.TrashShow');

$transaction = new App\Transaction();

?>


@section('title')
    {{ $moduleName }} -> {{ $breadcrumbCurrentName }}
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
                   href="{{ route($ParentRouteName.'.create') }}">Create </a>

            </div>

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="{{ $breadcrumbMainIcon  }}"></i>{{ $breadcrumbMainName  }}</a></li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon }}</i>{{ $breadcrumbCurrentName }}</li>
            </ol>

            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">

                            <a class="btn btn-xs btn-info waves-effect"
                               href="{{ route($ParentRouteName)  }}">All({{ $ModelName::All()->count() }})</a>

                            <a @if ($trash_show==0)

                               class="dis-none"

                               @endif class="btn btn-xs btn-danger waves-effect text-black"
                               href="{{ route($ParentRouteName.'.trashed') }}">Trash({{ $ModelName::onlyTrashed()->count()  }}
                                )</a>


                            <ul class="header-dropdown m-r--5">
                                <form class="search" action="{{ route($ParentRouteName.'.active.search') }}"
                                      method="get">
                                    {{ csrf_field() }}
                                    <input autofocus type="search" name="search" class="form-control input-sm "
                                           placeholder="Search"/>
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
                                                <option value="0">Select Action</option>
                                                @if ($delete)
                                                    <option value="3">Move To trash</option>
                                                    <option value="2">Permanently Delete</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class=" margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <input class="btn btn-sm btn-info waves-effect" type="submit"
                                               value="Apply"
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
                                            <th>Requisition ID</th>
                                            <th>Project Name</th>
                                            <th>Employee Name</th>
                                            <th>Requisition Date</th>
                                            <th>Required Date</th>
                                            <th>Requisition Amount ( {{  $transaction->get_currency_code() }} )</th>
                                            <th>Options</th>
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
                                                <?php $requisiton_info = $item->requisition_id =="" ? "Not Confirmed Yet" : $item->requisition_id ?>
                                                <td>{{ $requisiton_info  }}</td>
                                                <td>{{ App\Branch::find($item->branch_id)->name }}</td>
                                                <td>{{ App\Employee::find($item->employee_id)->name }}</td>
                                                <td>{{ $transaction->date_format($item->requisition_date ) }}</td>
                                                <td>{{ $transaction->date_format($item->required_date) }}</td>
                                                <td>{{  $transaction->convert_money_format( $item->amount ) }}</td>
                                                <td class="tdTrashAction">
                                                    <a @if ($edit==0)
                                                       class="dis-none"
                                                       @endif class="btn btn-xs btn-info waves-effect"
                                                       href="{{ route($ParentRouteName.'.edit',['id'=>$item->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Edit"><i
                                                                class="material-icons">mode_edit</i></a>
                                                    <a @if ($show==0)
                                                       class="dis-none"
                                                       @endif  target="_blank"
                                                       data-target="#largeModal"
                                                       class="btn btn-xs btn-success waves-effect ajaxCAll "
                                                       href="{{  route($ParentRouteName.'.show',['id'=>$item->id])  }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Preview"><i
                                                                class="material-icons">pageview</i></a>
                                                    <a @if ($delete==0)
                                                       class="dis-none"
                                                       @endif class="btn btn-xs btn-danger waves-effect"
                                                       href="{{ route($ParentRouteName.'.destroy',['id'=>$item->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Trash"> <i
                                                                class="material-icons">delete</i></a>
                                                    <a @if ($pdf==0)
                                                       class="dis-none"
                                                       @endif  class="btn btn-xs btn-warning waves-effect dis-none"
                                                       href="{{ route($ParentRouteName.'.pdf',['id'=>$item->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="PDF Generator"> <i
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
                                            <th>Requisition ID</th>
                                            <th>Project Name</th>
                                            <th>Employee Name</th>
                                            <th>Requisition Date</th>
                                            <th>Required Date</th>
                                            <th>Requisition Amount  ( {{  $transaction->get_currency_code() }} )</th>

                                            {{-- <th>Description</th> --}}
                                            <th>Options</th>
                                        </tr>
                                        </thead>

                                        </tbody>
                                    </table>
                                @else
                                    <div class="body table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="text-danger text-center">There Has No Data</th>
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
                                                <option value="0">Select Action</option>
                                                @if ($delete)
                                                    <option value="3">Move To trash</option>
                                                    <option value="2">Permanently Delete</option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <input class="btn btn-sm btn-info waves-effect" type="submit"
                                               value="Apply"
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



