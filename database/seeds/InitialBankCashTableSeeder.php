<?php

use Illuminate\Database\Seeder;

class InitialBankCashTableSeeder extends Seeder
{


    protected $voucher_type = 'IBCBV';

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
            'bank_cash_id' => '1',
            'voucher_type' => $this->voucher_type,
            'voucher_date' => '2019-11-25',
            'cr' => '200',
            'particulars' => 'This is First Initial Cash Balance',
            'created_by' => 'E-Accounts System',

        ]);

        App\Transaction::create([
            'voucher_no' => '2',
            'branch_id' => '1',
            'bank_cash_id' => '2',
            'cheque_number' => '125-8741-963',
            'voucher_type' => $this->voucher_type,
            'voucher_date' => '2019-11-26',
            'cr' => '700',
            'particulars' => 'Dutch Bangla Bank Limited',
            'created_by' => 'E-Accounts System',

        ]);

        App\Transaction::create([
            'voucher_no' => '3',
            'branch_id' => '1',
            'bank_cash_id' => '3',
            'cheque_number' => '121-8741-968',
            'voucher_type' => $this->voucher_type,
            'voucher_date' => '2019-11-27',
            'cr' => '100',
            'particulars' => 'HSBC',
            'created_by' => 'E-Accounts System',

        ]);
        App\Transaction::create([
            'voucher_no' => '4',
            'branch_id' => '1',
            'bank_cash_id' => '6',
            'cheque_number' => '127-874-965',
            'voucher_type' => $this->voucher_type,
            'voucher_date' => '2019-11-27',
            'cr' => '85698745',
            'particulars' => 'Jomuna Bank',
            'created_by' => 'E-Accounts System',

        ]);


    }
}
