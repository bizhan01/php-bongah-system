<?php

namespace App\Http\Controllers\Reports\Accounts;

use App\Exports\Balancesheet\BalanceShet;
use App\Http\Controllers\AccountsReportController;
use App\Http\Controllers\TransactionController;
use App\IncomeExpenseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Branch;
use App\IncomeExpenseHead;
use App\BankCash;
use App\Transaction;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\RoleManageController;
use App\Setting;
use Maatwebsite\Excel\Facades\Excel;


class BalanceSheetController extends Controller
{
    public function index()
    {
        return view('admin.accounts-report.balance-sheet.index');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function branch_wise(Request $request)
    {

        $request->validate([
            'end_from' => 'required',
            'end_to' => 'required',

            'start_from' => 'required',
            'start_to' => 'required',

        ]);

        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Statement Of Financial Position Branch Wise Report',
            'voucher_type' => 'STATEMENT OF FINANCIAL POSITION'
        );


        $BalanceSheet = $this->getBalanceSheet(
            $request->branch_id,
            $request->start_from,
            $request->start_to,
            $request->end_from,
            $request->end_to);

        // Common items

        if ($request->branch_id == 0) {
            $branch_name = 'All Branch';
        } else {
            $branch_name = Branch::find($request->branch_id)->name;
        }


        $start_from = date(config('settings.date_format'), strtotime($request->start_from));
        $start_to = date(config('settings.date_format'), strtotime($request->start_to));

        $end_from = date(config('settings.date_format'), strtotime($request->end_from));
        $end_to = date(config('settings.date_format'), strtotime($request->end_to));


        $search_by = array(
            'branch_name' => $branch_name,
            'branch_id' => $request->branch_id,
            'start_from' => $start_from,
            'start_to' => $start_to,

            'end_from' => $end_from,
            'end_to' => $end_to,
        );


        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.balance-sheet.branch-wise.index')
                ->with('particulars', $BalanceSheet)
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }

        // Pdf Action
        if ($request->action == 'Pdf') {

            $pdf = PDF::loadView('admin.accounts-report.profit-or-loss-account.branch-wise.pdf', [
                'particulars' => $BalanceSheet,
                'extra' => $extra,
                'search_by' => $search_by,
            ])
                ->setPaper('a4', 'landscape');

            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');

        }

        // Excel Action
        if ($request->action == 'Excel') {

            $BranchWise = new BalanceShet([
                'particulars' => $BalanceSheet,
                'extra' => $extra,
                'search_by' => $search_by,
            ]);
            return Excel::download($BranchWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');

        }

    }


    public function getBalanceSheet($branch_id, $start_from, $start_to, $end_from, $end_to)
    {


        //          CAPITAL & LIABILITIES
        //
        //
        // AUTHORIZED CAPITAL Default ( let 100000000 )
        //
        // PAID UP CAPITAL Code (  108  )
        //
        // RETAIN EARNING ( From Retained Earnings Module )
        //
        // SHARE MONEY DEPOSIT Code ( 113 )
        //
        // NON-CURRENT LIABILITIES = ( Long Term Loan )
        //
        // Long Term Loan Code ( 109 )
        //
        //
        // CURRENT LIABILITIES = ( Account Payable + Short Term Loan + Advance Against Sales + Other Payable + Advance Receive from Investor )
        //
        // Account Payable Code ( 107 )
        //
        // Short Term Loan Code ( 110 )
        //
        // Advance Against Sales Code ( 112 )
        //
        // Other Payable Code ( 111 )
        //
        // Advance Receive from Investor Code ( 120 )
        //
        // Total ( AUTHORIZED CAPITAL + PAID UP CAPITAL + RETAIN EARNING + SHARE MONEY DEPOSIT + NON-CURRENT LIABILITIES + CURRENT LIABILITIES: )
        //
        //
        //
        //      ASSETS
        //
        // NON-CURRENT ASSETS: ( Property, Plant & Equipment )
        //
        // Property, Plant & Equipment From ( Fixed asset Schedule function )
        //
        // CURRENT ASSETS: ( Advance, Deposit & Receivables + Inventories + Cash & Bank Balance)
        //
        // Advance, Deposit & Receivables Code ( 103 )
        //
        // Inventories Code ( 101 )
        //
        // Cash & Bank Balance ( From Bank Cash Function )
        //
        // Preliminary Expense Code ( 121 )
        //
        // Total ( NON-CURRENT ASSETS + CURRENT ASSETS + Preliminary Expense )
        //


        // Unique Branches or single
        $TransactionsController = new TransactionController();
        $transaction_unique_branches = $TransactionsController->getUniqueBranches($branch_id);


        $CostOfRevenueHeadTypes = IncomeExpenseType::whereIn('code', array(108, 113, 109, 107, 110, 112, 111, 120, 103, 101, 121))
            ->orderBy('code', 'asc')
            ->get();


        $Transactions = new Transaction();

        foreach ($CostOfRevenueHeadTypes as $costOfRevenueHeadType) {
            $Types[$costOfRevenueHeadType->code] = $costOfRevenueHeadType;
            $Balances[$costOfRevenueHeadType->code] = $Transactions->getBalanceByIncExpHeadTypeIdBranchesTwoDate(
                $costOfRevenueHeadType->id,
                $transaction_unique_branches,
                $start_from,
                $start_to,
                $end_from,
                $end_to
            );
        }

        $RetainedEarningsController = new  RetainedEarningsController();

        $RetainedEarnings = $RetainedEarningsController->getRetainedEarnings($branch_id, $start_from, $start_to, $end_from, $end_to);

        $fixedAssetsController = new FixedAssetScheduleController();
        $fixedAssetsSchedule = $fixedAssetsController->getFixedAssetSchedule($branch_id, $start_from, $end_from);

        $AccountReportsController = new AccountsReportController();

        $BankCashesBalance = $AccountReportsController->getBankCashBalance(
            $transaction_unique_branches,
            $start_from,
            $start_to,
            $end_from,
            $end_to);


        $CapitalAndLiabilitiesBalance = array(
            'start_balance' => 0,
            'end_balance' => 0,
        );

        $AuthorizedCapitalBalance = array(
            'start_balance' => 0,
            'end_balance' => 0,
        );


        $IssuedSubscribedAndPaidUpCapitalBalance = array(
            'start_balance' => $Balances[108]['balance']['start_balance'],
            'end_balance' => $Balances[108]['balance']['end_balance'],
        );

        $ShareMoneyDepositBalance = array(
            'start_balance' => $Balances[113]['balance']['start_balance'],
            'end_balance' => $Balances[113]['balance']['end_balance'],
        );

        $NonCurrentLiabilitiesBalance = array(
            'start_balance' => $Balances[109]['balance']['start_balance'],
            'end_balance' => $Balances[109]['balance']['end_balance'],
        );
        $LongTermLoanBalance = array(
            'start_balance' => $Balances[109]['balance']['start_balance'],
            'end_balance' => $Balances[109]['balance']['end_balance'],
        );


        $CurrentLiabilitiesBalance = array(
            'start_balance' => $Balances[107]['balance']['start_balance'] + $Balances[110]['balance']['start_balance'] + $Balances[112]['balance']['start_balance'] + $Balances[111]['balance']['start_balance'] + $Balances[120]['balance']['start_balance'],
            'end_balance' => $Balances[107]['balance']['end_balance'] + $Balances[110]['balance']['end_balance'] + $Balances[112]['balance']['end_balance'] + $Balances[111]['balance']['end_balance'] + $Balances[120]['balance']['end_balance'],
        );

        $AccountPayableBalance = array(
            'start_balance' => $Balances[107]['balance']['start_balance'],
            'end_balance' => $Balances[107]['balance']['end_balance'],
        );
        $ShortTermLoanBalance = array(
            'start_balance' => $Balances[110]['balance']['start_balance'],
            'end_balance' => $Balances[110]['balance']['end_balance'],
        );
        $AdvanceAgainstSalesBalance = array(
            'start_balance' => $Balances[112]['balance']['start_balance'],
            'end_balance' => $Balances[112]['balance']['end_balance'],
        );
        $OtherPayableBalance = array(
            'start_balance' => $Balances[111]['balance']['start_balance'],
            'end_balance' => $Balances[111]['balance']['end_balance'],
        );
        $AdvanceReceiveFromInvestorBalance = array(
            'start_balance' => $Balances[120]['balance']['start_balance'],
            'end_balance' => $Balances[120]['balance']['end_balance'],
        );
        $TotalCapitalAndLiabilitiesBalance = array(
            'start_balance' => $AuthorizedCapitalBalance['start_balance'] + $IssuedSubscribedAndPaidUpCapitalBalance['start_balance'] + $RetainedEarnings['NetProfitOrLoss']['start_balance'] + $ShareMoneyDepositBalance['start_balance'] + $NonCurrentLiabilitiesBalance['start_balance'] + $CurrentLiabilitiesBalance['start_balance'],
            'end_balance' => $AuthorizedCapitalBalance['end_balance'] + $IssuedSubscribedAndPaidUpCapitalBalance['end_balance'] + $RetainedEarnings['NetProfitOrLoss']['end_balance'] + $ShareMoneyDepositBalance['end_balance'] + $NonCurrentLiabilitiesBalance['end_balance'] + $CurrentLiabilitiesBalance['end_balance'],
        );


        $AssetsBalance = array(
            'start_balance' => 0,
            'end_balance' => 0,
        );

        $NonCurrentAssetsBalance = $fixedAssetsSchedule['TotalBalance'];

        $Current_Assets = array(
            'start_balance' => $Balances[103]['balance']['start_balance'] + $Balances[101]['balance']['start_balance'] + $BankCashesBalance['balance']['start_balance'],
            'end_balance' => $Balances[103]['balance']['end_balance'] + $Balances[101]['balance']['end_balance'] + $BankCashesBalance['balance']['end_balance'],
        );

        $AdvanceDepositReceivables = array(
            'start_balance' => $Balances[103]['balance']['start_balance'],
            'end_balance' => $Balances[103]['balance']['end_balance'],
        );

        $InventoriesBalance = array(
            'start_balance' => $Balances[101]['balance']['start_balance'],
            'end_balance' => $Balances[101]['balance']['end_balance'],
        );


        $CashAndBankBalance = array(
            'start_balance' => $BankCashesBalance['balance']['start_balance'],
            'end_balance' => $BankCashesBalance['balance']['end_balance'],
        );


        $PreliminaryExpenseBalance = array(
            'start_balance' => $Balances[121]['balance']['start_balance'],
            'end_balance' => $Balances[121]['balance']['end_balance'],
        );


        $TotalAssetsBalance = array(
            'start_balance' => $NonCurrentAssetsBalance['start_balance'] + $Current_Assets['start_balance'] + $PreliminaryExpenseBalance['start_balance'],
            'end_balance' => $NonCurrentAssetsBalance['end_balance'] + $Current_Assets['end_balance'] + $PreliminaryExpenseBalance['end_balance'],
        );


        $particulars = array(
            'CapitalAndLiabilities' => array(
                'name' => 'CAPITAL AND LIABILITIES',
                'code' => 'particulars',
                'balance' => $CapitalAndLiabilitiesBalance,
            ),
            'AuthorizedCapital' => array(
                'name' => 'AUTHORIZED CAPITAL',
                'code' => 'AuthorizedCapital',
                'balance' => $AuthorizedCapitalBalance,
            ),
            'IssuedSubscribedAndPaidUpCapital' => array(
                'name' => $Types[108]->name,
                'code' => 108,
                'balance' => $IssuedSubscribedAndPaidUpCapitalBalance,
            ),
            'RetainEarning' => array(
                'name' => 'RETAIN EARNING',
                'code' => 'RetainEarning',
                'balance' => $RetainedEarnings['NetProfitOrLoss'],
            ),
            'ShareMoneyDeposit' => array(
                'name' => $Types[113]->name,
                'code' => '113',
                'balance' => $ShareMoneyDepositBalance,
            ),
            'NonCurrentLiabilities' => array(
                'name' => 'NON-CURRENT LIABILITIES:',
                'code' => 'NonCurrentLiabilities',
                'balance' => $NonCurrentLiabilitiesBalance,
            ),
            'LongTermLoan' => array(
                'name' => $Types[109]->name,
                'code' => 109,
                'balance' => $LongTermLoanBalance,
            ),


            'CurrentLiabilities' => array(
                'name' => 'CURRENT LIABILITIES:',
                'code' => 'CurrentLiabilities',
                'balance' => $CurrentLiabilitiesBalance,
            ),
            'AccountPayable' => array(
                'name' => $Types[107]->name,
                'code' => 107,
                'balance' => $AccountPayableBalance,
            ),
            'ShortTermLoan' => array(
                'name' => $Types[110]->name,
                'code' => 110,
                'balance' => $ShortTermLoanBalance,
            ),
            'AdvanceAgainstSales' => array(
                'name' => $Types[112]->name,
                'code' => 112,
                'balance' => $AdvanceAgainstSalesBalance,
            ),
            'OtherPayable' => array(
                'name' => $Types[111]->name,
                'code' => 111,
                'balance' => $OtherPayableBalance,
            ),
            'AdvanceReceiveFromInvestor' => array(
                'name' => $Types[120]->name,
                'code' => 120,
                'balance' => $AdvanceReceiveFromInvestorBalance,
            ),
            'TotalCapitalAndLiabilities' => array(
                'name' => 'Total =',
                'code' => 'TotalCapitalAndLiabilities',
                'balance' => $TotalCapitalAndLiabilitiesBalance,
            ),


            'Assets' => array(
                'name' => 'ASSETS',
                'code' => 'Assets',
                'balance' => $AssetsBalance,
            ),

            'NonCurrentAssets' => array(
                'name' => 'NON-CURRENT ASSETS:',
                'code' => 'NonCurrentAssets:',
                'balance' => $NonCurrentAssetsBalance,
            ),
            'fixedAssetsSchedule' => array(
                'name' => 'Property, Plant And Equipment',
                'code' => 'fixedAssetsSchedule',
                'balance' => $fixedAssetsSchedule['TotalBalance'],
            ),
            'CurrentAssets' => array(
                'name' => 'CURRENT ASSETS:',
                'code' => 'CurrentAssets',
                'balance' => $Current_Assets,
            ),

            'AdvanceDepositReceivables' => array(
                'name' => $Types[103]->name,
                'code' => 103,
                'balance' => $AdvanceDepositReceivables,
            ),
            'Inventories' => array(
                'name' => $Types[103]->name,
                'code' => 103,
                'balance' => $InventoriesBalance,
            ),
            'CashAndBankBalance' => array(
                'name' => 'Cash And Bank Balance',
                'code' => 'CashAndBankBalance',
                'balance' => $CashAndBankBalance,
            ),

            'PreliminaryExpense' => array(
                'name' => $Types[121]->name,
                'code' => 121,
                'balance' => $PreliminaryExpenseBalance,
            ),

            'TotalAssets' => array(
                'name' => 'Total =',
                'code' => 'TotalAssets',
                'balance' => $TotalAssetsBalance,
            ),

        );

        return $particulars;

    }

}
