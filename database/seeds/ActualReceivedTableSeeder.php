<?php

use Illuminate\Database\Seeder;

class ActualReceivedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ActualReceived::create([
            'sells_id'=>1,
            'term'=> 'Booking Money',
            'received_amount'=> '1000000',
            'actual_amount'=> '1000000',
            'date_of_collection'=> '05/01/20205',
            'made_of_payment'=> 'bank',
            'cheque_no'=> '1495681',
            'bank_name'=> 'HSBC',
            'remark'=> 'Booking Money Done',
        ]);
        App\ActualReceived::create([
            'sells_id'=>1,
            'term'=> 'Down Payment',
            'received_amount'=> '7500000',
            'actual_amount'=> '7500000',
            'date_of_collection'=> '07/31/2020',
            'made_of_payment'=> 'Chq',
            'cheque_no'=> '124-124-xxx',
            'bank_name'=> 'DBBL',
            'remark'=> 'Down Payment Done',
        ]);
        App\ActualReceived::create([
            'sells_id'=>1,
            'term'=> '1st Installment',
            'received_amount'=> '2580000',
            'actual_amount'=> '2580000',
            'date_of_collection'=> '09/30/2020',
            'made_of_payment'=> 'Bank',
            'cheque_no'=> '',
            'bank_name'=> 'Prime Bank',
            'remark'=> 'Done',
        ]);
        App\ActualReceived::create([
            'sells_id'=>1,
            'term'=> '2nd Installment',
            'received_amount'=> '3300000',
            'actual_amount'=> '3300000',
            'date_of_collection'=> '11/30/2020',
            'made_of_payment'=> 'Chq',
            'cheque_no'=> '',
            'bank_name'=> 'HSBC',
            'remark'=> 'Payment Completed',
        ]);



        App\ActualReceived::create([
            'sells_id'=>2,
            'term'=> 'Booking Money',
            'received_amount'=> '15000000',
            'actual_amount'=> '15000000',
            'date_of_collection'=> '05/31/2020',
            'made_of_payment'=> 'bank',
            'cheque_no'=> '145-868-xxx',
            'bank_name'=> 'Brack Bank',
            'remark'=> 'Done',
        ]);

    }
}
