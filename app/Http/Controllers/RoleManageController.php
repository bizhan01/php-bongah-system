<?php

namespace App\Http\Controllers;

use App\RoleManage;
use App\User;

use Auth;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class RoleManageController extends Controller
{


//    Important properties
    public $parentModel = RoleManage::class;
    public $parentRoute = 'role-manage';
    public $parentView = "admin.role-manage";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {

        $items = $this->parentModel::orderBy('created_at', 'desc')->paginate(60);
        return view($this->parentView . '.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->parentView . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $content
     * @param string $module_name
     * @return boolean $bool
     */

    public function arrangeRoleItem($content , $module_name)
    {
        if (array_key_exists(1, $content = []))  { //Module Show
            $module_show = 1;
        } else {
            $module_show = 0;
        }
        if (array_key_exists(2, $content))  { // Show
            $show = 1;
        } else {
            $show = 0;
        }

        if (array_key_exists(3, $content)) { // Create
            $create = 1;
        } else {
            $create = 0;
        }
        if (array_key_exists(4, $content)) { // Edit
            $edit = 1;
        } else {
            $edit = 0;

        }
        if (array_key_exists(5, $content)) { // Delete
            $delete = 1;
        } else {
            $delete = 0;
        }

        if (array_key_exists(6, $content)) { // PDF
            $pdf = 1;
        } else {
            $pdf = 0;
        }

        if (array_key_exists(7, $content)) { // Trash show
            $trash_show = 1;
        } else {
            $trash_show = 0;
        }
        if (array_key_exists(8, $content)) { /// Restore
            $restore = 1;
        } else {
            $restore = 0;
        }
        if (array_key_exists(9, $content)) { // Permanently Delete
            $permanently_delete = 1;
        } else {
            $permanently_delete = 0;
        }

        $content1 = array(
            $module_name,
            $module_show,
            $show,
            $create,
            $edit,
            $delete,
            $pdf,
            $trash_show,
            $restore,
            $permanently_delete,
        );
        return $content1;
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required | unique:role_manages,name',
        ]);



        $content = array(
            'User' => $this->arrangeRoleItem($request->user, 'User '),
            'RoleManager' => $this->arrangeRoleItem($request->role_manage, 'Role Manager'),
            'Settings' => $this->arrangeRoleItem($request->settings, 'Settings'),


            'Project' => $this->arrangeRoleItem($request->Project, 'Project'),
            'Product' => $this->arrangeRoleItem($request->Product, 'Product'),
            'Sell' => $this->arrangeRoleItem($request->Sell, 'Sell'),
            'PurchaseRequisition' => $this->arrangeRoleItem($request->PurchaseRequisition, 'Purchase Requisition'),
            'PurchaseRQNConfirm' => $this->arrangeRoleItem($request->PurchaseRQNConfirm, 'Purchase RQN Confirm'),
            'PurchaseOrder' => $this->arrangeRoleItem($request->PurchaseOrder, 'Purchase Order'),
            'Vendor' => $this->arrangeRoleItem($request->Vendor, 'Vendor'),
            'Employee' => $this->arrangeRoleItem($request->Employee, 'Employee'),
            'Customer' => $this->arrangeRoleItem($request->Customer, 'Customer'),
            'PurchaseReport' => $this->arrangeRoleItem($request->PurchaseReport, 'PurchaseReport'),
            'SellsReport' => $this->arrangeRoleItem($request->SellsReport, 'Sells Report'),


            'LedgerType' => $this->arrangeRoleItem($request->LedgerType, 'Ledger Type'),
            'LedgerGroup' => $this->arrangeRoleItem($request->LedgerGroup, 'Ledger Group'),
            'LedgerName' => $this->arrangeRoleItem($request->LedgerName, 'Ledger Name'),
            'BankCash' => $this->arrangeRoleItem($request->BankCash, 'Bank Cash'),
            'InitialIncomeExpenseHeadBalance' => $this->arrangeRoleItem($request->InitialIncomeExpenseHeadBalance, 'Initial Income Expense Head Balance'),
            'InitialBankCashBalance' => $this->arrangeRoleItem($request->InitialBankCashBalance, 'Initial Bank Cash Balance'),
            'DrVoucher' => $this->arrangeRoleItem($request->dr_voucher, 'Dr Voucher'),
            'CrVoucher' => $this->arrangeRoleItem($request->cr_voucher, 'Cr Voucher'),
            'JnlVoucher' => $this->arrangeRoleItem($request->jnl_voucher, 'Jnl Voucher'),
            'ContraVoucher' => $this->arrangeRoleItem($request->cnt_voucher, 'Contra Voucher'),

            'Ledger' => $this->arrangeRoleItem($request->ledger, 'Ledger'),
            'TrialBalance' => $this->arrangeRoleItem($request->trial_balance, 'Trial Balance'),
            'CostOfRevenue' => $this->arrangeRoleItem($request->cost_Of_revenue, 'Cost Of Revenue'),
            'ProfitOrLossAccount' => $this->arrangeRoleItem($request->profit_or_loss_account, 'Profit Or Loss Account'),
            'RetainedEarning' => $this->arrangeRoleItem($request->retained_earning, 'Retained Earning'),
            'FixedAssetsSchedule' => $this->arrangeRoleItem($request->fixed_assets_schedule, 'Fixed Assets Schedule'),
            'StatementOfFinancialPosition' => $this->arrangeRoleItem($request->statement_of_financial_position, 'Statement Of Financial Position'),
            'CashFlow' => $this->arrangeRoleItem($request->cash_flow, 'Cash Flow'),
            'ReceiveAndPayment' => $this->arrangeRoleItem($request->receive_and_payment, 'Receive And Payment'),
            'Notes' => $this->arrangeRoleItem($request->notes, 'Notes'),

            'GeneralBranch' => $this->arrangeRoleItem($request->GeneralBranch, 'General Branch Report'),
            'GeneralLedger' => $this->arrangeRoleItem($request->GeneralLedger, 'General Ledger Report'),
            'GeneralBankCash' => $this->arrangeRoleItem($request->GeneralBankCash, 'General Bank Cash Report'),
            'GeneralVoucher' => $this->arrangeRoleItem($request->GeneralVoucher, 'General Voucher Report'),

        );


        $content = json_encode($content);

        $this->parentModel::create([
            'name' => $request->name,
            'content' => $content,
            'create_by' => Auth::user()->email,
        ]);
        Session::flash('success', 'Successfully Created');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Request $request)
    {

        $item = $this->parentModel::find($request->id);
        if (empty($item)) {
            Session::flash('error', "Item not found");
            return redirect()->route('role-manage');
        }
        $content = (array)json_decode($item['content']);
        $item['content'] = $content;


        return view($this->parentView . '.show')->with('items', $item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {

        $item = $this->parentModel::find($id);
        if (empty($item)) {
            Session::flash('error', "Item not found");
            return redirect()->route('role-manage');
        }
        $content = json_decode($item['content']);
        $item['content'] = $content;
        return view($this->parentView . '.edit')->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required | unique:role_manages,name,' . $id,
        ]);
        $item = $this->parentModel::find($id);


        $items = array(
            'User' => $this->arrangeRoleItem($request->details['User'], 'User '),
            'RoleManager' => $this->arrangeRoleItem($request->details['RoleManager'], 'Role Manager'),
            'Settings' => $this->arrangeRoleItem($request->details['Settings'], 'Settings'),

//            Inventory
            'Project' => $this->arrangeRoleItem($request->details['Project'], 'Project'),
            'Product' => $this->arrangeRoleItem($request->details['Product'], 'Product'),
            'Sell' => $this->arrangeRoleItem($request->details['Sell'], 'Sell'),
            'PurchaseRequisition' => $this->arrangeRoleItem($request->details['PurchaseRequisition'], 'Purchase Requisition'),
            'PurchaseRQNConfirm' => $this->arrangeRoleItem($request->details['PurchaseRQNConfirm'], 'Purchase RQN Confirm'),
            'PurchaseOrder' => $this->arrangeRoleItem($request->details['PurchaseOrder'], 'Purchase Order'),
            'Vendor' => $this->arrangeRoleItem($request->details['Vendor'], 'Vendor'),
            'Employee' => $this->arrangeRoleItem($request->details['Employee'], 'Employee'),
            'Customer' => $this->arrangeRoleItem($request->details['Customer'], 'Customer'),


            'LedgerType' => $this->arrangeRoleItem($request->details['LedgerType'], 'Ledger Type'),
            'LedgerGroup' => $this->arrangeRoleItem($request->details['LedgerGroup'], 'Ledger Group'),
            'LedgerName' => $this->arrangeRoleItem($request->details['LedgerName'], 'Ledger Name'),
            'BankCash' => $this->arrangeRoleItem($request->details['BankCash'], 'Bank Cash'),
            'InitialIncomeExpenseHeadBalance' => $this->arrangeRoleItem($request->details['InitialIncomeExpenseHeadBalance'], 'Initial Income Expense Head Balance'),
            'InitialBankCashBalance' => $this->arrangeRoleItem($request->details['InitialBankCashBalance'], 'Initial Bank Cash Balance'),
            'DrVoucher' => $this->arrangeRoleItem($request->details['DrVoucher'], 'Dr Voucher'),
            'CrVoucher' => $this->arrangeRoleItem($request->details['CrVoucher'], 'Cr Voucher'),
            'JnlVoucher' => $this->arrangeRoleItem($request->details['JnlVoucher'], 'Jnl Voucher'),
            'ContraVoucher' => $this->arrangeRoleItem($request->details['ContraVoucher'], 'Contra Voucher'),


            'Ledger' => $this->arrangeRoleItem($request->details['Ledger'], 'Ledger'),
            'TrialBalance' => $this->arrangeRoleItem($request->details['TrialBalance'], 'Trial Balance'),
            'CostOfRevenue' => $this->arrangeRoleItem($request->details['CostOfRevenue'], 'Cost Of Revenue'),
            'ProfitOrLossAccount' => $this->arrangeRoleItem($request->details['ProfitOrLossAccount'], 'Profit Or Loss Account'),
            'RetainedEarning' => $this->arrangeRoleItem($request->details['RetainedEarning'], 'Retained Earning'),
            'FixedAssetsSchedule' => $this->arrangeRoleItem($request->details['FixedAssetsSchedule'], 'Fixed Assets Schedule'),
            'StatementOfFinancialPosition' => $this->arrangeRoleItem($request->details['StatementOfFinancialPosition'], 'Statement Of Financial Position'),
            'CashFlow' => $this->arrangeRoleItem($request->details['CashFlow'], 'Cash Flow'),
            'ReceiveAndPayment' => $this->arrangeRoleItem($request->details['ReceiveAndPayment'], 'Receive And Payment'),
            'Notes' => $this->arrangeRoleItem($request->details['Notes'], 'Notes'),


            'PurchaseReport' => $this->arrangeRoleItem($request->details['PurchaseReport'], 'PurchaseReport'),
            'SellsReport' => $this->arrangeRoleItem($request->details['SellsReport'], 'Sells Report'),



            'GeneralBranch' => $this->arrangeRoleItem($request->details['GeneralBranch'], 'General Branch Report'),
            'GeneralLedger' => $this->arrangeRoleItem($request->details['GeneralLedger'], 'General Ledger Report'),
            'GeneralBankCash' => $this->arrangeRoleItem($request->details['GeneralBankCash'], 'General Bank Cash Report'),
            'GeneralVoucher' => $this->arrangeRoleItem($request->details['GeneralVoucher'], 'General Voucher Report'),


        );

        $item->name = $request->name;
        $item->content = json_encode($items);
        $item->update_by = Auth::user()->email;


        $item->save();
        Session::flash('success', 'Successfully Updated');
        return redirect()->route($this->parentRoute);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = $this->parentModel::find($id);

        $users = User::withTrashed()->where('role_manage_id', $id)->get();

        if (count($users) > 0) {  // Check One to many relation in ( User has or not )
            Session::flash('error', "You Can not delete this item, because it already assigned Some User");
            return redirect()->back();
        }


        $item->delete_by = Auth::user()->email; /// deleted by user name
        $item->save(); /// update user info who delete this item

        $item->delete();
        Session::flash('success', "Successfully Destroy");
        return redirect()->back();
    }

    public function pdf(Request $request)
    {

        $item = $this->parentModel::find($request->id);
        if (empty($item)) {
            Session::flash('error', "Item not found");
            return redirect()->route('role-manage');
        }
        $content = (array)json_decode($item['content']);
        $item['content'] = $content;


        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Role Manage'
        );

        $pdf = PDF::loadView($this->parentView . '.pdf', ['items' => $item, 'extra' => $extra])->setPaper('a4', 'landscape');
        //return $pdf->stream('invoice.pdf');
        return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
    }


    public function trashed()
    {
        $items = $this->parentModel::onlyTrashed()->paginate(60);
        return view($this->parentView . '.trashed')->with("items", $items);
    }

    public function restore($id)
    {
        $project = $this->parentModel::onlyTrashed()->where('id', $id)->first();

        $project->restore();
        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }

    public function kill($id)
    {
        $project = $this->parentModel::withTrashed()->where('id', $id)->first();
        $users = User::withTrashed()->where('role_manage_id', $id)->get();

        if (count($users) > 0) {  // Check One to many relation in ( User has or not )
            Session::flash('error', "You Can not delete this item, because it already assigned Some User");
            return redirect()->back();
        }


        $project->forceDelete();
        Session::flash('success', 'Permanently Delete');
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    {
        $request->validate([
            'search' => 'min:1'
        ]);

        $search = $request["search"];
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->paginate(60);

        $roles = $this->getRolePermissionCurrentUser();

        return view($this->parentView . '.index')
            ->with('items', $items)->with('roles', $roles);

    }

    public function trashedSearch(Request $request)
    {
        $request->validate([
            'search' => 'min:1'
        ]);

        $search = $request["search"];
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->paginate(60);

        return view($this->parentView . '.trashed')
            ->with('items', $items);

    }


//    Fixed Method for all
    public function activeAction(Request $request)
    {
        $request->validate([
            'items' => 'required'
        ]);

        if ($request->apply_comand_top == 3 || $request->apply_comand_bottom == 3) {
            foreach ($request->items["id"] as $id) {
                $this->destroy($id);
            }
            return redirect()->back();

        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {

            foreach ($request->items["id"] as $id) {
                $this->kill($id);
            }
            return redirect()->back();

        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }

    }

    public function trashedAction(Request $request)
    {

        $request->validate([
            'items' => 'required'
        ]);

        if ($request->apply_comand_top == 1 || $request->apply_comand_bottom == 1) {

            foreach ($request->items["id"] as $id) {
                $this->restore($id);
            }

        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {

            foreach ($request->items["id"] as $id) {
                $this->kill($id);
            }
            return redirect()->back();

        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }
        return redirect()->back();
    }


}
