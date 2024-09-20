<?php

use Illuminate\Database\Seeder;

class SellsTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Sell::create([
            'customer_id' =>1,
            'branch_id' =>2,
            'product_id' => '2-A-1st',
            'employee_id' =>1,
            'sells_date' => '01/04/2020'
        ]);
        App\Sell::create([
            'customer_id' =>2,
            'branch_id' =>3,
            'product_id' => '2-A-5th',
            'employee_id' =>2,
            'sells_date' => '02/04/2020'
        ]);
        
        App\Sell::create([
            'customer_id' =>1,
            'branch_id' =>4,
            'product_id' => '2-A-6th',
            'employee_id' =>3,
            'sells_date' => '03/04/2020'
        ]);


    }
}
