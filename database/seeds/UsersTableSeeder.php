<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\User::create([
            'name'=>'Super Admin',
            'email'=>'superadmin@eaccount.xyz',
            'role_manage_id'=>1,
            'password'=>bcrypt('1234'),
            'create_by'=>'System',
        ]);

//        \App\User::create([
//            'name'=>'Admin',
//            'email'=>'admin@eaccount.xyz',
//            'role_manage_id'=>2,
//            'password'=>bcrypt('1234'),
//            'create_by'=>'System',
//        ]);
//
//        \App\User::create([
//            'name'=>'Accountant',
//            'email'=>'accountant@eaccount.xyz',
//            'role_manage_id'=>3,
//            'password'=>bcrypt('1234'),
//            'create_by'=>'System',
//        ]);
//
//        \App\User::create([
//            'name'=>'Project Manage',
//            'email'=>'projectmanager@eaccount.xyz',
//            'role_manage_id'=>4,
//            'password'=>bcrypt('1234'),
//            'create_by'=>'System',
//        ]);
//
//        \App\User::create([
//            'name'=>'Product Manager',
//            'email'=>'productmanager@eaccount.xyz',
//            'role_manage_id'=>5,
//            'password'=>bcrypt('1234'),
//            'create_by'=>'System',
//        ]);
//        \App\User::create([
//            'name'=>'Sells Manager',
//            'email'=>'sellsmanager@eaccount.xyz',
//            'role_manage_id'=>6,
//            'password'=>bcrypt('1234'),
//            'create_by'=>'System',
//        ]);
//
//        \App\User::create([
//            'name'=>'Purchase Manager',
//            'email'=>'purchasemanager@eaccount.xyz',
//            'role_manage_id'=>7,
//            'password'=>bcrypt('1234'),
//            'create_by'=>'System',
//        ]);


        \App\Profile::create([
            "user_ID"=> 1,
            "first_name"=>"Super",
            "last_name"=>"Admin",
            "gender"=>1,
            "designation"=>"PHP Developer",
            "phone_number"=>"+8801738578683",
            "NID"=>"199412478654477",
            "permanent_address"=>"PS: Raygonj, District: Sirajgonj",
            "present_address"=>"Dhaka,Bangladesh",
            'avatar'=>'upload/avatar/avatar.png',
            "education"=>'B.S. in Computer Science from the University of Primeasia University',
            'description'=>''
        ]);

//        \App\Profile::create([
//            "user_ID"=> 2,
//        ]);
//        \App\Profile::create([
//            "user_ID"=> 3,
//        ]);
//        \App\Profile::create([
//            "user_ID"=> 4,
//        ]);
//        \App\Profile::create([
//            "user_ID"=> 5,
//        ]);
//        \App\Profile::create([
//            "user_ID"=> 6,
//        ]);
//        \App\Profile::create([
//            "user_ID"=> 7,
//        ]);


    }
}
