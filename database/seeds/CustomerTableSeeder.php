<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Customer::create([
            'name' => 'Shahed kaiser',
            'father_or_husband_name' => 'Shohel Rana',
            'phone' => '0xxxx',
            'email' => 'xxxx@xx.com',
            'mailing_address' => 'Sirajgonj',
            'nid' => '123xxx',
        ]);

        App\Customer::create([
            'name' => 'Rajib Mondal',
            'father_or_husband_name' => 'Goutom Mondal',
            'phone' => '0xxxxxx',
            'email' => 'xxx@xxx.com',
            'mailing_address' => 'Rajbari',
            'nid' => '12xxx',
        ]);

        App\Customer::create([
            'name' => 'Imran Khan',
            'father_or_husband_name' => 'Kapur Khan',
            'phone' => '0xxxxxx',
            'email' => 'xxx@xxx.com',
            'mailing_address' => 'Bogra',
            'nid' => 'xxx',
        ]);

        App\Customer::create([
            'name' => 'Salman Khan',
            'father_or_husband_name' => 'Kapur Khan',
            'phone' => '0xxxxxx',
            'email' => 'xxx@xxx.com',
            'mailing_address' => 'India',
            'nid' => 'xxxx',
        ]);
        App\Customer::create([
            'name' => 'Amir Khan',
            'father_or_husband_name' => 'Arbaj Khan',
            'phone' => '0xxxxxx',
            'email' => 'xxx@xxx.com',
            'mailing_address' => 'India',
            'nid' => 'xxxx',
        ]);



        
    }
}
