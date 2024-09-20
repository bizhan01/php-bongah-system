@extends('layouts.app')

{{--Important Variables--}}

<?php
$moduleName = " Role Manage";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Create";

$breadcrumbMainIcon = "fas fa-user-lock";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\RoleManage';
$ParentRouteName = 'role-manage';


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
                                class="{{ $breadcrumbMainIcon  }} "></i>{{  $breadcrumbMainName }}</a>
                </li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon  }}</i> {{ $breadcrumbCurrentName  }}</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ $createItemName  }}
                                <smAll>Put {{ $moduleName  }} Information</smAll>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.store') }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus="" value="{{ old('name') }}" name="name"
                                                           type="text"
                                                           class="form-control">
                                                    <label class="form-label">Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table  table-bordered table-hover">
                                                <thead>
                                                <tr>

                                                    <th class="checkbox_custom_style text-center">
                                                        <input name="selectTop" type="checkbox" id="md_checkbox_p"
                                                               class="chk-col-cyan topBottom"/>
                                                        <label for="md_checkbox_p"></label>
                                                    </th>

                                                    <th scope="col" class="text-center">S.L</th>
                                                    <th scope="col" class="text-center">Module Name</th>
                                                    <th scope="col" class="text-center">All</th>
                                                    <th scope="col" class="text-center">Show</th>
                                                    <th scope="col" class="text-center">Create</th>
                                                    <th scope="col" class="text-center">Edit</th>
                                                    <th scope="col" class="text-center">Delete</th>
                                                    <th scope="col" class="text-center">PDF</th>
                                                    <th scope="col" class="text-center">Trash Show</th>
                                                    <th scope="col" class="text-center">Restore</th>
                                                    <th scope="col" class="text-center">Permanently Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_1"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_1"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">1</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="user[0]" value="User">
                                                        User
                                                    </td>
                                                    @for ($i = 1; $i <=9 ; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="user[{{$i}}]" type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_2"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_2"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">2</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="role_manage[0]" value="Role Manage">
                                                        Role Manage
                                                    </td>
                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="role_manage[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor

                                                </tr>


                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_3"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_3"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">3</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="settings[0]" value="Settings">
                                                        Settings
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="settings[{{$i}}]" type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>

                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_4"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_4"></label>
                                                    </th>

                                                    <th scope="row" class="text-center">4</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="Project[0]" value="Project">
                                                        Project
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="Project[{{$i}}]" type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_product"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_product"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">5</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="Product[0]" value="Product">
                                                        Product
                                                    </td>
                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="Product[{{$i}}]" type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_Sell"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_Sell"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">6</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="Sell[0]" value="Sell">
                                                        Sell
                                                    </td>
                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="Sell[{{$i}}]" type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_PurchaseRequisition"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_PurchaseRequisition"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">7</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="PurchaseRequisition[0]" value="Purchase Requisition">
                                                        Purchase Requisition
                                                    </td>
                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="PurchaseRequisition[{{$i}}]" type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_PurchaseRQNConfirm"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_PurchaseRQNConfirm"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">8</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="PurchaseRQNConfirm[0]" value="Purchase RQN Confirm">
                                                        Purchase RQN Confirm
                                                    </td>
                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="PurchaseRQNConfirm[{{$i}}]" type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_PurchaseOrder"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_PurchaseOrder"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">9</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="PurchaseOrder[0]" value="Purchase Order">
                                                        Purchase Order
                                                    </td>
                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="PurchaseOrder[{{$i}}]" type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_Vendor"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_Vendor"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">10</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="Vendor[0]" value="Vendor">
                                                        Vendor
                                                    </td>
                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="Vendor[{{$i}}]" type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_Employee"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_Employee"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">11</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="Employee[0]" value="Employee">
                                                        Employee
                                                    </td>
                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="Employee[{{$i}}]" type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_Customer"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_Customer"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">12</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="Customer[0]" value="Customer">
                                                        Customer
                                                    </td>
                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="Customer[{{$i}}]" type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_5"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_5"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">13</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="LedgerType[0]"
                                                               value="Ledger Type">
                                                        Ledger Type
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="LedgerType[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_6"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_6"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">14</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="LedgerGroup[0]"
                                                               value="Ledger Group">
                                                        Ledger Group
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="LedgerGroup[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_7"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_7"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">15</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="LedgerName[0]"
                                                               value="Ledger Name">
                                                        Ledger Name
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="LedgerName[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>


                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_8"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_8"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">16</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="BankCash[0]"
                                                               value="Bank Cash">
                                                        Bank Cash
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="BankCash[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>

                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_9"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_9"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">17</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="InitialIncomeExpenseHeadBalance[0]"
                                                               value="Initial Income Expense Head Balance">
                                                        Initial Income Expense Head Balance
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="InitialIncomeExpenseHeadBalance[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_10"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_10"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">18</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="InitialBankCashBalance[0]"
                                                               value="Initial Bank Cash Balance">
                                                        Initial Bank Cash Balance
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="InitialBankCashBalance[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_11"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_11"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">19</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="dr_voucher[0]"
                                                               value="Dr Voucher">
                                                        Dr Voucher
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="dr_voucher[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_12"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_12"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">20</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="cr_voucher[0]"
                                                               value="Cr Voucher">
                                                        Cr Voucher
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="cr_voucher[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_13"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_13"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">21</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="jnl_voucher[0]"
                                                               value="Journal Voucher">
                                                        Journal Voucher
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="jnl_voucher[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_14"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_14"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">22</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="cnt_voucher[0]"
                                                               value="Contra Voucher">
                                                        Contra Voucher
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="cnt_voucher[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_15"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_15"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">23</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="ledger[0]"
                                                               value="Ledger">
                                                        Ledger
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="ledger[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_16"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_16"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">24</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="trial_balance[0]"
                                                               value="Trial Balance">
                                                        Trial Balance
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="trial_balance[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_17"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_17"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">25</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="cost_Of_revenue[0]"
                                                               value="Cost Of Revenue">
                                                        Cost Of Revenue
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="cost_Of_revenue[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_18"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_18"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">26</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="profit_or_loss_account[0]"
                                                               value="Profit Or Loss Account">
                                                        Profit Or Loss Account
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="profit_or_loss_account[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_19"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_19"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">27</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="retained_earning[0]"
                                                               value="Retained Earning">
                                                        Retained Earning
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="retained_earning[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_20"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_20"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">28</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="fixed_assets_schedule[0]"
                                                               value="Fixed Assets Schedule ">
                                                        Fixed Assets Schedule
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="fixed_assets_schedule[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_21"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_21"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">29</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="statement_of_financial_position[0]"
                                                               value="Statement Of Financial Position">
                                                        Statement Of Financial Position
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="statement_of_financial_position[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_22"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_22"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">30</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="cash_flow[0]"
                                                               value="Cash Flow">
                                                        Cash Flow
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="cash_flow[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_23"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_23"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">31</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="receive_and_payment[0]"
                                                               value="Receive And Payment">
                                                        Receive And Payment
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="receive_and_payment[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_24"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_24"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">32</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="notes[0]"
                                                               value="Notes">
                                                        Notes
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="notes[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_PurchaseReport"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_PurchaseReport"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">33</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="PurchaseReport[0]"
                                                               value="Purchase Report">
                                                        Purchase Report
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="PurchaseReport[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_SellsReport"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_SellsReport"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">34</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="SellsReport[0]"
                                                               value="Sells Report">
                                                        Sells Report
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="SellsReport[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>



                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_25"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_25"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">35</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="generalBranch[0]"
                                                               value="general Branch Report">
                                                        general Branch Report
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="generalBranch[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_26"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_26"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">36</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="generalledger[0]"
                                                               value="general Ledger Report">
                                                        general Ledger Report
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="generalledger[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_27"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_27"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">37</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="generalBankCash[0]"
                                                               value="general Bank Cash Report">
                                                        general Bank Cash Report
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="generalBankCash[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>

                                                <tr>
                                                    <th class="text-center">
                                                        <input type="checkbox" id="md_checkbox_28"
                                                               class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_28"></label>
                                                    </th>
                                                    <th scope="row" class="text-center">38</th>
                                                    <td class="text-center">
                                                        <input type="hidden" name="generalVoucher[0]"
                                                               value="general Voucher Report">
                                                        general Voucher Report
                                                    </td>

                                                    @for ($i = 1; $i <=9; $i++)
                                                        <td class="text-center">
                                                            <div class="switch">
                                                                <label>
                                                                    <input name="generalVoucher[{{$i}}]"
                                                                           type="checkbox"><span
                                                                            class="lever switch-col-cyan"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    @endfor
                                                </tr>


                                                </tbody>

                                                <thead>
                                                <tr>
                                                    <th class="checkbox_custom_style text-center">
                                                        <input name="selectBottom" type="checkbox" id="md_checkbox_footer"
                                                               class="chk-col-cyan topBottom"/>
                                                        <label for="md_checkbox_footer"></label>
                                                    </th>
                                                    <th scope="col" class="text-center">S.L</th>
                                                    <th scope="col" class="text-center">Module Name</th>
                                                    <th scope="col" class="text-center">All</th>
                                                    <th scope="col" class="text-center">Show</th>
                                                    <th scope="col" class="text-center">Create</th>
                                                    <th scope="col" class="text-center">Edit</th>
                                                    <th scope="col" class="text-center">Delete</th>
                                                    <th scope="col" class="text-center">PDF</th>
                                                    <th scope="col" class="text-center">Trash Show</th>
                                                    <th scope="col" class="text-center">Restore</th>
                                                    <th scope="col" class="text-center">Permanently Delete</th>
                                                </tr>
                                                </thead>

                                            </table>

                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    Create
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



        // Validation and calculation
        var UiController = (function () {

            var DOMString = {
                submit_form: 'form.form',
                name: 'input[name=name]',
                selects: '.selects',
                topBottom: '.topBottom',
            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_name: document.querySelector(DOMString.name),
                        getSelects: document.querySelectorAll(DOMString.selects),
                        getTopBottom: document.querySelectorAll(DOMString.topBottom),

                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {
                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,
                    }
                },

            }
        })();

        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function () {

                Fields.get_form.addEventListener('submit', validation);

                for (var i=0; i<Fields.getSelects.length; i++) {
                    Fields.getSelects[i].addEventListener('click', checkAllAction);
                }

                for (var i=0; i<Fields.getTopBottom.length; i++) {
                    Fields.getTopBottom[i].addEventListener('click', topBottom);
                }
            };

            var checkedAllItems= function () {

                for (var i=0; i<Fields.getSelects.length; i++) {
                    var tr=Fields.getSelects[i].closest('tr');
                    var checkBox=tr.querySelectorAll('input[type=checkbox]');
                    checkBox[0].checked=true;
                    checkBox[1].checked=true;
                    checkBox[2].checked=true;
                    checkBox[3].checked=true;
                    checkBox[4].checked=true;
                    checkBox[5].checked=true;
                    checkBox[6].checked=true;
                    checkBox[7].checked=true;
                    checkBox[8].checked=true;
                    checkBox[9].checked=true;
                }
                checkedUncheckedTopBottom(true);
            };

            var unCheckedAllItems= function () {
                for (var i=0; i<Fields.getSelects.length; i++) {
                    var tr=Fields.getSelects[i].closest('tr');
                    var checkBox=tr.querySelectorAll('input[type=checkbox]');
                    checkBox[0].checked=false;
                    checkBox[1].checked=false;
                    checkBox[2].checked=false;
                    checkBox[3].checked=false;
                    checkBox[4].checked=false;
                    checkBox[5].checked=false;
                    checkBox[6].checked=false;
                    checkBox[7].checked=false;
                    checkBox[8].checked=false;
                    checkBox[9].checked=false;
                }
                checkedUncheckedTopBottom(false);
            };

            var checkedUncheckedTopBottom= function (flag) {
                if (flag==true){
                    Fields.getTopBottom[0].checked=true;
                    Fields.getTopBottom[1].checked=true;
                } else{
                    Fields.getTopBottom[0].checked=false;
                    Fields.getTopBottom[1].checked=false;
                }
            };


            var topBottom=function (e) {
                if (e.target.checked) {
                    checkedAllItems();

                }else{
                    unCheckedAllItems();

                }
            };

            var checkAllModuleOrNot= function () {

                // Check All module  or check not
                var checkedNo=0;
                for(var i=0; i<Fields.getSelects.length; i++)
                {
                    if(Fields.getSelects[i].checked==true){
                        checkedNo++;
                    }
                }
                if(Fields.getSelects.length==checkedNo){
                    checkedUncheckedTopBottom(true);
                }else{
                    checkedUncheckedTopBottom(false);
                }

            };

            var checkAllAction = function (e) {

                var tr=e.target.closest('tr');
                var checkBox= tr.querySelectorAll('input[type=checkbox]');
                if (e.target.checked) {
                    for (var i=0; i<checkBox.length; i++)
                    {
                        checkBox[i].checked=true;
                    }
                }else{
                    for (var i=0; i<checkBox.length; i++)
                    {
                        checkBox[i].checked=false;
                    }
                }
                // Check All module  or check not
                checkAllModuleOrNot();

            };

            var validation = function (e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();

                var FieldName1 = " Name";


                if (input_values.name == 0) {
                    toastr["error"]('Set Any' + FieldName1);
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
