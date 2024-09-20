<?php

use Illuminate\Database\Seeder;

class InitialIncomeExpenseHeadBalanceTableSeeder extends Seeder
{

    protected $voucher_type = 'IIEHBV';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Transaction::create([
            'voucher_no' => '1',
            'branch_id' => '1',
            'income_expense_head_id' => '1',
            'voucher_type' => $this->voucher_type,
            'voucher_date' => '2019-09-18',
            'dr' => '200',
            'particulars' => 'This is First Initial Head Balance include',
            'created_by' => 'E-Accounts System',

        ]);
        App\Transaction::create([
            'voucher_no' => '2',
            'branch_id' => '1',
            'income_expense_head_id' => '2',
            'voucher_type' => $this->voucher_type,
            'voucher_date' => '2019-09-18',
            'dr' => '300',
            'particulars' => 'This is First Initial Head Balance include',
            'created_by' => 'E-Accounts System',

        ]);
        App\Transaction::create([
            'voucher_no' => '3',
            'branch_id' => '1',
            'income_expense_head_id' => '3',
            'voucher_type' => $this->voucher_type,
            'voucher_date' => '2019-09-18',
            'dr' => '500',
            'particulars' => 'This is First Initial Head Balance include',
            'created_by' => 'E-Accounts System',

        ]);

        App\Transaction::create([
            'voucher_no' => '4',
            'branch_id' => '1',
            'income_expense_head_id' => '16',
            'voucher_type' => $this->voucher_type,
            'voucher_date' => '2019-09-18',
            'cr' => '300',
            'particulars' => 'This is First Initial Head Balance include',
            'created_by' => 'E-Accounts System',

        ]);
        App\Transaction::create([
            'voucher_no' => '5',
            'branch_id' => '1',
            'income_expense_head_id' => '17',
            'voucher_type' => $this->voucher_type,
            'voucher_date' => '2019-09-18',
            'cr' => '700',
            'particulars' => 'This is First Initial Head Balance include',
            'created_by' => 'E-Accounts System',

        ]);

    }
}
