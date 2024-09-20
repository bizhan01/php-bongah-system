<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Product::create([
            'product_unique_id'=> '2-A-1st',
            'branch_id' => '2',
            'flat_type' => 'A',
            'floor_number' => '1st',

            'flat_size' => '1940',
            'unite_price' => '7000',
            'total_flat_price' => '13580000',

            'car_parking_charge' => '500000',
            'utility_charge' => '300000',

            'net_sells_price' => '14380000',

        ]);

        App\Product::create([
            'product_unique_id' => '2-A-5th',
            'branch_id' => '3',
            'flat_type' => 'A',
            'floor_number' => '5th',

            'flat_size' => '2600',
            'unite_price' => '6400',
            'total_flat_price' => '16640000',

            'car_parking_charge' => '400000',
            'utility_charge' => '300000',
            'other_charge' => '60000',

            'net_sells_price' => '17400000',

        ]);

         App\Product::create([
            'product_unique_id' => '2-A-6th',
            'branch_id' => '4',
            'flat_type' => 'A',
            'floor_number' => '6th',

            'flat_size' => '2230',
            'unite_price' => '7045',
            'total_flat_price' => '15710350',

            'car_parking_charge' => '400000',
            'utility_charge' => '300000',
            'discount_or_deduction' => '350',

            'net_sells_price' => '16410000',

        ]);
        
        

    }
}
