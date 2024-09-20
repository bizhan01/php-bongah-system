<?php

namespace App\Http;

use App\Http\Middleware\RoleCreate;
use App\Http\Middleware\Roles\RoleShow;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,

            \App\Http\Middleware\Settings::class,
            \App\Http\Middleware\RoleManage::class,

        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        'role.module_show' => \App\Http\Middleware\Roles\RoleManage\ModuleShow::class,
        'role.show' => \App\Http\Middleware\Roles\RoleManage\Show::class,
        'role.create' => \App\Http\Middleware\Roles\RoleManage\Create::class,
        'role.edit' => \App\Http\Middleware\Roles\RoleManage\Edit::class,
        'role.delete' => \App\Http\Middleware\Roles\RoleManage\Delete::class,
        'role.pdf' => \App\Http\Middleware\Roles\RoleManage\Pdf::class,
        'role.restore' => \App\Http\Middleware\Roles\RoleManage\Restore::class,
        'role.trash_show' => \App\Http\Middleware\Roles\RoleManage\TrashShow::class,
        'role.permanently_delete' => \App\Http\Middleware\Roles\RoleManage\PermanentlyDelete::class,

        'user.module_show' => \App\Http\Middleware\Roles\UserManage\ModuleShow::class,
        'user.show' => \App\Http\Middleware\Roles\UserManage\Show::class,
        'user.create' => \App\Http\Middleware\Roles\UserManage\Create::class,
        'user.edit' => \App\Http\Middleware\Roles\UserManage\Edit::class,
        'user.delete' => \App\Http\Middleware\Roles\UserManage\Delete::class,
        'user.pdf' => \App\Http\Middleware\Roles\UserManage\Pdf::class,
        'user.restore' => \App\Http\Middleware\Roles\UserManage\Restore::class,
        'user.trash_show' => \App\Http\Middleware\Roles\UserManage\TrashShow::class,
        'user.permanently_delete' => \App\Http\Middleware\Roles\UserManage\PermanentlyDelete::class,

        'settings.all' => \App\Http\Middleware\Roles\Settings\All::class,
        'settings.show' => \App\Http\Middleware\Roles\Settings\Show::class,


        'branch.module_show' => \App\Http\Middleware\Roles\Branch\ModuleShow::class,
        'branch.show' => \App\Http\Middleware\Roles\Branch\Show::class,
        'branch.create' => \App\Http\Middleware\Roles\Branch\Create::class,
        'branch.edit' => \App\Http\Middleware\Roles\Branch\Edit::class,
        'branch.delete' => \App\Http\Middleware\Roles\Branch\Delete::class,
        'branch.pdf' => \App\Http\Middleware\Roles\Branch\Pdf::class,
        'branch.restore' => \App\Http\Middleware\Roles\Branch\Restore::class,
        'branch.trash_show' => \App\Http\Middleware\Roles\Branch\TrashShow::class,
        'branch.permanently_delete' => \App\Http\Middleware\Roles\Branch\PermanentlyDelete::class,


        'product.all' => \App\Http\Middleware\Roles\Product\All::class,
        'product.show' => \App\Http\Middleware\Roles\Product\Show::class,
        'product.create' => \App\Http\Middleware\Roles\Product\Create::class,
        'product.edit' => \App\Http\Middleware\Roles\Product\Edit::class,
        'product.delete' => \App\Http\Middleware\Roles\Product\Delete::class,
        'product.pdf' => \App\Http\Middleware\Roles\Product\Pdf::class,
        'product.restore' => \App\Http\Middleware\Roles\Product\Restore::class,
        'product.trash_show' => \App\Http\Middleware\Roles\Product\TrashShow::class,
        'product.permanently_delete' => \App\Http\Middleware\Roles\Product\PermanentlyDelete::class,

        'sell.all' => \App\Http\Middleware\Roles\Sell\All::class,
        'sell.show' => \App\Http\Middleware\Roles\Sell\Show::class,
        'sell.create' => \App\Http\Middleware\Roles\Sell\Create::class,
        'sell.edit' => \App\Http\Middleware\Roles\Sell\Edit::class,
        'sell.delete' => \App\Http\Middleware\Roles\Sell\Delete::class,
        'sell.pdf' => \App\Http\Middleware\Roles\Sell\Pdf::class,
        'sell.restore' => \App\Http\Middleware\Roles\Sell\Restore::class,
        'sell.trash_show' => \App\Http\Middleware\Roles\Sell\TrashShow::class,
        'sell.permanently_delete' => \App\Http\Middleware\Roles\Sell\PermanentlyDelete::class,

        'purchase_requisition.all' => \App\Http\Middleware\Roles\PurchaseRequisition\All::class,
        'purchase_requisition.show' => \App\Http\Middleware\Roles\PurchaseRequisition\Show::class,
        'purchase_requisition.create' => \App\Http\Middleware\Roles\PurchaseRequisition\Create::class,
        'purchase_requisition.edit' => \App\Http\Middleware\Roles\PurchaseRequisition\Edit::class,
        'purchase_requisition.delete' => \App\Http\Middleware\Roles\PurchaseRequisition\Delte::class,
        'purchase_requisition.pdf' => \App\Http\Middleware\Roles\PurchaseRequisition\Pdf::class,
        'purchase_requisition.restore' => \App\Http\Middleware\Roles\PurchaseRequisition\Restore::class,
        'purchase_requisition.trash_show' => \App\Http\Middleware\Roles\PurchaseRequisition\TrashShow::class,
        'purchase_requisition.permanently_delete' => \App\Http\Middleware\Roles\PurchaseRequisition\PermanentlyDelete::class,

        'purchase_rqn_confirm.all' => \App\Http\Middleware\Roles\PurchaseRQNConfirm\All::class,
        'purchase_rqn_confirm.show' => \App\Http\Middleware\Roles\PurchaseRQNConfirm\Show::class,
        'purchase_rqn_confirm.create' => \App\Http\Middleware\Roles\PurchaseRQNConfirm\Create::class,
        'purchase_rqn_confirm.edit' => \App\Http\Middleware\Roles\PurchaseRQNConfirm\Edit::class,
        'purchase_rqn_confirm.delete' => \App\Http\Middleware\Roles\PurchaseRQNConfirm\Delete::class,
        'purchase_rqn_confirm.pdf' => \App\Http\Middleware\Roles\PurchaseRQNConfirm\Pdf::class,
        'purchase_rqn_confirm.restore' => \App\Http\Middleware\Roles\PurchaseRQNConfirm\Restore::class,
        'purchase_rqn_confirm.trash_show' => \App\Http\Middleware\Roles\PurchaseRQNConfirm\TrashShow::class,
        'purchase_rqn_confirm.permanently_delete' => \App\Http\Middleware\Roles\PurchaseRQNConfirm\PermanentlyDelete::class,

        'purchase_order.all' => \App\Http\Middleware\Roles\PurchaseOrder\All::class,
        'purchase_order.show' => \App\Http\Middleware\Roles\PurchaseOrder\Show::class,
        'purchase_order.create' => \App\Http\Middleware\Roles\PurchaseOrder\Create::class,
        'purchase_order.edit' => \App\Http\Middleware\Roles\PurchaseOrder\Edit::class,
        'purchase_order.delete' => \App\Http\Middleware\Roles\PurchaseOrder\Delete::class,
        'purchase_order.pdf' => \App\Http\Middleware\Roles\PurchaseOrder\Pdf::class,
        'purchase_order.restore' => \App\Http\Middleware\Roles\PurchaseOrder\Restore::class,
        'purchase_order.trash_show' => \App\Http\Middleware\Roles\PurchaseOrder\TrashShow::class,
        'purchase_order.permanently_delete' => \App\Http\Middleware\Roles\PurchaseOrder\PermanentlyDelete::class,

        'vendor.all' => \App\Http\Middleware\Roles\Vendor\All::class,
        'vendor.show' => \App\Http\Middleware\Roles\Vendor\Show::class,
        'vendor.create' => \App\Http\Middleware\Roles\Vendor\Create::class,
        'vendor.edit' => \App\Http\Middleware\Roles\Vendor\Edit::class,
        'vendor.delete' => \App\Http\Middleware\Roles\Vendor\Delete::class,
        'vendor.pdf' => \App\Http\Middleware\Roles\Vendor\Pdf::class,
        'vendor.restore' => \App\Http\Middleware\Roles\Vendor\Restore::class,
        'vendor.trash_show' => \App\Http\Middleware\Roles\Vendor\TrashShow::class,
        'vendor.permanently_delete' => \App\Http\Middleware\Roles\Vendor\PermanentlyDelete::class,

        'employee.all' => \App\Http\Middleware\Roles\Employee\All::class,
        'employee.show' => \App\Http\Middleware\Roles\Employee\Show::class,
        'employee.create' => \App\Http\Middleware\Roles\Employee\Create::class,
        'employee.edit' => \App\Http\Middleware\Roles\Employee\Edit::class,
        'employee.delete' => \App\Http\Middleware\Roles\Employee\Delete::class,
        'employee.pdf' => \App\Http\Middleware\Roles\Employee\Pdf::class,
        'employee.restore' => \App\Http\Middleware\Roles\Employee\Restore::class,
        'employee.trash_show' => \App\Http\Middleware\Roles\Employee\TrashShow::class,
        'employee.permanently_delete' => \App\Http\Middleware\Roles\Employee\PermanentlyDelete::class,

        'customer.all' => \App\Http\Middleware\Roles\Customer\All::class,
        'customer.show' => \App\Http\Middleware\Roles\Customer\Show::class,
        'customer.create' => \App\Http\Middleware\Roles\Customer\Create::class,
        'customer.edit' => \App\Http\Middleware\Roles\Customer\Edit::class,
        'customer.delete' => \App\Http\Middleware\Roles\Customer\Delete::class,
        'customer.pdf' => \App\Http\Middleware\Roles\Customer\Pdf::class,
        'customer.restore' => \App\Http\Middleware\Roles\Customer\Restore::class,
        'customer.trash_show' => \App\Http\Middleware\Roles\Customer\TrashShow::class,
        'customer.permanently_delete' => \App\Http\Middleware\Roles\Customer\PermanentlyDelete::class,

        'purchase_report.all' => \App\Http\Middleware\Roles\PurchaseReport\All::class,
        'sells_report.all' => \App\Http\Middleware\Roles\SellsReport\All::class,





        'income_expense_type.all' => \App\Http\Middleware\Roles\IncomeExpenseType\all::class,
        'income_expense_type.show' => \App\Http\Middleware\Roles\IncomeExpenseType\Show::class,
        'income_expense_type.create' => \App\Http\Middleware\Roles\IncomeExpenseType\Create::class,
        'income_expense_type.edit' => \App\Http\Middleware\Roles\IncomeExpenseType\Edit::class,
        'income_expense_type.delete' => \App\Http\Middleware\Roles\IncomeExpenseType\Delete::class,
        'income_expense_type.pdf' => \App\Http\Middleware\Roles\IncomeExpenseType\Pdf::class,
        'income_expense_type.restore' => \App\Http\Middleware\Roles\IncomeExpenseType\Restore::class,
        'income_expense_type.trash_show' => \App\Http\Middleware\Roles\IncomeExpenseType\TrashShow::class,
        'income_expense_type.permanently_delete' => \App\Http\Middleware\Roles\IncomeExpenseType\PermanentlyDelete::class,

        'income_expense_group.all' => \App\Http\Middleware\Roles\IncomeExpenseGroup\All::class,
        'income_expense_group.show' => \App\Http\Middleware\Roles\IncomeExpenseGroup\Show::class,
        'income_expense_group.create' => \App\Http\Middleware\Roles\IncomeExpenseGroup\Create::class,
        'income_expense_group.edit' => \App\Http\Middleware\Roles\IncomeExpenseGroup\Edit::class,
        'income_expense_group.delete' => \App\Http\Middleware\Roles\IncomeExpenseGroup\Delete::class,
        'income_expense_group.pdf' => \App\Http\Middleware\Roles\IncomeExpenseGroup\Pdf::class,
        'income_expense_group.restore' => \App\Http\Middleware\Roles\IncomeExpenseGroup\Restore::class,
        'income_expense_group.trash_show' => \App\Http\Middleware\Roles\IncomeExpenseGroup\TrashShow::class,
        'income_expense_group.permanently_delete' => \App\Http\Middleware\Roles\IncomeExpenseGroup\PermanentlyDelete::class,




        'income_expense_head.all' => \App\Http\Middleware\Roles\IncomeExpenseHead\All::class,
        'income_expense_head.show' => \App\Http\Middleware\Roles\IncomeExpenseHead\Show::class,
        'income_expense_head.create' => \App\Http\Middleware\Roles\IncomeExpenseHead\Create::class,
        'income_expense_head.edit' => \App\Http\Middleware\Roles\IncomeExpenseHead\Edit::class,
        'income_expense_head.delete' => \App\Http\Middleware\Roles\IncomeExpenseHead\Delete::class,
        'income_expense_head.pdf' => \App\Http\Middleware\Roles\IncomeExpenseHead\Pdf::class,
        'income_expense_head.restore' => \App\Http\Middleware\Roles\IncomeExpenseHead\Restore::class,
        'income_expense_head.trash_show' => \App\Http\Middleware\Roles\IncomeExpenseHead\TrashShow::class,
        'income_expense_head.permanently_delete' => \App\Http\Middleware\Roles\IncomeExpenseHead\PermanentlyDelete::class,

        'bank_cash.all' => \App\Http\Middleware\Roles\BankCash\All::class,
        'bank_cash.show' => \App\Http\Middleware\Roles\BankCash\Show::class,
        'bank_cash.create' => \App\Http\Middleware\Roles\BankCash\Create::class,
        'bank_cash.edit' => \App\Http\Middleware\Roles\BankCash\Edit::class,
        'bank_cash.delete' => \App\Http\Middleware\Roles\BankCash\Delete::class,
        'bank_cash.pdf' => \App\Http\Middleware\Roles\BankCash\Pdf::class,
        'bank_cash.restore' => \App\Http\Middleware\Roles\BankCash\Restore::class,
        'bank_cash.trash_show' => \App\Http\Middleware\Roles\BankCash\TrashShow::class,
        'bank_cash.permanently_delete' => \App\Http\Middleware\Roles\BankCash\PermanentlyDelete::class,

        'initial_income_expense_head_balance.all' => \App\Http\Middleware\Roles\InitialIncomeExpenseHeadBalance\All::class,
        'initial_income_expense_head_balance.show' => \App\Http\Middleware\Roles\InitialIncomeExpenseHeadBalance\Show::class,
        'initial_income_expense_head_balance.create' => \App\Http\Middleware\Roles\InitialIncomeExpenseHeadBalance\Create::class,
        'initial_income_expense_head_balance.edit' => \App\Http\Middleware\Roles\InitialIncomeExpenseHeadBalance\Edit::class,
        'initial_income_expense_head_balance.delete' => \App\Http\Middleware\Roles\InitialIncomeExpenseHeadBalance\Delete::class,
        'initial_income_expense_head_balance.pdf' => \App\Http\Middleware\Roles\InitialIncomeExpenseHeadBalance\Pdf::class,
        'initial_income_expense_head_balance.restore' => \App\Http\Middleware\Roles\InitialIncomeExpenseHeadBalance\Restore::class,
        'initial_income_expense_head_balance.trash_show' => \App\Http\Middleware\Roles\InitialIncomeExpenseHeadBalance\TrashShow::class,
        'initial_income_expense_head_balance.permanently_delete' => \App\Http\Middleware\Roles\InitialIncomeExpenseHeadBalance\PermanentlyDelete::class,

        'initial_bank_cash_balance.all' => \App\Http\Middleware\Roles\InitialBankCashBalance\All::class,
        'initial_bank_cash_balance.show' => \App\Http\Middleware\Roles\InitialBankCashBalance\Show::class,
        'initial_bank_cash_balance.create' => \App\Http\Middleware\Roles\InitialBankCashBalance\Create::class,
        'initial_bank_cash_balance.edit' => \App\Http\Middleware\Roles\InitialBankCashBalance\Edit::class,
        'initial_bank_cash_balance.delete' => \App\Http\Middleware\Roles\InitialBankCashBalance\Delete::class,
        'initial_bank_cash_balance.pdf' => \App\Http\Middleware\Roles\InitialBankCashBalance\Pdf::class,
        'initial_bank_cash_balance.restore' => \App\Http\Middleware\Roles\InitialBankCashBalance\Restore::class,
        'initial_bank_cash_balance.trash_show' => \App\Http\Middleware\Roles\InitialBankCashBalance\TrashShow::class,
        'initial_bank_cash_balance.permanently_delete' => \App\Http\Middleware\Roles\InitialBankCashBalance\PermanentlyDelete::class,

        'dr_voucher.all' => \App\Http\Middleware\Roles\DrVoucher\All::class,
        'dr_voucher.show' => \App\Http\Middleware\Roles\DrVoucher\Show::class,
        'dr_voucher.create' => \App\Http\Middleware\Roles\DrVoucher\Create::class,
        'dr_voucher.edit' => \App\Http\Middleware\Roles\DrVoucher\Edit::class,
        'dr_voucher.delete' => \App\Http\Middleware\Roles\DrVoucher\Delete::class,
        'dr_voucher.pdf' => \App\Http\Middleware\Roles\DrVoucher\Pdf::class,
        'dr_voucher.restore' => \App\Http\Middleware\Roles\DrVoucher\Restore::class,
        'dr_voucher.trash_show' => \App\Http\Middleware\Roles\DrVoucher\TrashShow::class,
        'dr_voucher.permanently_delete' => \App\Http\Middleware\Roles\DrVoucher\PermanentlyDelete::class,

        'cr_voucher.all' => \App\Http\Middleware\Roles\CrVoucher\All::class,
        'cr_voucher.show' => \App\Http\Middleware\Roles\CrVoucher\Show::class,
        'cr_voucher.create' => \App\Http\Middleware\Roles\CrVoucher\Create::class,
        'cr_voucher.edit' => \App\Http\Middleware\Roles\CrVoucher\Edit::class,
        'cr_voucher.delete' => \App\Http\Middleware\Roles\CrVoucher\Delete::class,
        'cr_voucher.pdf' => \App\Http\Middleware\Roles\CrVoucher\Pdf::class,
        'cr_voucher.restore' => \App\Http\Middleware\Roles\CrVoucher\Restore::class,
        'cr_voucher.trash_show' => \App\Http\Middleware\Roles\CrVoucher\TrashShow::class,
        'cr_voucher.permanently_delete' => \App\Http\Middleware\Roles\CrVoucher\PermanentlyDelete::class,

        'jnl_voucher.all' => \App\Http\Middleware\Roles\JnlVoucher\All::class,
        'jnl_voucher.show' => \App\Http\Middleware\Roles\JnlVoucher\Show::class,
        'jnl_voucher.create' => \App\Http\Middleware\Roles\JnlVoucher\Create::class,
        'jnl_voucher.edit' => \App\Http\Middleware\Roles\JnlVoucher\Edit::class,
        'jnl_voucher.delete' => \App\Http\Middleware\Roles\JnlVoucher\Delete::class,
        'jnl_voucher.pdf' => \App\Http\Middleware\Roles\JnlVoucher\Pdf::class,
        'jnl_voucher.restore' => \App\Http\Middleware\Roles\JnlVoucher\Restore::class,
        'jnl_voucher.trash_show' => \App\Http\Middleware\Roles\JnlVoucher\TrashShow::class,
        'jnl_voucher.permanently_delete' => \App\Http\Middleware\Roles\JnlVoucher\PermanentlyDelete::class,

        'contra_voucher.all' => \App\Http\Middleware\Roles\ContraVoucher\All::class,
        'contra_voucher.show' => \App\Http\Middleware\Roles\ContraVoucher\Show::class,
        'contra_voucher.create' => \App\Http\Middleware\Roles\ContraVoucher\Create::class,
        'contra_voucher.edit' => \App\Http\Middleware\Roles\ContraVoucher\Edit::class,
        'contra_voucher.delete' => \App\Http\Middleware\Roles\ContraVoucher\Delete::class,
        'contra_voucher.pdf' => \App\Http\Middleware\Roles\ContraVoucher\Pdf::class,
        'contra_voucher.restore' => \App\Http\Middleware\Roles\ContraVoucher\Restore::class,
        'contra_voucher.trash_show' => \App\Http\Middleware\Roles\ContraVoucher\TrashShow::class,
        'contra_voucher.permanently_delete' => \App\Http\Middleware\Roles\ContraVoucher\PermanentlyDelete::class,

        'report.ledger.all' => \App\Http\Middleware\Roles\Report\Ledger\All::class,

        'report.TrialBalance.all' => \App\Http\Middleware\Roles\Report\TrialBalance\All::class,

        'report.CostOfRevenue.all' => \App\Http\Middleware\Roles\Report\CostOfRevenue\All::class,

        'report.ProfitOrLossAccount.all' => \App\Http\Middleware\Roles\Report\ProfitOrLossAccount\All::class,

        'report.RetainedEarning.all' => \App\Http\Middleware\Roles\Report\RetainedEarning\All::class,

        'report.FixedAssetsSchedule.all' => \App\Http\Middleware\Roles\Report\FixedAssetsSchedule\All::class,

        'report.StatementOfFinancialPosition.all' => \App\Http\Middleware\Roles\Report\StatementOfFinancialPosition\All::class,

        'report.CashFlow.all' => \App\Http\Middleware\Roles\Report\CashFlow\All::class,

        'report.ReceiveAndPayment.all' => \App\Http\Middleware\Roles\Report\ReceiveAndPayment\All::class,

        'report.Notes.all' => \App\Http\Middleware\Roles\Report\Notes\All::class,




        'report.general_report.branch.all' => \App\Http\Middleware\Roles\Report\GeneralReport\Branch\All::class,

        'report.general_report.ledger.all' => \App\Http\Middleware\Roles\Report\GeneralReport\Ledger\All::class,

        'report.general_report.BankCash.all' => \App\Http\Middleware\Roles\Report\GeneralReport\BankCash\All::class,

        'report.general_report.Voucher.all' => \App\Http\Middleware\Roles\Report\GeneralReport\Voucher\All::class,





    ];
}
