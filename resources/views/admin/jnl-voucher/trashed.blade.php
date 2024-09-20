@extends('layouts.app')


{{--Important Variables--}}

<?php

$moduleName = " Journal Voucher";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Trashed";

$breadcrumbMainIcon = "account_balance_wAllet";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Transaction';
$ParentRouteName = 'jnl_voucher';

$voucher_type = 'JV';


$All = config('role_manage.JnlVoucher.All');
$create = config('role_manage.JnlVoucher.Create');
$delete = config('role_manage.JnlVoucher.Delete');
$edit = config('role_manage.JnlVoucher.Edit');
$pdf = config('role_manage.JnlVoucher.Pdf');
$permanently_delete = config('role_manage.JnlVoucher.PermanentlyDelete');
$restore = config('role_manage.JnlVoucher.Restore');
$show = config('role_manage.JnlVoucher.Show');
$trash_show = config('role_manage.JnlVoucher.TrashShow');

$transaction = new \App\Transaction();

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
                                class="material-icons">{{ $breadcrumbMainIcon  }}</i>{{ $breadcrumbMainName  }}</a></li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon }}</i>{{ $breadcrumbCurrentName }}</li>
            </ol>
            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">
                        <div class="header">
                            <a @if ($All==0)
                               class="dis-none"
                               @endif class="text-black btn btn-xs btn-success waves-effect"
                               href="{{ route($ParentRouteName)  }}">All({{ $ModelName::where('voucher_type',$voucher_type)
                                   ->count() }})</a>


                            <a class="btn btn-xs btn-danger waves-effect"
                               href="{{ route($ParentRouteName.'.trashed') }}">Trash({{
                                       $ModelName::onlyTrashed()->where('voucher_type',$voucher_type)
                                       ->count()  }}
                                )</a>

                            <ul class="header-dropdown m-r--5">
                                <form class="search" action="{{ route($ParentRouteName.'.trashed.search') }}"
                                      method="get">
                                    {{ csrf_field() }}
                                    <input autofocus type="search" name="search" class="form-control input-sm "
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
                                                    <option value="0">Select Action</option>
                                                    @if ($restore==1)
                                                        <option value="1">Restore</option>
                                                    @endif

                                                    @if ($permanently_delete==1)
                                                        <option value="2">Delete</option>
                                                    @endif


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                        <div class="form-group">
                                            <input class="btn btn-sm btn-info" type="submit" value="Apply"
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

                                @if (count($items) >0)
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th class="checkbox_custom_style text-center">
                                                <input name="selectTop" type="checkbox" id="md_checkbox_p"
                                                       class="chk-col-cyan"/>
                                                <label for="md_checkbox_p"></label>
                                            </th>
                                            <th class="text-center">Voucher No</th>
                                            <th>Particulars</th>
                                            <th>Project Name</th>
                                            <th>Date</th>
                                            <th>Head Of Account Name</th>
                                            <th>Dr ( <?php echo (config('settings.is_code') == 'code') ?
                                                    config('settings.currency_code') : config('settings.currency_symbol')  ?>
                                                )
                                            </th>
                                            <th>Cr ( <?php echo (config('settings.is_code') == 'code') ?
                                                    config('settings.currency_code') : config('settings.currency_symbol')  ?>
                                                )
                                            </th>
                                            <th>Options</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $i = 1; ?>
                                        @foreach($items as $item)

                                            <tr>
                                                <th class="text-center">
                                                    <input name="items[id][]" value="{{ $item->voucher_no }}"
                                                           type="checkbox" id="md_checkbox_{{ $i }}"
                                                           class="chk-col-cyan selects "/>
                                                    <label for="md_checkbox_{{ $i }}"></label>
                                                </th>

                                                <td class="text-center">{{ str_pad($item->voucher_no, 4, '0', STR_PAD_LEFT)  }}</td>
                                                <td>{{ $item->particulars }}</td>
                                                <td>{{ App\Transaction::onlyTrashed()->find($item->id)->Branch->name
                                                }}</td>
                                                <td>{{ date(config('settings.date_format'), strtotime($item->voucher_date)) }}</td>
                                                <td> {{ App\Transaction::onlyTrashed()->find($item->id)->IncomeExpenseHead->name  }}
                                                </td>
                                                <td>{{ $transaction->convert_money_format($item->dr) }}</td>
                                                <td>{{ $transaction->convert_money_format($item->cr) }}</td>


                                                <td class="tdAction">
                                                    <a @if ($restore==0)
                                                       class="dis-none"
                                                       @endif class="btn btn-xs btn-info waves-effect"
                                                       href="{{ route($ParentRouteName.'.restore',['id'=>$item->voucher_no]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Restore"><i
                                                                class="material-icons">restore</i></a>

                                                    <a
                                                       data-target="#largeModal"
                                                       class="dis-none btn btn-xs btn-success waves-effect ajaxCAll"
                                                       href="#"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Preview"><i
                                                                class="material-icons">pageview</i></a>

                                                    <a @if ($permanently_delete==0)
                                                       class="dis-none"
                                                       @endif  class="btn btn-xs btn-danger waves-effect"
                                                       href="{{ route($ParentRouteName.'.kill',['id'=>$item->voucher_no]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Parmanently Delete?"> <i
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
                                            <th class="text-center">Voucher No</th>
                                            <th>Particulars</th>
                                            <th>Project Name</th>
                                            <th>Date</th>
                                            <th>Head Of Account Name</th>
                                            <th>Dr ( <?php echo (config('settings.is_code') == 'code') ?
                                                    config('settings.currency_code') : config('settings.currency_symbol')  ?>
                                                )
                                            </th>
                                            <th>Cr ( <?php echo (config('settings.is_code') == 'code') ?
                                                    config('settings.currency_code') : config('settings.currency_symbol')  ?>
                                                )
                                            </th>
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
                                                <th colspan="8" class="text-danger text-center">There Has No Data</th>
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
                                                <option value="0">Select Action</option>

                                                @if ($restore==1)
                                                    <option value="1">Restore</option>
                                                @endif

                                                @if ($permanently_delete==1)
                                                    <option value="2">Delete</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <input class="btn btn-sm btn-info" type="submit" value="Apply"
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
