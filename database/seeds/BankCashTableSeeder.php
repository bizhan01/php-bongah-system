<?php

use Illuminate\Database\Seeder;

class BankCashTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\BankCash::create([
            'name' => 'Cash',
            'description' => 'This is Cash of our company'
        ]);
//        App\BankCash::create([
//            'name' => 'DBBL',
//            'account_number' => '199457441',
//            'description' => 'Dutch Bangla Bank Limited'
//        ]);
//        App\BankCash::create([
//            'name' => 'HSBC',
//            'account_number' => '199454215',
//        ]);
//        App\BankCash::create([
//            'name' => 'Prime Bank',
//            'account_number' => '199451454215',
//        ]);
//        App\BankCash::create([
//            'name' => 'Agroni Bank',
//            'account_number' => '1994514264215',
//        ]);
//        App\BankCash::create([
//            'name' => 'Jomuna Bank',
//            'account_number' => '19945454154215',
//        ]);


    }
}
