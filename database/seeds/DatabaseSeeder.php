<?php

use App\Setting;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

//     System Setting
        $this->call(UsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(RoleManageTableSeeder::class);

        $this->call(BranchTableSeeder::class);

//        Inventory
        //$this->call(ProductTableSeeder::class);
        //$this->call(CustomerTableSeeder::class);
        //$this->call(vendorTableSeeder::class);
        //$this->call(EmployeeTableSeeder::class);
        //$this->call(SellsTableseeder::class);
        //$this->call(ScheduleReceivablesTableSeeder::class);
        //$this->call(ActualReceivedTableSeeder::class);
        //$this->call(PurchaseRequisitionTableSeeder::class);
        //$this->call(PurchaseOrderTableSeeder::class);

//        Account
        $this->call(IncomeExpenseTableSeeder::class);
        //$this->call(IncomeExpenseGroupsTableSeeder::class);
        //$this->call(IncomeExpenseHeadTableSeeder::class);
        $this->call(BankCashTableSeeder::class);


//        // $this->call(InitialIncomeExpenseHeadBalanceTableSeeder::class);
//        // $this->call(InitialBankCashTableSeeder::class);

        //$this->call(DrVoucherTableSeeder::class);
        //$this->call(CrVoucherTableSeeder::class);
        //$this->call(JournalVoucherTableSeeder::class);
        //$this->call(ContraVoucherTableSeeder::class);
    }
}
