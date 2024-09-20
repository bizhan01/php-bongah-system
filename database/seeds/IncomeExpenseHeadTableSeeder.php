<?php

use Illuminate\Database\Seeder;

class IncomeExpenseHeadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\IncomeExpenseHead::create([
            'name' => '	1st Class Brick (Hand Made)',
            'unit' => 'Pcs',
            'income_expense_type_id' => '2',
            'income_expense_group_id' => '1',
            'type' => '1', /// Dr=1, Cr=0  1;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => '3/4" Crushed Stone',
            'unit' => 'Pcs',
            'income_expense_type_id' => '2',
            'income_expense_group_id' => '2',
            'type' => '1', /// Dr=1, Cr=0 2;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'G I Fittings',
            'income_expense_type_id' => '2',
            'income_expense_group_id' => '3',
            'type' => '1', /// Dr=1, Cr=0 3;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Bathroom Fittings',
            'income_expense_type_id' => '2',
            'income_expense_group_id' => '3',
            'type' => '1', /// Dr=1, Cr=0  4;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Switch & Socket',
            'unit' => 'Pcs',
            'income_expense_type_id' => '2',
            'income_expense_group_id' => '4',
            'type' => '1', /// Dr=1, Cr=0  5;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Cable',
            'income_expense_type_id' => '2',
            'income_expense_group_id' => '5',
            'type' => '1', /// Dr=1, Cr=0  6;

            'created_by' => 'E-Accounts System',
        ]);

        App\IncomeExpenseHead::create([
            'name' => 'Advance E-Accounts System',
            'income_expense_type_id' => '3',
            'income_expense_group_id' => '6',
            'type' => '1', /// Dr=1, Cr=0  7;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Advance Salary(Al-Mahmud)',
            'income_expense_type_id' => '3',
            'income_expense_group_id' => '6',
            'type' => '1', /// Dr=1, Cr=0  8;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Advance (Al-Mahmud)',
            'income_expense_type_id' => '3',
            'income_expense_group_id' => '6',
            'type' => '1', /// Dr=1, Cr=0  9;

            'created_by' => 'E-Accounts System',
        ]);

        App\IncomeExpenseHead::create([
            'name' => 'Stone Chips Making)',
            'income_expense_type_id' => '4',
            'income_expense_group_id' => '2',
            'type' => '1', /// Dr=1, Cr=0  10;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Deep Tube-Well Work',
            'income_expense_type_id' => '4',
            'income_expense_group_id' => '7',
            'type' => '1', /// Dr=1, Cr=0  11;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Steel Structure Work',
            'income_expense_type_id' => '4',
            'income_expense_group_id' => '8',
            'type' => '1', /// Dr=1, Cr=0  12;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Labour Shade Making',
            'income_expense_type_id' => '4',
            'income_expense_group_id' => '10',
            'type' => '1', /// Dr=1, Cr=0  13;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Fencing Brick Work',
            'income_expense_type_id' => '4',
            'income_expense_group_id' => '9',
            'type' => '1', /// Dr=1, Cr=0  14;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Safety Shade',
            'income_expense_type_id' => '4',
            'income_expense_group_id' => '10',
            'type' => '1', /// Dr=1, Cr=0  15;

            'created_by' => 'E-Accounts System',
        ]);

        App\IncomeExpenseHead::create([
            'name' => 'Receive from Flat Sales ( Sherlock Anthony )',
            'income_expense_type_id' => '5',
            'income_expense_group_id' => '12',
            'type' => '0', /// Dr=1, Cr=0  16;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Receive from Flat Sales (Ruby Anthony)',
            'income_expense_type_id' => '5',
            'income_expense_group_id' => '12',
            'type' => '0', /// Dr=1, Cr=0 17;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Receive from Flat Sales ( Mario )',
            'income_expense_type_id' => '5',
            'income_expense_group_id' => '12',
            'type' => '0', /// Dr=1, Cr=0  18;

            'created_by' => 'E-Accounts System',
        ]);


        App\IncomeExpenseHead::create([
            'name' => 'Donation',
            'income_expense_type_id' => '6',
            'income_expense_group_id' => '13',
            'type' => '0', /// Dr=1, Cr=0  19;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Interest Income',
            'income_expense_type_id' => '6',
            'income_expense_group_id' => '14',
            'type' => '0', /// Dr=1, Cr=0  20;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Garbage Sales',
            'income_expense_type_id' => '6',
            'income_expense_group_id' => '12',
            'type' => '0', /// Dr=1, Cr=0  21;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Sales Commission (Income)',
            'income_expense_type_id' => '6',
            'income_expense_group_id' => '12',
            'type' => '0', /// Dr=1, Cr=0  22;

            'created_by' => 'E-Accounts System',
        ]);

        App\IncomeExpenseHead::create([
            'name' => 'Employee Incentive Fund',
            'income_expense_type_id' => '7',
            'income_expense_group_id' => '16',
            'type' => '0', /// Dr=1, Cr=0  23;

            'created_by' => 'E-Accounts System',
        ]);

        App\IncomeExpenseHead::create([
            'name' => 'Salary Payable',
            'income_expense_type_id' => '7',
            'income_expense_group_id' => '17',
            'type' => '0', /// Dr=1, Cr=0  24;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Security Deposit (Safety Money)',
            'income_expense_type_id' => '7',
            'income_expense_group_id' => '18',
            'type' => '0', /// Dr=1, Cr=0  25;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Temporary Loan from HKT Estate ltd.',
            'income_expense_type_id' => '7',
            'income_expense_group_id' => '19',
            'type' => '0', /// Dr=1, Cr=0  26;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'TDS Payable On S S Steel (Pvt.) Ltd.',
            'income_expense_type_id' => '7',
            'income_expense_group_id' => '20',
            'type' => '0', /// Dr=1, Cr=0  27;

            'created_by' => 'E-Accounts System',
        ]);


        App\IncomeExpenseHead::create([
            'name' => 'Gilbert',
            'income_expense_type_id' => '8',
            'income_expense_group_id' => '21',
            'type' => '0', /// Dr=1, Cr=0  28;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Joshua',
            'income_expense_type_id' => '8',
            'income_expense_group_id' => '22',
            'type' => '0', /// Dr=1, Cr=0  29;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Alberto',
            'income_expense_type_id' => '8',
            'income_expense_group_id' => '23',
            'type' => '0', /// Dr=1, Cr=0  30;

            'created_by' => 'E-Accounts System',
        ]);

        App\IncomeExpenseHead::create([
            'name' => 'ABC Co. Ltd.',
            'income_expense_type_id' => '9',
            'income_expense_group_id' => '23',
            'type' => '0', /// Dr=1, Cr=0  31;

            'created_by' => 'E-Accounts System',
        ]);


        App\IncomeExpenseHead::create([
            'name' => 'Loan From Ricardo',
            'income_expense_type_id' => '10',
            'income_expense_group_id' => '19',
            'type' => '0', /// Dr=1, Cr=0  32;

            'created_by' => 'E-Accounts System',
        ]);

        App\IncomeExpenseHead::create([
            'name' => 'Accumulated Depreciation',
            'income_expense_type_id' => '11',
            'income_expense_group_id' => '24',
            'type' => '0', /// Dr=1, Cr=0  33;

            'created_by' => 'E-Accounts System',
        ]);

        App\IncomeExpenseHead::create([
            'name' => 'Share Money Deposit ( Alberto )',
            'income_expense_type_id' => '13',
            'income_expense_group_id' => '25',
            'type' => '0', /// Dr=1, Cr=0  34;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Share Money Deposit ( Shane )',
            'income_expense_type_id' => '13',
            'income_expense_group_id' => '25',
            'type' => '0', /// Dr=1, Cr=0  35;

            'created_by' => 'E-Accounts System',
        ]);


        App\IncomeExpenseHead::create([
            'name' => 'Govt Approval (Land Use permission)',
            'income_expense_type_id' => '14',
            'income_expense_group_id' => '26',
            'type' => '1', /// Dr=1, Cr=0  36;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'License & Registration',
            'income_expense_type_id' => '14',
            'income_expense_group_id' => '27',
            'type' => '1', /// Dr=1, Cr=0  37;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Power Acceptance',
            'income_expense_type_id' => '14',
            'income_expense_group_id' => '43',
            'type' => '1', /// Dr=1, Cr=0  38;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Gas Line Connection',
            'income_expense_type_id' => '14',
            'income_expense_group_id' => '28',
            'type' => '1', /// Dr=1, Cr=0  39;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'WASA(Water) Connection',
            'income_expense_type_id' => '14',
            'income_expense_group_id' => '28',
            'type' => '1', /// Dr=1, Cr=0  40;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Electric Line Connection',
            'income_expense_type_id' => '14',
            'income_expense_group_id' => '28',
            'type' => '1', /// Dr=1, Cr=0  41;

            'created_by' => 'E-Accounts System',
        ]);


        App\IncomeExpenseHead::create([
            'name' => 'Cylinder Test',
            'income_expense_type_id' => '15',
            'income_expense_group_id' => '29',
            'type' => '1', /// Dr=1, Cr=0  42;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Roller Rent',
            'income_expense_type_id' => '15',
            'income_expense_group_id' => '30',
            'type' => '1', /// Dr=1, Cr=0  43;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Fuel Cost',
            'income_expense_type_id' => '15',
            'income_expense_group_id' => '31',
            'type' => '1', /// Dr=1, Cr=0  44;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Medicine',
            'income_expense_type_id' => '15',
            'income_expense_group_id' => '32',
            'type' => '1', /// Dr=1, Cr=0  45;

            'created_by' => 'E-Accounts System',
        ]);

        App\IncomeExpenseHead::create([
            'name' => 'Photography',
            'income_expense_type_id' => '16',
            'income_expense_group_id' => '33',
            'type' => '1', /// Dr=1, Cr=0  46;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Commission',
            'income_expense_type_id' => '16',
            'income_expense_group_id' => '15',
            'type' => '1', /// Dr=1, Cr=0  47;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Project Fair',
            'income_expense_type_id' => '16',
            'income_expense_group_id' => '34',
            'type' => '1', /// Dr=1, Cr=0  48;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Plan fees',
            'income_expense_type_id' => '16',
            'income_expense_group_id' => '35',
            'type' => '1', /// Dr=1, Cr=0  49;

            'created_by' => 'E-Accounts System',
        ]);

        App\IncomeExpenseHead::create([
            'name' => 'Bank Charge',
            'income_expense_type_id' => '17',
            'income_expense_group_id' => '36',
            'type' => '1', /// Dr=1, Cr=0  50;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Interest Expenses',
            'income_expense_type_id' => '17',
            'income_expense_group_id' => '37',
            'type' => '1', /// Dr=1, Cr=0  51;

            'created_by' => 'E-Accounts System',
        ]);


        App\IncomeExpenseHead::create([
            'name' => 'Air Condition',
            'income_expense_type_id' => '19',
            'income_expense_group_id' => '39',
            'type' => '1', /// Dr=1, Cr=0  52;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Office Equipment',
            'income_expense_type_id' => '19',
            'income_expense_group_id' => '40',
            'type' => '1', /// Dr=1, Cr=0  53;

            'created_by' => 'E-Accounts System',
        ]);
        App\IncomeExpenseHead::create([
            'name' => 'Photocopy Machine',
            'income_expense_type_id' => '19',
            'income_expense_group_id' => '40',
            'type' => '1', /// Dr=1, Cr=0  54;

            'created_by' => 'E-Accounts System',
        ]);

        App\IncomeExpenseHead::create([
            'name' => 'Receive from Miki Management',
            'income_expense_type_id' => '20',
            'income_expense_group_id' => '41',
            'type' => '0', /// Dr=1, Cr=0  55;

            'created_by' => 'E-Accounts System',
        ]);


        App\IncomeExpenseHead::create([
            'name' => 'Preliminary Expense',
            'income_expense_type_id' => '21',
            'income_expense_group_id' => '37',
            'type' => '1', /// Dr=1, Cr=0  56;

            'created_by' => 'E-Accounts System',
        ]);

        App\IncomeExpenseHead::create([
            'name' => 'Dividend Paid',
            'income_expense_type_id' => '22',
            'income_expense_group_id' => '42',
            'type' => '1', /// Dr=1, Cr=0  56;

            'created_by' => 'E-Accounts System',
        ]);






    }
}
