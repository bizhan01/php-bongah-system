<?php

use Illuminate\Database\Seeder;

class JournalVoucherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Transaction::create([
            'voucher_no' => '1',
            'branch_id'=>'1',
            'income_expense_head_id'=>'1',
            'voucher_type' => 'JV',
            'voucher_date'=>'2019-11-25',
            'dr'=>'200',
            'particulars'=>'Journal Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);
        App\Transaction::create([
            'voucher_no' => '1',
            'branch_id'=>'1',
            'income_expense_head_id'=>'2',
            'voucher_type' => 'JV',
            'voucher_date'=>'2019-11-25',
            'dr'=>'300',
            'particulars'=>'Journal Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);

        App\Transaction::create([
            'voucher_no' => '1',
            'branch_id'=>'1',
            'income_expense_head_id'=>'20',
            'voucher_type' => 'JV',
            'voucher_date'=>'2019-11-25',
            'cr'=>'100',
            'particulars'=>'Journal Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);
        App\Transaction::create([
            'voucher_no' => '1',
            'branch_id'=>'1',
            'income_expense_head_id'=>'21',
            'voucher_type' => 'JV',
            'voucher_date'=>'2019-11-25',
            'cr'=>'400',
            'particulars'=>'Journal Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);



        App\Transaction::create([
            'voucher_no' => '2',
            'branch_id'=>'1',
            'income_expense_head_id'=>'3',
            'voucher_type' => 'JV',
            'voucher_date'=>'2019-11-25',
            'dr'=>'1000',
            'particulars'=>'Journal Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);
        App\Transaction::create([
            'voucher_no' => '2',
            'branch_id'=>'1',
            'income_expense_head_id'=>'17',
            'voucher_type' => 'JV',
            'voucher_date'=>'2019-11-25',
            'cr'=>'1000',
            'particulars'=>'Journal Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);




         App\Transaction::create([
            'voucher_no' => '3',
            'branch_id'=>'1',
            'income_expense_head_id'=>'2',
            'voucher_type' => 'JV',
            'voucher_date'=>'2019-11-25',
            'dr'=>'1000',
            'particulars'=>'Journal Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);
        App\Transaction::create([
            'voucher_no' => '3',
            'branch_id'=>'1',
            'income_expense_head_id'=>'3',
            'voucher_type' => 'JV',
            'voucher_date'=>'2019-11-25',
            'dr'=>'1000',
            'particulars'=>'Journal Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);
        App\Transaction::create([
            'voucher_no' => '3',
            'branch_id'=>'1',
            'income_expense_head_id'=>'17',
            'voucher_type' => 'JV',
            'voucher_date'=>'2019-11-25',
            'cr'=>'2000',
            'particulars'=>'Journal Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);




        App\Transaction::create([
            'voucher_no' => '4',
            'branch_id'=>'1',
            'income_expense_head_id'=>'7',
            'voucher_type' => 'JV',
            'voucher_date'=>'2019-11-25',
            'dr'=>'4000',
            'particulars'=>'Journal Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);

        App\Transaction::create([
            'voucher_no' => '4',
            'branch_id'=>'1',
            'income_expense_head_id'=>'27',
            'voucher_type' => 'JV',
            'voucher_date'=>'2019-11-25',
            'cr'=>'3000',
            'particulars'=>'Journal Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);
        App\Transaction::create([
            'voucher_no' => '4',
            'branch_id'=>'1',
            'income_expense_head_id'=>'31',
            'voucher_type' => 'JV',
            'voucher_date'=>'2019-11-25',
            'cr'=>'1000',
            'particulars'=>'Journal Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);


    }
}
