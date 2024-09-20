@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = " Journal Voucher";
$createItemName = " Edit" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Edit";

$breadcrumbMainIcon = "account_balance_wAllet";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Transaction';
$ParentRouteName = 'jnl_voucher';


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
                <li><a href="{{ route($ParentRouteName) }}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="material-icons">{{ $breadcrumbMainIcon  }}</i>{{  $breadcrumbMainName }}</a>
                </li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon  }}</i> {{ $breadcrumbCurrentName  }}</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="m-b-20">
                                {{ $createItemName  }}
                                <smAll>Edit {{ $moduleName  }} Information</smAll>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.update',['id'=>$items['dr'][0]->voucher_no]) }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="branch_id">
                                                        <option value="0">Select Project Name ( Dr )</option>
                                                        @foreach( App\Branch::All() as $branch )
                                                            <option @if ( $branch->id == $items['dr'][0]->branch_id  )
                                                                    selected
                                                                    @endif value="{{ $branch->id  }}">{{ $branch->name  }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name ( Dr )</option>
                                                        @foreach( App\IncomeExpenseHead::All() as $HeadOfAccount )
                                                            @if ( !empty( $items['dr'][0]->income_expense_head_id) )
                                                                @php( $id=$items['dr'][0]->income_expense_head_id )
                                                            @else
                                                                @php( $id=0 )
                                                            @endif
                                                            <option @if ( $HeadOfAccount->id ==$id )
                                                                    selected
                                                                    @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ (!empty( $items['dr'][0]->dr )) ? $items['dr'][0]->dr : 0  }}"
                                                           name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount ( Dr ) </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name ( Dr )</option>
                                                        @if ( !empty( $items['dr'][1]->income_expense_head_id) )
                                                            @php( $id =$items['dr'][1]->income_expense_head_id )
                                                        @else
                                                            @php( $id=0 )
                                                        @endif

                                                        @foreach( App\IncomeExpenseHead::All() as $HeadOfAccount )
                                                            <option @if ( $HeadOfAccount->id == $id  )
                                                                    selected
                                                                    @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ (!empty($items['dr'][1]->dr)) ? $items['dr'][1]->dr : 0 }}"
                                                           name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount ( Dr ) </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name ( Dr )</option>
                                                        @if ( !empty( $items['dr'][2]->income_expense_head_id) )
                                                            @php( $id =$items['dr'][2]->income_expense_head_id )
                                                        @else
                                                            @php( $id=0 )
                                                        @endif
                                                        @foreach( App\IncomeExpenseHead::All() as $HeadOfAccount )
                                                            <option @if ( $HeadOfAccount->id ==$id )
                                                                    selected
                                                                    @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{  !empty(  $items['dr'][2]->dr ) ? $items['dr'][2]->dr : 0  }}"
                                                           name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount ( Dr )</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name ( Dr )</option>
                                                        @if ( !empty( $items['dr'][3]->income_expense_head_id) )
                                                            @php( $id =$items['dr'][3]->income_expense_head_id )
                                                        @else
                                                            @php( $id=0 )
                                                        @endif
                                                        @foreach( App\IncomeExpenseHead::All() as $HeadOfAccount )
                                                            <option @if ( $HeadOfAccount->id ==$id )
                                                                    selected
                                                                    @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{  !empty(  $items['dr'][3]->dr ) ? $items['dr'][3]->dr : 0  }}"
                                                           name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount ( Dr )</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id"
                                                            name="income_expense_head_id[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name ( Dr )</option>
                                                        @if ( !empty( $items['dr'][4]->income_expense_head_id) )
                                                            @php( $id =$items['dr'][4]->income_expense_head_id )
                                                        @else
                                                            @php( $id=0 )
                                                        @endif
                                                        @foreach( App\IncomeExpenseHead::All() as $HeadOfAccount )
                                                            <option @if ( $HeadOfAccount->id == $id )
                                                                    selected
                                                                    @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ !empty( $items['dr'][4]->dr ) ? $items['dr'][4]->dr : 0  }}"
                                                           name="amount[]" type="number"
                                                           class="form-control amount">
                                                    <label class="form-label">Amount ( Dr )</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="branch_id_cr">
                                                        <option value="0">Select Project Name ( Cr )</option>
                                                        @foreach( App\Branch::All() as $branch )
                                                            <option @if ( $branch->id ==  $items['cr'][0]->branch_id )
                                                                    selected
                                                                    @endif value="{{ $branch->id  }}">{{ $branch->name  }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row cr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id_cr"
                                                            name="income_expense_head_id_cr[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name ( Cr )</option>

                                                        @if ( !empty( $items['cr'][0]->income_expense_head_id) )
                                                            @php( $id =$items['cr'][0]->income_expense_head_id )
                                                        @else
                                                            @php( $id=0 )
                                                        @endif

                                                        @foreach( App\IncomeExpenseHead::All() as $HeadOfAccount )
                                                            <option @if ( $HeadOfAccount->id == $id  )
                                                                    selected
                                                                    @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $items['cr'][0]->cr   }}" name="amount_cr[]"
                                                           type="number"
                                                           class="form-control amount_cr">
                                                    <label class="form-label">Amount ( Cr ) </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row cr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id_cr"
                                                            name="income_expense_head_id_cr[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name ( Cr )</option>

                                                        @if ( !empty( $items['cr'][1]->income_expense_head_id) )
                                                            @php( $id =$items['cr'][1]->income_expense_head_id )
                                                        @else
                                                            @php( $id=0 )
                                                        @endif

                                                        @foreach( App\IncomeExpenseHead::All() as $HeadOfAccount )
                                                            <option @if ( $HeadOfAccount->id == $id ))
                                                                    selected
                                                                    @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ !empty($items['cr'][1]->cr ) ? $items['cr'][1]->cr : 0   }}"
                                                           name="amount_cr[]" type="number"
                                                           class="form-control amount_cr">
                                                    <label class="form-label">Amount ( Cr ) </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row cr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id_cr"
                                                            name="income_expense_head_id_cr[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name ( Cr )</option>

                                                        @if ( !empty( $items['cr'][2]->income_expense_head_id) )
                                                            @php( $id =$items['cr'][2]->income_expense_head_id )
                                                        @else
                                                            @php( $id=0 )
                                                        @endif

                                                        @foreach( App\IncomeExpenseHead::All() as $HeadOfAccount )
                                                            <option @if ( $HeadOfAccount->id == $id  )
                                                                    selected
                                                                    @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ !empty( $items['cr'][2]->cr ) ? $items['cr'][2]->cr : 0  }}"
                                                           name="amount_cr[]" type="number"
                                                           class="form-control amount_cr">
                                                    <label class="form-label">Amount ( Cr )</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row cr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id_cr"
                                                            name="income_expense_head_id_cr[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name ( Cr )</option>

                                                        @if ( !empty( $items['cr'][3]->income_expense_head_id) )
                                                            @php( $id =$items['cr'][3]->income_expense_head_id )
                                                        @else
                                                            @php( $id=0 )
                                                        @endif

                                                        @foreach( App\IncomeExpenseHead::All() as $HeadOfAccount )
                                                            <option @if ( $HeadOfAccount->id == $id  )
                                                                    selected
                                                                    @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ !empty( $items['cr'][3]->cr ) ? $items['cr'][3]->cr : 0  }}"
                                                           name="amount_cr[]" type="number"
                                                           class="form-control amount_cr">
                                                    <label class="form-label">Amount ( Cr )</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row cr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                            class="form-control show-tick income_expense_head_id_cr"
                                                            name="income_expense_head_id_cr[]"
                                                            id="">
                                                        <option value="0"> Select Head of Account Name ( Cr )</option>
                                                        @if ( !empty( $items['cr'][4]->income_expense_head_id) )
                                                            @php( $id =$items['cr'][4]->income_expense_head_id )
                                                        @else
                                                            @php( $id=0 )
                                                        @endif
                                                        @foreach( App\IncomeExpenseHead::All() as $HeadOfAccount )
                                                            <option @if ( $HeadOfAccount->id == $id  )
                                                                    selected
                                                                    @endif value="{{ $HeadOfAccount->id  }}">{{ $HeadOfAccount->name  }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ !empty( $items['cr'][4]->cr ) ? $items['cr'][4]->cr : 0  }}"
                                                           name="amount_cr[]" type="number"
                                                           class="form-control amount_cr">
                                                    <label class="form-label">Amount ( Cr )</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off"
                                                           value="{{ date("m/d/Y", strtotime($items['dr'][0]->voucher_date))  }}"
                                                           name="voucher_date"
                                                           type="text"
                                                           class="form-control"
                                                           placeholder="Please choose a voucher date...">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea name="particulars" rows="2" class="form-control no-resize"
                                                              placeholder="Particulars">{{  $items['dr'][0]->particulars }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Inline Layout | With Floating Label -->
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



        // Validation and calculation on Cr Voucher
        var UiController = (function () {

            var DOMString = {
                submit_form: 'form.form',

                field_area: '.field_area',

                project_id: 'select[name=branch_id]',
                project_id_cr: 'select[name=branch_id_cr]',


                head_of_account_id: '.income_expense_head_id',
                amount: '.amount',

                head_of_account_id_cr: '.income_expense_head_id_cr',
                amount_cr: '.amount_cr',

                date: 'input[name=voucher_date]',
                particulars: 'textarea[name=particulars]',

                drCloset: '.dr',
                crCloset: '.cr',

                dr: 'dr',
                cr: 'cr',

                plus: 'plus',
                minus: 'minus',


            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),

                        get_project_id: document.querySelector(DOMString.project_id),
                        get_project_id_cr: document.querySelector(DOMString.project_id_cr),


                        get_head_of_account_id: document.querySelectorAll(DOMString.head_of_account_id),
                        get_amount: document.querySelectorAll(DOMString.amount),

                        get_head_of_account_id_cr: document.querySelectorAll(DOMString.head_of_account_id_cr),
                        get_amount_cr: document.querySelectorAll(DOMString.amount_cr),


                        get_date: document.querySelector(DOMString.date),
                        get_particulars: document.querySelector(DOMString.particulars),

                        get_dr: document.getElementsByClassName(DOMString.dr),

                        get_cr: document.getElementsByClassName(DOMString.cr),


                        get_plus: document.getElementsByClassName(DOMString.plus),
                        get_minus: document.getElementsByClassName(DOMString.minus),
                    }
                },
                getValues: function () {
                    var Fields = this.getFields();
                    return {
                        project_id: Fields.get_project_id.value == "" ? 0 : parseFloat(Fields.get_project_id.value),
                        project_id_cr: Fields.get_project_id_cr.value == "" ? 0 : parseFloat(Fields.get_project_id_cr.value),


                        date: Fields.get_date.value == "" ? 0 : Fields.get_date.value,
                        particulars: Fields.get_particulars.value == "" ? 0 : Fields.get_particulars.value,

                    }
                },


                hide: function (Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);

                    if (Area) {
                        Area.style.display = 'none';
                    }
                },
                show: function (Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);
                    if (Area) {
                        Area.style.display = 'block';
                    }
                },

                setEmpty: function(Field){
                    Field.value = 0;
                },

                hideHeadAmountArea: function (Field) {
                    if (Field) {
                        Field.style.display = 'none';
                    }
                },

                showHeadAmountArea: function (Field) {
                    var DomString = this.getDOMString();

                    if (Field) {
                        Field.style.display = 'block';
                    }
                },


            }
        })();


        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function () {
                Fields.get_form.addEventListener('submit', validation);

                Array.prototype.forEach.cAll(Fields.get_plus, function (plus, index) {
                    plus.addEventListener('click', function (event) {
                        addItem(event, index);
                    }, false);
                });

                Array.prototype.forEach.cAll(Fields.get_minus, function (minus, index) {
                    minus.addEventListener('click', function (event) {
                        removeItem(event, index);
                    }, false);
                });

            };

            var validation = function (e) {
                var Values, Fields;
                Values = UICnt.getValues();
                Fields = UICnt.getFields();

                var TotalDrAmount = 0, TotalCrAmount = 0;

                if (Values.project_id == 0) {
                    toastr["error"]('Select  Project ( Dr )');
                    e.preventDefault();
                }

                if (Values.project_id_cr == 0) {
                    toastr["error"]('Select  Project ( Cr )');
                    e.preventDefault();
                }


                if (Fields.get_head_of_account_id[0].querySelector('select').value == 0) {
                    toastr["error"]('Select Head Of Account ( Dr )');
                    e.preventDefault();
                }

                if (Fields.get_amount[0].value == '') {
                    toastr["error"]('Put Amount ( Dr )');
                    e.preventDefault();
                } else {
                    TotalDrAmount += parseFloat(Fields.get_amount[0].value);
                }


                if (Fields.get_head_of_account_id_cr[0].querySelector('select').value == 0) {
                    toastr["error"]('Select Head Of Account ( Cr )');
                    e.preventDefault();
                }

                if (Fields.get_amount_cr[0].value == '') {
                    toastr["error"]('Put Amount ( Cr )');
                    e.preventDefault();
                } else {
                    TotalCrAmount += parseFloat(Fields.get_amount_cr[0].value);
                }


                if (Values.date == 0) {
                    toastr["error"]('Set Date');
                    e.preventDefault();
                }


                if (Fields.get_dr[1].style.display == 'block') {

                    if (Fields.get_head_of_account_id[2].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account ( Dr )');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[1].value == '') {
                        toastr["error"]('Put Amount ( Dr )');
                        e.preventDefault();
                    } else {
                        TotalDrAmount += parseFloat(Fields.get_amount[1].value);
                    }
                }

                if (Fields.get_dr[2].style.display == 'block') {

                    if (Fields.get_head_of_account_id[4].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account ( Dr )');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[2].value == '') {
                        toastr["error"]('Put Amount ( Dr )');
                        e.preventDefault();
                    } else {
                        TotalDrAmount += parseFloat(Fields.get_amount[2].value);
                    }
                }

                if (Fields.get_dr[3].style.display == 'block') {

                    if (Fields.get_head_of_account_id[6].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account ( Dr )');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[3].value == '') {
                        toastr["error"]('Put Amount ( Dr )');
                        e.preventDefault();
                    } else {
                        TotalDrAmount += parseFloat(Fields.get_amount[3].value);
                    }
                }

                if (Fields.get_dr[4].style.display == 'block') {

                    if (Fields.get_head_of_account_id[8].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account ( Dr )');
                        e.preventDefault();
                    }

                    if (Fields.get_amount[4].value == '') {
                        toastr["error"]('Put Amount ( Dr )');
                        e.preventDefault();
                    } else {
                        TotalDrAmount += parseFloat(Fields.get_amount[4].value);
                    }
                }



                if (Fields.get_cr[1].style.display == 'block') {

                    if (Fields.get_head_of_account_id_cr[2].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account ( Cr )');
                        e.preventDefault();
                    }

                    if (Fields.get_amount_cr[1].value == '') {
                        toastr["error"]('Put Amount ( Cr)');
                        e.preventDefault();
                    } else {
                        TotalCrAmount += parseFloat(Fields.get_amount_cr[1].value);
                    }
                }

                if (Fields.get_cr[2].style.display == 'block') {

                    if (Fields.get_head_of_account_id_cr[4].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account ( Cr ) ');
                        e.preventDefault();
                    }

                    if (Fields.get_amount_cr[2].value == '') {
                        toastr["error"]('Put Amount ( Cr )');
                        e.preventDefault();
                    } else {
                        TotalCrAmount += parseFloat(Fields.get_amount_cr[2].value);
                    }
                }

                if (Fields.get_cr[3].style.display == 'block') {

                    if (Fields.get_head_of_account_id_cr[6].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account ( Cr )');
                        e.preventDefault();
                    }

                    if (Fields.get_amount_cr[3].value == '') {
                        toastr["error"]('Put Amount ( Cr )');
                        e.preventDefault();
                    } else {
                        TotalCrAmount += parseFloat(Fields.get_amount_cr[3].value);
                    }
                }

                if (Fields.get_cr[4].style.display == 'block') {

                    if (Fields.get_head_of_account_id_cr[8].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account ( Cr )');
                        e.preventDefault();
                    }

                    if (Fields.get_amount_cr[4].value == '') {
                        toastr["error"]('Put Amount ( Cr )');
                        e.preventDefault();
                    } else {
                        TotalCrAmount += parseFloat(Fields.get_amount_cr[4].value);
                    }
                }




                var head_of_account_Ids = [];

                var get_head_of_account_id_one = Fields.get_head_of_account_id[0].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[0].querySelector('select').value);
                var get_head_of_account_id_two = Fields.get_head_of_account_id[2].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[2].querySelector('select').value);
                var get_head_of_account_id_three = Fields.get_head_of_account_id[4].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[4].querySelector('select').value);
                var get_head_of_account_id_four = Fields.get_head_of_account_id[6].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[6].querySelector('select').value);
                var get_head_of_account_id_five = Fields.get_head_of_account_id[8].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[8].querySelector('select').value);


                var get_head_of_account_id_cr_one = Fields.get_head_of_account_id_cr[0].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id_cr[0].querySelector('select').value);
                var get_head_of_account_id_cr_two = Fields.get_head_of_account_id_cr[2].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id_cr[2].querySelector('select').value);
                var get_head_of_account_id_cr_three = Fields.get_head_of_account_id_cr[4].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id_cr[4].querySelector('select').value);
                var get_head_of_account_id_cr_four = Fields.get_head_of_account_id_cr[6].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id_cr[6].querySelector('select').value);
                var get_head_of_account_id_cr_five = Fields.get_head_of_account_id_cr[8].querySelector('select').value == "" ? 0 : parseFloat(Fields.get_head_of_account_id_cr[8].querySelector('select').value);


                if (get_head_of_account_id_one > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_one);
                }
                if (get_head_of_account_id_two > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_two);
                }
                if (get_head_of_account_id_three > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_three);
                }
                if (get_head_of_account_id_four > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_four);
                }
                if (get_head_of_account_id_five > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_five);
                }



                if (get_head_of_account_id_cr_one > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_cr_one);
                }
                if (get_head_of_account_id_cr_two > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_cr_two);
                }
                if (get_head_of_account_id_cr_three > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_cr_three);
                }
                if (get_head_of_account_id_cr_four > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_cr_four);
                }
                if (get_head_of_account_id_cr_five > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_cr_five);
                }



                function checkUniqueOrNot(head_of_account_Ids) {
                    var counts = [];
                    for (var i = 0; i <= head_of_account_Ids.length; i++) {
                        if (counts[head_of_account_Ids[i]] === undefined) {
                            counts[head_of_account_Ids[i]] = 1;
                        } else {
                            return true;
                        }
                    }
                    return false;
                }

                if (checkUniqueOrNot(head_of_account_Ids)) {
                    toastr["error"]('Head of Account should unique');
                    e.preventDefault();
                }

                if (TotalDrAmount === TotalCrAmount) {

                } else {
                    toastr["error"]('Total Amount of Dr and Cr Should same');
                    e.preventDefault();
                }


            };


            var addItem = function (event, index) {
                var Fields;
                Fields = UICnt.getFields();
                var DomString = UICnt.getDOMString();

                var Cr = event.target.closest(DomString.crCloset);

                if (Cr) {
                    Cr.nextElementSibling.style.display = 'block';

                } else {
                    UICnt.showHeadAmountArea(Fields.get_dr[index + 1]);
                }


            };

            var removeItem = function (event, index) {

                var Fields;
                Fields = UICnt.getFields();

                var DomString = UICnt.getDOMString();
                var Cr = event.target.closest(DomString.crCloset);
                var Dr = event.target.closest(DomString.drCloset);

                if (Cr) {
                    Cr.style.display = 'none';
                    Cr.querySelector('select').value= '0';
                    Cr.querySelector(DomString.amount_cr).value = "";

                } else {
                    UICnt.hideHeadAmountArea(Fields.get_dr[index + 1]);

                    Dr.querySelector('select').value= '0';
                    Dr.querySelector(DomString.amount).value = "";


                }

            };

            return {
                init: function () {
                    console.log("App Is running");
                    setUpEventListner();

                    // Default hide fields

                    var Values, Fields;
                    Values = UICnt.getValues();
                    Fields = UICnt.getFields();


                    @if( !empty($items['dr'][1]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[1]);
                    @else
                    UICnt.hideHeadAmountArea(Fields.get_dr[1]);
                    @endif
                    @if( !empty($items['dr'][2]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[2]);
                    @else
                    UICnt.hideHeadAmountArea(Fields.get_dr[2]);
                    @endif
                    @if( !empty($items['dr'][3]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[3]);
                    @else
                    UICnt.hideHeadAmountArea(Fields.get_dr[3]);
                    @endif
                    @if( !empty($items['dr'][4]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_dr[4]);
                    @else
                    UICnt.hideHeadAmountArea(Fields.get_dr[4]);
                    @endif


                    @if( !empty($items['cr'][1]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_cr[1]);
                    @else
                    UICnt.hideHeadAmountArea(Fields.get_cr[1]);
                    @endif

                    @if( !empty($items['cr'][2]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_cr[2]);
                    @else
                    UICnt.hideHeadAmountArea(Fields.get_cr[2]);
                    @endif

                    @if( !empty($items['cr'][3]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_cr[3]);
                    @else
                    UICnt.hideHeadAmountArea(Fields.get_cr[3]);
                    @endif

                    @if( !empty($items['cr'][4]->income_expense_head_id) )
                    UICnt.showHeadAmountArea(Fields.get_cr[4]);
                    @else
                    UICnt.hideHeadAmountArea(Fields.get_cr[4]);
                    @endif


                }
            }

        })(UiController);

        MainController.init();


    </script>

@endpush
