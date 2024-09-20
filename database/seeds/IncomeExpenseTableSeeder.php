<?php

use Illuminate\Database\Seeder;

class IncomeExpenseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\IncomeExpenseType::create([
            'name' => 'Inventories',
            'code' => '101',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Direct Material',
            'code' => '102',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Advance, Deposit & Receivables',
            'code' => '103',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Direct Labour',
            'code' => '104',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Revenue',
            'code' => '105',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Indirect Income',
            'code' => '106',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Account Payable',
            'code' => '107',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Paid Up Capital',
            'code' => '108',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Long Term Loan',
            'code' => '109',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Short Term Loan',
            'code' => '110',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Other Payable',
            'code' => '111',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Advance Against Sales',
            'code' => '112',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Share Money Deposit',
            'code' => '113',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Other Direct Expenses',
            'code' => '114',
            'created_by' => 'E-Accounts system',
        ]);

        App\IncomeExpenseType::create([
            'name' => 'Other Expense',
            'code' => '115',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Administrative Expense',
            'code' => '116',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Financial Expense',
            'code' => '117',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Provision & Tax Paid',
            'code' => '118',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Property, Plant & Equipment',
            'code' => '119',
            'created_by' => 'E-Accounts system',
        ]);


        App\IncomeExpenseType::create([
            'name' => 'Advance Receive from Investor',
            'code' => '120',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Preliminary Expense',
            'code' => '121',
            'created_by' => 'E-Accounts system',
        ]);
        App\IncomeExpenseType::create([
            'name' => 'Dividend',
            'code' => '122',
            'created_by' => 'E-Accounts system',
        ]);



    }
}
