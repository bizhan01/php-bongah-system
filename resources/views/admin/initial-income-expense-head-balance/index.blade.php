@extends('layouts.app')


{{--Important Variable--}}

<?php

$moduleName = " Initial Ledger Balance";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-balance-scale";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Transaction';
$ParentRouteName = 'initial_income_expense_head_balance';

$voucher_type = "IIEHBV";

$All = config('role_manage.InitialIncomeExpenseHeadBalance.All');
$create = config('role_manage.InitialIncomeExpenseHeadBalance.Create');
$delete = config('role_manage.InitialIncomeExpenseHeadBalance.Delete');
$edit = config('role_manage.InitialIncomeExpenseHeadBalance.Edit');
$pdf = config('role_manage.InitialIncomeExpenseHeadBalance.Pdf');
$permanently_delete = config('role_manage.InitialIncomeExpenseHeadBalance.PermanentlyDelete');
$restore = config('role_manage.InitialIncomeExpenseHeadBalance.Restore');
$show = config('role_manage.InitialIncomeExpenseHeadBalance.Show');
$trash_show = config('role_manage.InitialIncomeExpenseHeadBalance.TrashShow');

$transaction = new \App\Transaction();
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
                               href="{{ route($ParentRouteName)  }}">All({{ $ModelName::where('voucher_type',$voucher_type)->count() }}
                                )</a>


                            <a @if ($trash_show==0)

                               class="dis-none"

                               @endif  class="text-black btn btn-xs btn-danger waves-effect"
                               href="{{ route($ParentRouteName.'.trashed') }}">Trash({{ $ModelName::onlyTrashed()->where('voucher_type',$voucher_type)->count()  }}
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
                                                @if ($delete==1)
                                                    <option value="3">Move To trash</option>
                                                @endif
                                                @if($permanently_delete==1)
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
                                            <th>Project Name</th>
                                            <th>Ledger Name</th>
                                            <th>Voucher Date</th>
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
                                                <td>{{ App\Transaction::find($item->id)->Branch->name }}</td>
                                                <td>{{ App\Transaction::find($item->id)->IncomeExpenseHead->name }}</td>

                                                <td>{{ date(config('settings.date_format'), strtotime($item->voucher_date)) }}</td>
                                                <td> {{ $transaction->convert_money_format( $item->dr) }} </td>
                                                <td>{{ $transaction->convert_money_format($item->cr) }}</td>


                                                <td class="tdTrashAction">
                                                    <a @if ($edit==0)

                                                       class="dis-none"

                                                       @endif
                                                       class=" m-b-3 btn btn-xs btn-info waves-effect"
                                                       href="{{ route($ParentRouteName.'.edit',['id'=>$item->voucher_no]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Edit"><i
                                                                class="material-icons">mode_edit</i></a>
                                                    <a @if ($show==0)

                                                       class="dis-none"

                                                       @endif target="_blank"
                                                       data-target="#largeModal"
                                                       class=" m-b-3 btn btn-xs btn-success waves-effect ajaxCAll"
                                                       href="{{  route($ParentRouteName.'.show',['id'=>$item->voucher_no])  }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Preview"><i
                                                                class="material-icons">pageview</i></a>

                                                    <a @if ($delete==0)

                                                       class="dis-none"

                                                       @endif
                                                       class=" m-b-3 btn btn-xs btn-danger waves-effect"
                                                       href="{{ route($ParentRouteName.'.destroy',['id'=>$item->voucher_no]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Trash"> <i
                                                                class="material-icons">delete</i></a>

                                                    <a @if ($pdf==0)

                                                       class="dis-none"

                                                       @endif
                                                       class="btn btn-xs btn-warning waves-effect"
                                                       href="{{ route($ParentRouteName.'.pdf',['id'=>$item->voucher_no]) }}"
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

                                            <th class="text-center">Voucher No</th>
                                            <th>Project Name</th>
                                            <th>Ledger Name</th>
                                            <th>Voucher Date</th>
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
                                    <div class="body">
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
                            <div class="row body">
                                <div class="m-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="apply_comand_bottom" id="">
                                                <option value="0">Select Action</option>
                                                @if ($delete==1)
                                                    <option value="3">Move To trash</option>
                                                @endif
                                                @if($permanently_delete==1)
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

    <!-- Large Size -->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content  modal-ajax-content">
                <div class="preloader add_spinner">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModAllabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="row modal-content-data">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Items</th>
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Id</td>
                                <td>Name</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
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



