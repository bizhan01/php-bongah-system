<?php

use Illuminate\Database\Seeder;

class CrVoucherTableSeeder extends Seeder
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
            'bank_cash_id'=>'1',
            'income_expense_head_id'=>'8',
            'voucher_type' => 'CV',
            'voucher_date'=>'2019-11-25',
            'cr'=>'100000',
            'particulars'=>'CR by System',
            'created_by'=>'E-Accounts System',
        ]);
        App\Transaction::create([
            'voucher_no' => '2',
            'branch_id'=>'2',
            'bank_cash_id'=>'2',
            'cheque_number'=>'112541',
            'income_expense_head_id'=>'15',
            'voucher_type' => 'CV',
            'voucher_date'=>'2019-11-26',
            'cr'=>'50000',
            'particulars'=>'CR by System',
            'created_by'=>'E-Accounts System',
        ]);
        App\Transaction::create([
            'voucher_no' => '3',
            'branch_id'=>'2',
            'bank_cash_id'=>'3',
            'cheque_number'=>'14521',
            'income_expense_head_id'=>'15',
            'voucher_type' => 'CV',
            'voucher_date'=>'2019-11-27',
            'cr'=>'15000',
            'particulars'=>'CR by System',
            'created_by'=>'E-Accounts System',
        ]);

        App\Transaction::create([
            'voucher_no' => '3',
            'branch_id'=>'2',
            'bank_cash_id'=>'3',
            'income_expense_head_id'=>'16',
            'voucher_type' => 'CV',
            'voucher_date'=>'2019-11-27',
            'cr'=>'60000',
            'particulars'=>'Cr by System',
            'created_by'=>'E-Accounts System',
        ]);
    }
}
