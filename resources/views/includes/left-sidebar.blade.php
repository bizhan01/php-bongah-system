<section>
    <aside id="leftsidebar" class="sidebar">
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li @if(Request::url() === route('dashboard'))
                    class="active"
                        @endif >
                    <a href="{{ route('dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>میزکار</span>
                    </a>
                </li>


                {{--Branch  Start--}}
                <li @if ( config('role_manage.Project.All')==0 and  config('role_manage.Project.TrashShow')==0 and config('role_manage.Project.Create')==0  )
                    class="dis-none"
                    @endif  @if(Request::url() === route('branch') or Request::url() === route('branch.create') or Request::url() === route('branch.trashed') or Request::url() === route('branch.active.search') or Request::url() === route('branch.trashed.search') )
                    class="active "
                        @endif >
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-project-diagram"></i>
                        <span>پروژه ها </span>
                    </a>

                    <ul class="ml-menu">
                        <li @if (Request::url() === route('branch') or Request::url() === route('branch.active.search') )
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Project.All')==0 )
                               class="dis-none"
                               @endif href="{{ route('branch') }}">همه</a>
                        </li>
                        <li @if (Request::url() === route('branch.create'))
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Project.Create')==0 )
                               class="dis-none"
                               @endif  href="{{ route('branch.create') }}">افزودن</a>
                        </li>
                        <li @if (Request::url() === route('branch.trashed') or Request::url() === route('branch.trashed.search') )
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Project.TrashShow')==0 )
                               class="dis-none"
                               @endif  href="{{ route('branch.trashed') }}">زباله دان</a>
                        </li>

                    </ul>

                </li>

                {{--Branch End--}}

                {{--Product  Start--}}
                <li @if ( config('role_manage.Product.All')==0 and  config('role_manage.Product.TrashShow')==0 and config('role_manage.Product.Create')==0  )
                    class="dis-none"
                    @endif  @if(Request::url() === route('product') or Request::url() === route('product.create') or Request::url() === route('product.trashed') or Request::url() === route('product.active.search') or Request::url() === route('product.trashed.search') )
                    class="active "
                        @endif >
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-boxes"></i>
                        <span>محصولات </span>
                    </a>

                    <ul class="ml-menu">
                        <li @if (Request::url() === route('product') or Request::url() === route('product.active.search') )
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Product.All')==0 )
                               class="dis-none"
                               @endif href="{{ route('product') }}">همه</a>
                        </li>
                        <li @if (Request::url() === route('product.create'))
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Product.Create')==0 )
                               class="dis-none"
                               @endif  href="{{ route('product.create') }}">افزودن</a>
                        </li>
                        <li @if (Request::url() === route('product.trashed') or Request::url() === route('product.trashed.search') )
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Product.TrashShow')==0 )
                               class="dis-none"
                               @endif  href="{{ route('product.trashed') }}">زباله دان</a>
                        </li>

                    </ul>

                </li>

                {{--Product End--}}


                {{--Sell  Start--}}
                <li @if ( config('role_manage.Sell.All')==0 and  config('role_manage.Sell.TrashShow')==0 and config('role_manage.Sell.Create')==0  )
                    class="dis-none"
                    @endif  @if(Request::url() === route('sell') or Request::url() === route('sell.create') or Request::url() === route('sell.trashed') or Request::url() === route('sell.active.search') or Request::url() === route('sell.trashed.search') )
                    class="active "
                        @endif >
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-dolly"></i>
                        <span>فروش </span>
                    </a>

                    <ul class="ml-menu">
                        <li @if (Request::url() === route('sell') or Request::url() === route('sell.active.search') )
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Sell.All')==0 )
                               class="dis-none"
                               @endif href="{{ route('sell') }}">همه</a>
                        </li>
                        <li @if (Request::url() === route('sell.create'))
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Sell.Create')==0 )
                               class="dis-none"
                               @endif  href="{{ route('sell.create') }}">افزودن</a>
                        </li>
                        <li @if (Request::url() === route('sell.trashed') or Request::url() === route('sell.trashed.search') )
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Sell.TrashShow')==0 )
                               class="dis-none"
                               @endif  href="{{ route('sell.trashed') }}">زباله دان</a>
                        </li>

                    </ul>

                </li>

                {{--Sells End--}}



                {{--Purchase Start--}}

                <li

                        @if (config('role_manage.PurchaseRequisition.All')==0 and  config('role_manage.PurchaseRequisition.TrashShow')==0 and config('role_manage.PurchaseRequisition.Create')==0
                            and
                             config('role_manage.PurchaseRQNConfirm.All')==0 and  config('role_manage.PurchaseRQNConfirm.TrashShow')==0 and config('role_manage.PurchaseRQNConfirm.Create')==0

                            and
                             config('role_manage.PurchaseOrder.All')==0 and  config('role_manage.PurchaseOrder.TrashShow')==0 and config('role_manage.PurchaseOrder.Create')==0


                        )
                        class="dis-none"
                        @endif


                        @if( Request::url() === route('purchase_requisition') or Request::url() === route('purchase_requisition.create') or Request::url() === route('purchase_requisition.trashed')

                        or

                        Request::url() === route('requisition_confirmed') or Request::url() === route('requisition_confirmed.create') or Request::url() === route('requisition_confirmed.trashed')

                        or

                        Request::url() === route('purchase_order') or Request::url() === route('purchase_order.create') or Request::url() === route('purchase_order.trashed')



                ) class="active " @endif >
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-shopping-cart"></i>
                        <span>پرداخت</span>
                    </a>

                    <ul class="ml-menu">

                        {{-- Purchase Requisition Start--}}

                        <li @if ( config('role_manage.PurchaseRequisition.All')==0 and  config('role_manage.PurchaseRequisition.TrashShow')==0 and config('role_manage.PurchaseRequisition.Create')==0 )
                            class="dis-none"
                            @endif  @if(Request::url() === route('purchase_requisition') or Request::url() === route('purchase_requisition.create') or Request::url() === route('purchase_requisition.trashed') or Request::url() === route('purchase_requisition.active.search') or Request::url() === route('purchase_requisition.trashed.search') )
                            class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>تمدید </span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('purchase_requisition') or Request::url() === route('purchase_requisition.active.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.PurchaseRequisition.All')==0)
                                       class="dis-none"
                                       @endif href="{{ route('purchase_requisition') }}">همه</a>
                                </li>
                                <li @if (Request::url() === route('purchase_requisition.create'))
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.PurchaseRequisition.Create')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('purchase_requisition.create') }}">افزودن</a>
                                </li>
                                <li @if (Request::url() === route('purchase_requisition.trashed') or Request::url() === route('purchase_requisition.trashed.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.PurchaseRequisition.TrashShow')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('purchase_requisition.trashed') }}">زباله دان</a>
                                </li>

                            </ul>

                        </li>

                        {{--Purchase Requisiton End--}}


                        {{-- Requisition Confirmed Start--}}

                        <li @if ( config('role_manage.PurchaseRQNConfirm.All')==0 and  config('role_manage.PurchaseRQNConfirm.TrashShow')==0 and config('role_manage.PurchaseRQNConfirm.Create')==0 )
                            class="dis-none"
                            @endif  @if(Request::url() === route('requisition_confirmed') or Request::url() === route('requisition_confirmed.create') or Request::url() === route('requisition_confirmed.trashed') or Request::url() === route('requisition_confirmed.active.search') or Request::url() === route('requisition_confirmed.trashed.search') )
                            class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>تایید شده </span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('requisition_confirmed') or Request::url() === route('requisition_confirmed.active.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.PurchaseRQNConfirm.All')==0)
                                       class="dis-none"
                                       @endif href="{{ route('requisition_confirmed') }}">همه</a>
                                </li>
                                <li @if (Request::url() === route('requisition_confirmed.create'))
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.PurchaseRQNConfirm.Create')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('requisition_confirmed.create') }}">افزودن</a>
                                </li>
                                <li @if (Request::url() === route('requisition_confirmed.trashed') or Request::url() === route('requisition_confirmed.trashed.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.PurchaseRQNConfirm.TrashShow')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('requisition_confirmed.trashed') }}">زباله دان</a>
                                </li>

                            </ul>

                        </li>


                        {{-- Purchase Order --}}
                        <li @if ( config('role_manage.PurchaseOrder.All')==0 and  config('role_manage.PurchaseOrder.TrashShow')==0 and config('role_manage.PurchaseOrder.Create')==0 )
                            class="dis-none"
                            @endif  @if(Request::url() === route('purchase_order') or Request::url() === route('purchase_order.create') or Request::url() === route('purchase_order.trashed') or Request::url() === route('purchase_order.active.search') or Request::url() === route('purchase_order.trashed.search') )
                            class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>ثبت</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('purchase_order') or Request::url() === route('purchase_order.active.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.PurchaseOrder.All')==0)
                                       class="dis-none"
                                       @endif href="{{ route('purchase_order') }}">همه</a>
                                </li>
                                <li @if (Request::url() === route('purchase_order.create'))
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.PurchaseOrder.Create')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('purchase_order.create') }}">افزودن</a>
                                </li>
                                <li @if (Request::url() === route('purchase_order.trashed') or Request::url() === route('purchase_order.trashed.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.PurchaseOrder.TrashShow')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('purchase_order.trashed') }}">زباله دان</a>
                                </li>

                            </ul>

                        </li>

                        {{-- Requisiton Confirmed End--}}


                    </ul>
                </li>


                {{-- Purchase End --}}



                {{--Vendor  Start--}}
                <li @if ( config('role_manage.Vendor.All')==0 and  config('role_manage.Vendor.TrashShow')==0 and config('role_manage.Vendor.Create')==0  )
                    class="dis-none"
                    @endif  @if(Request::url() === route('vendor') or Request::url() === route('vendor.create') or Request::url() === route('vendor.trashed') or Request::url() === route('vendor.active.search') or Request::url() === route('vendor.trashed.search') )
                    class="active "
                        @endif >
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-industry"></i>
                        <span>فروشنده </span>
                    </a>

                    <ul class="ml-menu">
                        <li @if (Request::url() === route('vendor') or Request::url() === route('vendor.active.search') )
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Vendor.All')==0 )
                               class="dis-none"
                               @endif href="{{ route('vendor') }}">همه</a>
                        </li>
                        <li @if (Request::url() === route('vendor.create'))
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Vendor.Create')==0 )
                               class="dis-none"
                               @endif  href="{{ route('vendor.create') }}">افزودن</a>
                        </li>
                        <li @if (Request::url() === route('vendor.trashed') or Request::url() === route('vendor.trashed.search') )
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Vendor.TrashShow')==0 )
                               class="dis-none"
                               @endif  href="{{ route('vendor.trashed') }}">زباله دان</a>
                        </li>

                    </ul>

                </li>

                {{--Vedor End--}}


                {{--Employee  Start--}}
                <li @if ( config('role_manage.Employee.All')==0 and  config('role_manage.Employee.TrashShow')==0 and config('role_manage.Employee.Create')==0  )
                    class="dis-none"
                    @endif  @if(Request::url() === route('employee') or Request::url() === route('employee.create') or Request::url() === route('employee.trashed') or Request::url() === route('employee.active.search') or Request::url() === route('employee.trashed.search') )
                    class="active "
                        @endif >
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-user-graduate"></i>
                        <span>کارمندان </span>
                    </a>

                    <ul class="ml-menu">
                        <li @if (Request::url() === route('employee') or Request::url() === route('employee.active.search') )
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Employee.All')==0 )
                               class="dis-none"
                               @endif href="{{ route('employee') }}">همه</a>
                        </li>
                        <li @if (Request::url() === route('employee.create'))
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Employee.Create')==0 )
                               class="dis-none"
                               @endif  href="{{ route('employee.create') }}">افزودن</a>
                        </li>
                        <li @if (Request::url() === route('employee.trashed') or Request::url() === route('employee.trashed.search') )
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Employee.TrashShow')==0 )
                               class="dis-none"
                               @endif  href="{{ route('employee.trashed') }}">زباله دان</a>
                        </li>

                    </ul>

                </li>

                {{--Employee End--}}




                {{--Customer  Start--}}
                <li @if ( config('role_manage.Customer.All')==0 and  config('role_manage.Customer.TrashShow')==0 and config('role_manage.Customer.Create')==0  )
                    class="dis-none"
                    @endif  @if(Request::url() === route('customer') or Request::url() === route('customer.create') or Request::url() === route('customer.trashed') or Request::url() === route('customer.active.search') or Request::url() === route('customer.trashed.search') )
                    class="active "
                        @endif >
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-user-tie"></i>
                        <span>مشتریان </span>
                    </a>

                    <ul class="ml-menu">
                        <li @if (Request::url() === route('customer') or Request::url() === route('customer.active.search') )
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Customer.All')==0 )
                               class="dis-none"
                               @endif href="{{ route('customer') }}">همه</a>
                        </li>
                        <li @if (Request::url() === route('customer.create'))
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Customer.Create')==0 )
                               class="dis-none"
                               @endif  href="{{ route('customer.create') }}">افزودن</a>
                        </li>
                        <li @if (Request::url() === route('customer.trashed') or Request::url() === route('branch.trashed.search') )
                            class="active"
                                @endif>
                            <a @if ( config('role_manage.Customer.TrashShow')==0 )
                               class="dis-none"
                               @endif  href="{{ route('customer.trashed') }}">زباله دان</a>
                        </li>

                    </ul>

                </li>

                {{--Customer End--}}


                {{--Ledger--}}
                <li
                        @if (  config('role_manage.LedgerType.All')==0 and  config('role_manage.LedgerType.TrashShow')==0 and config('role_manage.LedgerType.Create')==0
                        and
                        config('role_manage.LedgerGroup.All')==0 and  config('role_manage.LedgerGroup.TrashShow')==0 and config('role_manage.LedgerGroup.Create')==0
                        and
                        config('role_manage.LedgerName.All')==0 and  config('role_manage.LedgerName.TrashShow')==0 and config('role_manage.LedgerName.Create')==0

                        )

                        class="dis-none"
                        @endif

                        @if(Request::url() === route('income_expense_type')
                        or Request::url() === route('income_expense_type.create')
                        or Request::url() === route('income_expense_type.trashed')
                        or Request::url() === route('income_expense_type.active.search')
                        or Request::url() === route('income_expense_type.trashed.search')

                        or Request::url() === route('income_expense_group')
                        or Request::url() === route('income_expense_group.create')
                        or Request::url() === route('income_expense_group.trashed')
                        or Request::url() === route('income_expense_group.active.search')
                        or Request::url() === route('income_expense_group.trashed.search')




                        or Request::url() === route('income_expense_head')
                        or Request::url() === route('income_expense_head.create')
                        or Request::url() === route('income_expense_head.trashed')
                        or Request::url() === route('income_expense_head.active.search')
                        or Request::url() === route('income_expense_head.trashed.search')



                    )
                        class="active"
                        @endif >
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>مدیر هزینه </span>
                    </a>
                    <ul class="ml-menu">

                        {{--Ledger Type Start--}}
                        <li @if ( config('role_manage.LedgerType.All')==0 and  config('role_manage.LedgerType.TrashShow')==0 and config('role_manage.LedgerType.Create')==0 )
                            class="dis-none"
                            @endif  @if(Request::url() === route('income_expense_type')
                            or Request::url() === route('income_expense_type.create')
                            or Request::url() === route('income_expense_type.trashed')
                            or Request::url() === route('income_expense_type.active.search')
                            or Request::url() === route('income_expense_type.trashed.search') )
                            class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>هزینه ها </span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('income_expense_type') or Request::url() === route('income_expense_type.active.search') )
                                    class="active"
                                        @endif>
                                    <a @if ( config('role_manage.LedgerType.All')==0 )
                                       class="dis-none"
                                       @endif href="{{ route('income_expense_type') }}">همه</a>
                                </li>
                                <li @if (Request::url() === route('income_expense_type.create'))
                                    class="active"
                                        @endif>
                                    <a @if ( config('role_manage.LedgerType.Create')==0 )
                                       class="dis-none"
                                       @endif  href="{{ route('income_expense_type.create') }}">افزودن</a>
                                </li>
                                <li @if (Request::url() === route('income_expense_type.trashed') or Request::url() === route('income_expense_type.trashed.search') )
                                    class="active"
                                        @endif>
                                    <a @if ( config('role_manage.LedgerType.TrashShow')==0 )
                                       class="dis-none"
                                       @endif  href="{{ route('income_expense_type.trashed') }}">زباله دان</a>
                                </li>

                            </ul>

                        </li>

                        {{--Income Expense Type End--}}


                        {{--Ledger Group Start--}}
                        <li @if ( config('role_manage.LedgerGroup.All')==0 and  config('role_manage.LedgerGroup.TrashShow')==0 and config('role_manage.LedgerGroup.Create')==0 )
                            class="dis-none"
                            @endif  @if(Request::url() === route('income_expense_group')
                            or Request::url() === route('income_expense_group.create')
                            or Request::url() === route('income_expense_group.trashed')
                            or Request::url() === route('income_expense_group.active.search')
                            or Request::url() === route('income_expense_group.trashed.search') )
                            class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>گروه ها </span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('income_expense_group') or Request::url() === route('income_expense_group.active.search') )
                                    class="active"
                                        @endif>
                                    <a @if ( config('role_manage.LedgerGroup.All')==0)
                                       class="dis-none"
                                       @endif href="{{ route('income_expense_group') }}">همه</a>
                                </li>
                                <li @if (Request::url() === route('income_expense_group.create'))
                                    class="active"
                                        @endif>
                                    <a @if ( config('role_manage.LedgerGroup.Create')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('income_expense_group.create') }}">افزودن</a>
                                </li>
                                <li @if (Request::url() === route('income_expense_group.trashed') or Request::url() === route('income_expense_group.trashed.search') )
                                    class="active"
                                        @endif>
                                    <a @if ( config('role_manage.LedgerGroup.TrashShow')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('income_expense_group.trashed') }}">زباله دان</a>
                                </li>

                            </ul>

                        </li>

                        {{--Ledger Group End--}}


                        {{--Ledger Name Start--}}

                        <li @if ( config('role_manage.LedgerName.All')==0 and  config('role_manage.LedgerName.TrashShow')==0 and config('role_manage.LedgerName.Create')==0 )
                            class="dis-none"
                            @endif  @if(Request::url() === route('income_expense_head')
                            or Request::url() === route('income_expense_head.create')
                            or Request::url() === route('income_expense_head.trashed')
                            or Request::url() === route('income_expense_head.active.search')
                            or Request::url() === route('income_expense_head.trashed.search') )
                            class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>مبالغ </span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('income_expense_head') or Request::url() === route('income_expense_head.active.search') )
                                    class="active"
                                        @endif>
                                    <a @if ( config('role_manage.LedgerName.All')==0)
                                       class="dis-none"
                                       @endif href="{{ route('income_expense_head') }}">همه</a>
                                </li>
                                <li @if (Request::url() === route('income_expense_head.create'))
                                    class="active"
                                        @endif>
                                    <a @if ( config('role_manage.LedgerName.Create')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('income_expense_head.create') }}">افزودن</a>
                                </li>
                                <li @if (Request::url() === route('income_expense_head.trashed') or Request::url() === route('income_expense_head.trashed.search') )
                                    class="active"
                                        @endif>
                                    <a @if ( config('role_manage.LedgerName.TrashShow')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('income_expense_head.trashed') }}">زباله دان</a>
                                </li>

                            </ul>

                        </li>

                        {{-- Ledger Name End--}}


                    </ul>

                </li>


                {{--Ledger End--}}



                {{--Bank Cash Start--}}

                <li @if ( config('role_manage.BankCash.All')==0 and  config('role_manage.BankCash.TrashShow')==0 and config('role_manage.BankCash.Create')==0 )
                    class="dis-none"
                    @endif  @if(Request::url() === route('bank_cash') or Request::url() === route('bank_cash.create') or Request::url() === route('bank_cash.trashed') or Request::url() === route('bank_cash.active.search') or Request::url() === route('bank_cash.trashed.search') )
                    class="active "
                        @endif >
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-university"></i>
                        <span>موجودی </span>
                    </a>

                    <ul class="ml-menu">
                        <li @if (Request::url() === route('bank_cash') or Request::url() === route('bank_cash.active.search') )
                            class="active"
                                @endif>
                            <a @if (config('role_manage.BankCash.All')==0)
                               class="dis-none"
                               @endif href="{{ route('bank_cash') }}">همه</a>
                        </li>
                        <li @if (Request::url() === route('bank_cash.create'))
                            class="active"
                                @endif>
                            <a @if (config('role_manage.BankCash.Create')==0)
                               class="dis-none"
                               @endif  href="{{ route('bank_cash.create') }}">افزودن</a>
                        </li>
                        <li @if (Request::url() === route('bank_cash.trashed') or Request::url() === route('bank_cash.trashed.search') )
                            class="active"
                                @endif>
                            <a @if (config('role_manage.BankCash.TrashShow')==0)
                               class="dis-none"
                               @endif  href="{{ route('bank_cash.trashed') }}">زباله دان</a>
                        </li>

                    </ul>

                </li>

                {{--Bankcash End--}}

                {{--Opening Balance Start--}}

                <li

                        @if (config('role_manage.InitialIncomeExpenseHeadBalance.All')==0 and  config('role_manage.InitialIncomeExpenseHeadBalance.TrashShow')==0 and config('role_manage.InitialIncomeExpenseHeadBalance.Create')==0
                            and
                             config('role_manage.InitialBankCashBalance.All')==0 and  config('role_manage.InitialBankCashBalance.TrashShow')==0 and config('role_manage.InitialBankCashBalance.Create')==0


                        )
                        class="dis-none"
                        @endif


                        @if( Request::url() === route('initial_bank_cash_balance') or Request::url() === route('initial_bank_cash_balance.create') or
                        Request::url() === route('initial_bank_cash_balance.trashed') or Request::url() === route('initial_bank_cash_balance.active.search') or Request::url() === route('initial_bank_cash_balance.trashed.search')
                        or
                        Request::url() === route('initial_income_expense_head_balance') or Request::url() === route('initial_income_expense_head_balance.create') or
                        Request::url() === route('initial_income_expense_head_balance.trashed') or Request::url() === route('initial_income_expense_head_balance.active.search') or Request::url() === route('initial_income_expense_head_balance.trashed.search')



                ) class="active " @endif >
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-balance-scale"></i>
                        <span>مقادیر اولیه</span>
                    </a>

                    <ul class="ml-menu">

                        {{-- Initial Bank Cash Balance Start--}}

                        <li @if ( config('role_manage.InitialBankCashBalance.All')==0 and  config('role_manage.InitialBankCashBalance.TrashShow')==0 and config('role_manage.InitialBankCashBalance.Create')==0 )
                            class="dis-none"
                            @endif  @if(Request::url() === route('initial_bank_cash_balance') or Request::url() === route('initial_bank_cash_balance.create') or Request::url() === route('initial_bank_cash_balance.trashed') or Request::url() === route('initial_bank_cash_balance.active.search') or Request::url() === route('initial_bank_cash_balance.trashed.search') )
                            class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>پول نقد </span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('initial_bank_cash_balance') or Request::url() === route('initial_bank_cash_balance.active.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.InitialBankCashBalance.All')==0)
                                       class="dis-none"
                                       @endif href="{{ route('initial_bank_cash_balance') }}">همه</a>
                                </li>
                                <li @if (Request::url() === route('initial_bank_cash_balance.create'))
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.InitialBankCashBalance.Create')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('initial_bank_cash_balance.create') }}">افزودن</a>
                                </li>
                                <li @if (Request::url() === route('initial_bank_cash_balance.trashed') or Request::url() === route('initial_bank_cash_balance.trashed.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.InitialBankCashBalance.TrashShow')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('initial_bank_cash_balance.trashed') }}">زباله دان</a>
                                </li>

                            </ul>

                        </li>

                        {{--Initial Bank Cash Balance End--}}


                        {{--initial_income_expense_head_balance Start--}}


                        <li @if ( config('role_manage.InitialIncomeExpenseHeadBalance.All')==0 and  config('role_manage.InitialIncomeExpenseHeadBalance.TrashShow')==0 and config('role_manage.InitialIncomeExpenseHeadBalance.Create')==0)
                            class="dis-none"
                            @endif  @if(Request::url() === route('initial_income_expense_head_balance') or Request::url() === route('initial_income_expense_head_balance.create') or Request::url() === route('initial_income_expense_head_balance.trashed') or Request::url() === route('initial_income_expense_head_balance.active.search') or Request::url() === route('initial_income_expense_head_balance.trashed.search') )
                            class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">

                                <span>سرمایه</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('initial_income_expense_head_balance') or Request::url() === route('initial_income_expense_head_balance.active.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.InitialIncomeExpenseHeadBalance.All')==0)
                                       class="dis-none"
                                       @endif href="{{ route('initial_income_expense_head_balance') }}">همه</a>
                                </li>
                                <li @if (Request::url() === route('initial_income_expense_head_balance.create'))
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.InitialIncomeExpenseHeadBalance.Create')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('initial_income_expense_head_balance.create') }}">افزودن</a>
                                </li>
                                <li @if (Request::url() === route('initial_income_expense_head_balance.trashed') or Request::url() === route('initial_income_expense_head_balance.trashed.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.InitialIncomeExpenseHeadBalance.TrashShow')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('initial_income_expense_head_balance.trashed') }}">زباله دان</a>
                                </li>

                            </ul>

                        </li>

                        {{--initial_income_expense_head_balance End--}}


                    </ul>
                </li>

                {{--Opening Balance Start--}}



                {{--Voucher Start--}}

                <li
                        @if( config('role_manage.CrVoucher.All')==0 and  config('role_manage.CrVoucher.TrashShow')==0 and config('role_manage.CrVoucher.Create')==0

                        and
                         config('role_manage.DrVoucher.All')==0 and  config('role_manage.DrVoucher.TrashShow')==0 and config('role_manage.DrVoucher.Create')==0
                        and
                        config('role_manage.JnlVoucher.All')==0 and  config('role_manage.JnlVoucher.TrashShow')==0 and config('role_manage.JnlVoucher.Create')==0
                        and
                         config('role_manage.ContraVoucher.All')==0 and  config('role_manage.ContraVoucher.TrashShow')==0 and config('role_manage.ContraVoucher.Create')==0


                        )
                        class="dis-none"
                        @endif


                        @if( Request::url() === route('dr_voucher') or Request::url() === route('dr_voucher.create') or
                Request::url() === route('dr_voucher.trashed') or Request::url() === route('dr_voucher.active.search') or Request::url() === route('dr_voucher.trashed.search')

                or Request::url() === route('cr_voucher') or Request::url() === route('cr_voucher.create') or
                Request::url() === route('cr_voucher.trashed') or Request::url() === route('cr_voucher.active.search') or Request::url() === route('cr_voucher.trashed.search')

                or Request::url() === route('jnl_voucher') or Request::url() === route('jnl_voucher.create') or
                Request::url() === route('jnl_voucher.trashed') or Request::url() === route('jnl_voucher.active.search') or Request::url() === route('jnl_voucher.trashed.search')


                or Request::url() === route('contra_voucher') or Request::url() === route('contra_voucher.create') or
                Request::url() === route('contra_voucher.trashed') or Request::url() === route('contra_voucher.active.search') or Request::url() === route('contra_voucher.trashed.search')



                )

                        class="active "
                        @endif >
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="material-icons">account_balance_wAllet</i>
                        <span>Voucher</span>
                    </a>

                    <ul class="ml-menu">

                        {{--Cr Voucher Start--}}

                        <li @if ( config('role_manage.CrVoucher.All')==0 and  config('role_manage.CrVoucher.TrashShow')==0 and config('role_manage.CrVoucher.Create')==0  )
                            class="dis-none"
                            @endif  @if(Request::url() === route('cr_voucher') or Request::url() === route('cr_voucher.create') or Request::url() === route('cr_voucher.trashed') or Request::url() === route('cr_voucher.active.search') or Request::url() === route('cr_voucher.trashed.search') )
                            class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <i class="fas fa-arrow-right"></i>
                                <span>Credit</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('cr_voucher') or Request::url() === route('cr_voucher.active.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.CrVoucher.All')==0)
                                       class="dis-none"
                                       @endif href="{{ route('cr_voucher') }}">All</a>
                                </li>
                                <li @if (Request::url() === route('cr_voucher.create'))
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.CrVoucher.Create')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('cr_voucher.create') }}">Create</a>
                                </li>
                                <li @if (Request::url() === route('cr_voucher.trashed') or Request::url() === route('cr_voucher.trashed.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.CrVoucher.TrashShow')==0)
                                       class="dis-none"
                                       @endif  href="{{ route('cr_voucher.trashed') }}">Trashed</a>
                                </li>
                            </ul>
                        </li>

                        {{--cr Voucher End--}}

                        {{--Dr Voucher Start--}}

                        <li @if ( config('role_manage.DrVoucher.All')==0 and  config('role_manage.DrVoucher.TrashShow')==0 and config('role_manage.DrVoucher.Create')==0   )
                            class="dis-none"
                            @endif  @if(Request::url() === route('dr_voucher') or Request::url() === route('dr_voucher.create') or Request::url() === route('dr_voucher.trashed') or Request::url() === route('dr_voucher.active.search') or Request::url() === route('dr_voucher.trashed.search') )
                            class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <i class="fas fa-arrow-left"></i>
                                <span>Debit</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('dr_voucher') or Request::url() === route('dr_voucher.active.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.DrVoucher.All')==0 )
                                       class="dis-none"
                                       @endif href="{{ route('dr_voucher') }}">All</a>
                                </li>
                                <li @if (Request::url() === route('dr_voucher.create'))
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.DrVoucher.Create')==0 )
                                       class="dis-none"
                                       @endif  href="{{ route('dr_voucher.create') }}">Create</a>
                                </li>
                                <li @if (Request::url() === route('dr_voucher.trashed') or Request::url() === route('dr_voucher.trashed.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.DrVoucher.TrashShow')==0 )
                                       class="dis-none"
                                       @endif  href="{{ route('dr_voucher.trashed') }}">Trashed</a>
                                </li>
                            </ul>
                        </li>

                        {{--Dr Voucher End--}}


                        {{--Jnl Voucher Start--}}

                        <li @if ( config('role_manage.JnlVoucher.All')==0 and  config('role_manage.JnlVoucher.TrashShow')==0 and config('role_manage.JnlVoucher.Create')==0  )
                            class="dis-none"
                            @endif  @if(Request::url() === route('jnl_voucher') or Request::url() === route('jnl_voucher.create') or Request::url() === route('jnl_voucher.trashed') or Request::url() === route('jnl_voucher.active.search') or Request::url() === route('jnl_voucher.trashed.search') )
                            class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <i class="fas fa-arrows-alt-h"></i>
                                <span>Journal</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('jnl_voucher') or Request::url() === route('jnl_voucher.active.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.JnlVoucher.All')==0 )
                                       class="dis-none"
                                       @endif href="{{ route('jnl_voucher') }}">All</a>
                                </li>
                                <li @if (Request::url() === route('jnl_voucher.create'))
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.JnlVoucher.Create')==0 )
                                       class="dis-none"
                                       @endif  href="{{ route('jnl_voucher.create') }}">Create</a>
                                </li>
                                <li @if (Request::url() === route('jnl_voucher.trashed') or Request::url() === route('jnl_voucher.trashed.search') )
                                    class="active"
                                        @endif>
                                    <a @if (config('role_manage.JnlVoucher.TrashShow')==0 )
                                       class="dis-none"
                                       @endif  href="{{ route('jnl_voucher.trashed') }}">Trashed</a>
                                </li>
                            </ul>
                        </li>

                        {{--Jnl Voucher End--}}

                        {{--contra_voucher Start--}}

                        <li @if ( config('role_manage.ContraVoucher.All')==0 and  config('role_manage.ContraVoucher.TrashShow')==0 and config('role_manage.ContraVoucher.Create')==0  )
                            class="dis-none"
                            @endif  @if(Request::url() === route('contra_voucher') or Request::url() === route('contra_voucher.create') or Request::url() === route('contra_voucher.trashed') or Request::url() === route('contra_voucher.active.search') or Request::url() === route('contra_voucher.trashed.search') )
                            class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <i class="fas fa-arrows-alt-h"></i>
                                <span>Contra</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('contra_voucher') or Request::url() === route('contra_voucher.active.search') )
                                    class="active"
                                        @endif>
                                    <a @if ( config('role_manage.ContraVoucher.All')==0 )
                                       class="dis-none"
                                       @endif href="{{ route('contra_voucher') }}">All</a>
                                </li>
                                <li @if (Request::url() === route('contra_voucher.create'))
                                    class="active"
                                        @endif>
                                    <a @if ( config('role_manage.ContraVoucher.Create')==0 )
                                       class="dis-none"
                                       @endif  href="{{ route('contra_voucher.create') }}">Create</a>
                                </li>
                                <li @if (Request::url() === route('contra_voucher.trashed') or Request::url() === route('contra_voucher.trashed.search') )
                                    class="active"
                                        @endif>
                                    <a @if ( config('role_manage.ContraVoucher.TrashShow')==0 )
                                       class="dis-none"
                                       @endif  href="{{ route('contra_voucher.trashed') }}">Trashed</a>
                                </li>
                            </ul>
                        </li>

                        {{--contra_voucher End--}}

                    </ul>
                </li>

                {{--Voucher End--}}

                {{--Report Start--}}

                <?php

                $AccountsShow = (config('role_manage.Ledger.All') or config('role_manage.TrialBalance.All') or config('role_manage.CostOfRevenue.All')
                    or config('role_manage.ProfitOrLossAccount.All') or config('role_manage.RetainedEarning.All') or config('role_manage.FixedAssetsSchedule.All')
                    or config('role_manage.StatementOfFinancialPosition.All') or config('role_manage.CashFlow.All') or config('role_manage.ReceiveAndPayment.All')
                    or config('role_manage.Notes.All'));


                $generalShow = (config('role_manage.generalBranch.All') or config('role_manage.generalledger.All')
                    or config('role_manage.generalBankCash.All') or config('role_manage.generalVoucher.All'));

                $sellsShow = (config('role_manage.SellsReport.All'));
                $purchaseShow = (config('role_manage.PurchaseReport.All'));

                ?>

                <li @if( $AccountsShow ==false and $generalShow==false and $sellsShow==false and $purchaseShow==false)
                    class="dis-none"
                    @endif

                    @if(Request::url() === route('reports.accounts.ledger')

                    Or
                    Request::url() === route('reports.accounts.trial_balance')
                    Or
                    Request::url() === route('reports.accounts.cost_of_revenue')

                    Or
                    Request::url() === route('reports.accounts.profit_or_loss_account')

                    Or
                    Request::url() === route('reports.accounts.retained_earnings')

                    Or
                    Request::url() === route('reports.accounts.fixed_asset_schedule')

                    Or
                    Request::url() === route('reports.accounts.balance_sheet')

                    Or
                    Request::url() === route('reports.accounts.receive_payment')

                    Or
                    Request::url() === route('reports.accounts.notes')

                    Or
                    Request::url() === route('reports.accounts.cash_flow')



                    Or
                    Request::url() === route('reports.general.branch')

                    Or
                    Request::url() === route('reports.general.ledger.type')

                    Or
                    Request::url() === route('reports.general.bank_cash')

                    Or
                    Request::url() === route('reports.general.voucher')

                    Or
                    Request::url() === route('report.sells.party_ledger')

                    Or
                    Request::url() === route('report.purchase')



                     )
                    class="active "
                        @endif>
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-receipt"></i>
                        <span>Report</span>
                    </a>
                    <ul class="ml-menu">
                        {{--Accounts Report Start--}}
                        <li
                                @if($AccountsShow == false)
                                class="dis-none"
                                @endif

                                @if(Request::url() === route('reports.accounts.ledger')

                        Or
                        Request::url() === route('reports.accounts.trial_balance')
                        Or
                        Request::url() === route('reports.accounts.cost_of_revenue')
                        Or
                        Request::url() === route('reports.accounts.profit_or_loss_account')

                        Or
                        Request::url() === route('reports.accounts.retained_earnings')

                        Or
                        Request::url() === route('reports.accounts.fixed_asset_schedule')

                        Or
                        Request::url() === route('reports.accounts.balance_sheet')

                        Or
                        Request::url() === route('reports.accounts.receive_payment')

                        Or
                        Request::url() === route('reports.accounts.notes')

                        Or
                        Request::url() === route('reports.accounts.cash_flow')





                         )
                                class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>Accounts </span>
                            </a>


                            <ul class="ml-menu">
                                <li @if( config('role_manage.Ledger.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if(Request::url() === route('reports.accounts.ledger')

                     )
                                    class="active "
                                        @endif>
                                    <a href="{{ route('reports.accounts.ledger') }}">Ledger</a>
                                </li>

                                <li @if( config('role_manage.TrialBalance.All')==0 )
                                    class="dis-none"
                                    @endif
                                    @if(Request::url() === route('reports.accounts.trial_balance')

                     )
                                    class="active "
                                        @endif>
                                    <a href="{{ route('reports.accounts.trial_balance') }}">Trial Balance</a>
                                </li>

                                <li @if( config('role_manage.CostOfRevenue.All')==0 )
                                    class="dis-none"
                                    @endif
                                    @if(Request::url() === route('reports.accounts.cost_of_revenue')

                     )
                                    class="active "
                                        @endif>
                                    <a href="{{ route('reports.accounts.cost_of_revenue')  }}">Cost Of Revenue</a>
                                </li>
                                <li
                                        @if( config('role_manage.ProfitOrLossAccount.All')==0 )
                                        class="dis-none"
                                        @endif

                                        @if(Request::url() === route('reports.accounts.profit_or_loss_account')

                         )
                                        class="active "
                                        @endif>
                                    <a href="{{ route('reports.accounts.profit_or_loss_account')  }}">Profit Or loss
                                        account</a>
                                </li>
                                <li @if( config('role_manage.RetainedEarning.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if(Request::url() === route('reports.accounts.retained_earnings')

                         )
                                    class="active "
                                        @endif>
                                    <a href="{{ route('reports.accounts.retained_earnings')  }}">Retained earnings</a>
                                </li>
                                <li @if( config('role_manage.FixedAssetsSchedule.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if(Request::url() === route('reports.accounts.fixed_asset_schedule')

                         )
                                    class="active "
                                        @endif >
                                    <a href="{{ route('reports.accounts.fixed_asset_schedule') }}">Fixed Asset
                                        Schedule</a>
                                </li>
                                <li
                                        @if( config('role_manage.StatementOfFinancialPosition.All')==0 )
                                        class="dis-none"
                                        @endif

                                        @if(Request::url() === route('reports.accounts.balance_sheet')

                         )
                                        class="active "
                                        @endif >
                                    <a href=" {{ route('reports.accounts.balance_sheet') }} ">Balance sheet</a>
                                </li>

                                <li @if( config('role_manage.CashFlow.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if( Request::url() === route('reports.accounts.cash_flow') )
                                    class="active"
                                        @endif >
                                    <a href="{{ route('reports.accounts.cash_flow') }}">Cash flow</a>
                                </li>

                                <li
                                        @if( config('role_manage.ReceiveAndPayment.All')==0 )
                                        class="dis-none"
                                        @endif

                                        @if(Request::url() === route('reports.accounts.receive_payment')

                         )
                                        class="active "
                                        @endif >
                                    <a href="{{ route('reports.accounts.receive_payment')  }}">Receive Payment</a>
                                </li>

                                <li
                                        @if( config('role_manage.Notes.All')==0 )
                                        class="dis-none"
                                        @endif

                                        @if(Request::url() === route('reports.accounts.notes')

                         )
                                        class="active "
                                        @endif >
                                    <a href="{{ route('reports.accounts.notes')  }}">Notes</a>
                                </li>


                            </ul>
                        </li>

                        {{--Accounts Report End--}}


                        {{--Selles Report Start--}}

                        <li @if( config('role_manage.SellsReport.All')==0 )
                            class="dis-none"
                            @endif

                            @if(Request::url() === route('report.sells.party_ledger')

                            )
                            class="active "
                                @endif >

                            <a href="{{ route('report.sells.party_ledger') }}">Sells</a>

                        </li>

                        {{--Selles Report End--}}


                        {{--Purchase Report Start--}}

                        <li @if( config('role_manage.PurchaseReport.All')==0 )
                            class="dis-none"
                            @endif

                            @if(Request::url() === route('report.purchase')

                            )
                            class="active "
                                @endif >

                            <a href="{{ route('report.purchase') }}">
                                <span>Purchase</span>
                            </a>
                        </li>

                        {{--Purchase Report End--}}




                        {{--general Report Start--}}
                        <li @if($generalShow == false)
                            class="dis-none"
                            @endif

                            @if(Request::url() === route('reports.general.branch')

                        or
                        Request::url() === route('reports.general.ledger.type')

                        or
                        Request::url() === route('reports.general.bank_cash')

                        or
                        Request::url() === route('reports.general.voucher')



                     )
                            class="active "
                                @endif


                        >


                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>general</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if( config('role_manage.generalBranch.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if(Request::url() === route('reports.general.branch'))
                                    class="active "
                                        @endif >
                                    <a href="{{ route('reports.general.branch') }}">Project</a>
                                </li>

                                <li @if( config('role_manage.generalledger.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if(Request::url() === route('reports.general.ledger.type'))
                                    class="active "
                                        @endif >
                                    <a href="{{ route('reports.general.ledger.type') }}">Ledger</a>
                                </li>

                                <li @if( config('role_manage.generalBankCash.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if(Request::url() === route('reports.general.bank_cash'))
                                    class="active "
                                        @endif >
                                    <a href="{{ route('reports.general.bank_cash') }}">Bank Cash</a>
                                </li>

                                <li
                                        @if( config('role_manage.generalVoucher.All')==0 )
                                        class="dis-none"
                                        @endif

                                        @if(Request::url() === route('reports.general.voucher'))
                                        class="active "
                                        @endif >
                                    <a href="{{ route('reports.general.voucher') }}">Voucher</a>
                                </li>


                            </ul>

                        </li>
                        {{--general Report End--}}

                    </ul>
                </li>


                {{--Report End--}}

                {{--User Start--}}
                <li @if ( config('role_manage.User.All')==0 and  config('role_manage.User.TrashShow')==0 and config('role_manage.User.Create')==0  )
                    class="dis-none"
                    @endif  @if(Request::url() === route('user') or Request::url() === route('user.create') or Request::url() === route('user.trashed') or Request::url() === route('user.active.search') or Request::url() === route('user.trashed.search') )
                    class="active "
                        @endif >
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-user"></i>
                        <span>کاربران</span>
                    </a>

                    <ul class="ml-menu">
                        <li @if (Request::url() === route('user') or Request::url() === route('user.active.search') )
                            class="active"
                                @endif>
                            <a @if (config('role_manage.User.All')==0)
                               class="dis-none"
                               @endif href="{{ route('user') }}">همه</a>
                        </li>
                        <li @if (Request::url() === route('user.create'))
                            class="active"
                                @endif>
                            <a @if (config('role_manage.User.Create')==0)
                               class="dis-none"
                               @endif  href="{{ route('user.create') }}">افزودن</a>
                        </li>
                        <li @if (Request::url() === route('user.trashed') or Request::url() === route('user.trashed.search') )
                            class="active"
                                @endif>
                            <a @if (config('role_manage.User.TrashShow')==0)
                               class="dis-none"
                               @endif  href="{{ route('user.trashed') }}">زباله دان</a>
                        </li>

                    </ul>

                </li>

                {{--User End--}}

                {{--role-manage Start--}}
                <li @if(Request::url() === route('role-manage') or Request::url() === route('role-manage.create') or Request::url() === route('role-manage.trashed') or Request::url() === route('role-manage.active.search') or Request::url() === route('role-manage.trashed.search') )
                    class="active"
                    @endif @if ( config('role_manage.RoleManager.All')==0 and  config('role_manage.RoleManager.TrashShow')==0 and config('role_manage.RoleManager.Create')==0 )
                    class="dis-none"
                        @endif>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-user-lock "></i>
                        <span>مدیریت دسترسی</span>
                    </a>

                    <ul class="ml-menu">
                        <li @if (Request::url() === route('role-manage') or Request::url() === route('role-manage.active.search') )
                            class="active"
                                @endif >
                            <a
                                    @if (config('role_manage.RoleManager.All')==0)
                                    class="dis-none"
                                    @endif href="{{ route('role-manage') }}">همه</a>
                        </li>
                        <li @if (Request::url() === route('role-manage.create'))
                            class="active"
                                @endif>
                            <a @if (config('role_manage.RoleManager.Create')==0)
                               class="dis-none"
                               @endif href="{{ route('role-manage.create') }}">افزودن</a>
                        </li>
                        <li @if (Request::url() === route('role-manage.trashed') or Request::url() === route('role-manage.trashed.search') )
                            class="active"
                                @endif>
                            <a @if (config('role_manage.RoleManager.TrashShow')==0)
                               class="dis-none"
                               @endif  href="{{ route('role-manage.trashed') }}">زباله دان</a>
                        </li>
                    </ul>
                </li>
                {{--role-manage End--}}

                {{--SETTINGSStart--}}
                <li @if(Request::url() === route('settings.system')
                    or Request::url() === route('settings.general')
                 )
                    class="active"
                    @endif
                    @if( config('role_manage.Settings.All') ==0 and config('role_manage.Settings.Show') ==0 )

                    class="dis-none"

                        @endif >
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="material-icons">settings</i>
                        <span>تنظیمات</span>
                    </a>
                    <ul class="ml-menu">


                        <li @if ( config('role_manage.Settings.All') ==0 )
                            class="dis-none"
                            @endif

                            @if(Request::url() === route('settings.general'))
                            class="active"
                                @endif >
                            <a href="{{ route('settings.general')  }}"> عمومی </a>
                        </li>


                        <li @if ( config('role_manage.Settings.Show') ==0 )
                            class="dis-none"
                            @endif
                            @if(Request::url() === route('settings.system'))
                            class="active"
                                @endif >
                            <a href="{{ route('settings.system')  }}">سیستم</a>
                        </li>


                    </ul>
                </li>
                {{--SETTINGS End--}}

            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                {{ config('settings.developed_label') }} <a target="_blank"
                                                            href="{{ config('settings.developed_link') }}">{{ config('settings.developed_by') }}</a>
            </div>
            <div class="version">
                <b>Version: </b> {{ config('settings.version') }}
            </div>
        </div>
        <!-- #Footer -->
    </aside>
</section>
