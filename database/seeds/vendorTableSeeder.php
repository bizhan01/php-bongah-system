<?php

use Illuminate\Database\Seeder;

class vendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Vendor::create([
            'name' => 'ABC BUILDING PRODUCTS LTD.',
            'mailing_address' => '8,Kemal Atartuk,Avenue,Banani,Dhaka-1213.',
            'phone' => '015xxx',
            'email' => 'abd@gmail.com',
        ]);

        App\Vendor::create([
            'name' => 'Abiding Trade Int. Ltd.',
            'mailing_address' => 'Abiding Reza Tower Level-1&2,57/2,Kakrail,Dhaka-1000',
            'phone' => '015xxx',
            'email' => 'abidingtrade@gmail.com',
        ]);
        App\Vendor::create([
            'name' => 'Anwar Ispat Ltd.',
            'mailing_address' => 'Dhaka - Mymensingh Hwy, Tongi',
            'phone' => '0183xxxxxx',
            'email' => 'anwarispat@gmail.com',
        ]);

        App\Vendor::create([
            'name' => 'BBS Cables Ltd',
            'mailing_address' => 'Mujib Sarak, Sirajganj',
            'phone' => '0183xxxxxx',
            'email' => 'bbscabls@gmail.com',
        ]);

        App\Vendor::create([
            'name' => 'Bengal Agencies',
            'mailing_address' => 'Dhaka 1205',
            'phone' => '0183xxxxxx',
            'email' => 'bengleagen@gmail.com',
        ]);

    }
}
