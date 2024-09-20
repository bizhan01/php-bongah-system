<?php

use Illuminate\Database\Seeder;

class ContraVoucherTableSeeder extends Seeder
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
            'voucher_type' => 'Contra',
            'voucher_date'=>'2019-11-25',
            'dr'=>'100',
            'particulars'=>'Contra Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);
        App\Transaction::create([
            'voucher_no' => '1',
            'branch_id'=>'1',
            'bank_cash_id'=>'2',
            'cheque_number'=>'124-256-365',
            'voucher_type' => 'Contra',
            'voucher_date'=>'2019-11-25',
            'cr'=>'100',
            'particulars'=>'Contra Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);


        App\Transaction::create([
            'voucher_no' => '2',
            'branch_id'=>'2',
            'bank_cash_id'=>'2',
            'cheque_number'=>'124-256-361',
            'voucher_type' => 'Contra',
            'voucher_date'=>'2019-11-30',
            'dr'=>'40000',
            'particulars'=>'Contra Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);
        App\Transaction::create([
            'voucher_no' => '2',
            'branch_id'=>'2',
            'bank_cash_id'=>'1',
            'voucher_type' => 'Contra',
            'voucher_date'=>'2019-11-30',
            'cr'=>'40000',
            'particulars'=>'Contra Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);


        App\Transaction::create([
            'voucher_no' => '3',
            'branch_id'=>'2',
            'bank_cash_id'=>'1',
            'voucher_type' => 'Contra',
            'voucher_date'=>'2019-12-1',
            'dr'=>'500',
            'particulars'=>'Contra Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);
        App\Transaction::create([
            'voucher_no' => '3',
            'branch_id'=>'2',
            'bank_cash_id'=>'4',
            'cheque_number'=>'124-256-361',
            'voucher_type' => 'Contra',
            'voucher_date'=>'2019-12-1',
            'cr'=>'500',
            'particulars'=>'Contra Voucher by System',
            'created_by'=>'E-Accounts System',
        ]);



    }
}
