<?php

use Illuminate\Database\Seeder;

class PurchaseRequisitionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\PurchaseRequisition::create([
            'branch_id' => '2',
            'employee_id' => '1',
            'amount' => '168000',
            'purpose' => 'Shade Work',
            'requisition_date' => '05/01/2020',
            'required_date' => '05/31/2020',
            'comment' => 'Urgent Requisition',
            'contract_person' => 'Eng. Rakib',
            'item' => '{"items":[{"income_expense_head_id":"1","income_expense_head_name":"\t1st Class Brick (Hand Made)","unit":"Pcs","description":"Good Quality","qntity":"1000","rate":"8","amount":"8000"},{"income_expense_head_id":"2","income_expense_head_name":"3\/4\" Crushed Stone","unit":"Pcs","description":"Sylete Stone","qntity":"8000","rate":"20","amount":"160000"}]}',
            'requisition_id' => '',
            'created_by' => 'E-Inventory System'

        ]);

        App\PurchaseRequisition::create([
            'branch_id' => '3',
            'employee_id' => '3',
            'amount' => '5400',
            'purpose' => 'Interior Design',
            'requisition_date' => '05/14/2020',
            'required_date' => '05/20/2020',
            'comment' => 'Make sure products are good quality',
            'contract_person' => 'Eng. Sumon',
            'remark' => '',
            'item' => '{"items":[{"income_expense_head_id":"5","income_expense_head_name":"Switch & Socket","unit":"Pcs","description":"RFL Switch","qntity":"80","rate":"30","amount":"2400"},{"income_expense_head_id":"6","income_expense_head_name":"Cable","unit":null,"description":"BRB CABLE","qntity":"100","rate":"30","amount":"3000"}]}',
            'requisition_id' => 'RQN-20-0002',
            'created_by' => 'E-Inventory System'

        ]);


    }
}
