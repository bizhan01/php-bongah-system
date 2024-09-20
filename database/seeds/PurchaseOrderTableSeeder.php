<?php

use Illuminate\Database\Seeder;
use App\PurchaseOrder;

class PurchaseOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        PurchaseOrder::create([
            'branch_id' => 3,
            'requisition_id' => 'RQN-20-0002',
            'purchase_id' => 'PON-20-0001',
            'vendor_id' => 1,
            'media_name' => 'Abu Talha',
            'issuing_date' => '05/30/2020',
            'date_of_delevery' => '05/31/2020',
            'contract_person_1' => 'Khokhon - +88017xxxxx',
            'contract_person_2' => '',
            'note' => 'Ensure the good quality materials',
            'subject' => 'Work order for Swithch & Socket',
            'message_body' => 'This is an reference to your discussion had with us today, we are pleased to place an order for supplying Work order for Switch & Socket at our project under the following terms & conditions.',

            'item' => '{"items":[{"income_expense_head_id":"5","income_expense_head_name":"Switch & Socket","unit":"Pcs","description":"RFL Switch","qntity":"40","rate":"30","amount":"1200"}]}',

            'totalAmount' => '1200',

            'created_by' => 'System',

        ]);

        PurchaseOrder::create([
            'branch_id' => 3,
            'requisition_id' => 'RQN-20-0002',
            'purchase_id' => 'PON-20-0002',
            'vendor_id' => 4,
            'media_name' => 'Rakib',
            'issuing_date' => '05/14/2020',
            'date_of_delevery' => '05/20/2020',
            'contract_person_1' => 'Rakib-+88017xxxx',
            'contract_person_2' => '',
            'note' => 'Ensure the good quality materials',
            'subject' => 'Work order for Cable',
            'message_body' => 'This is an reference to your discussion had with us today, we are pleased to place an order for supplying Work order for Cable at our project under the following terms & conditions.',

            'item' => '{"items":[{"income_expense_head_id":"6","income_expense_head_name":"Cable","unit":null,"description":"BRB CABLE","qntity":"100","rate":"30","amount":"3000"}]}',
            'totalAmount' => '3000',

            'created_by' => 'System',

        ]);

        PurchaseOrder::create([
            'branch_id' => 3,
            'requisition_id' => 'RQN-20-0002',
            'purchase_id' => 'PON-20-0003',
            'vendor_id' => 2,
            'media_name' => 'Nazrul',
            'issuing_date' => '05/28/2020',
            'date_of_delevery' => '05/29/2020',
            'contract_person_1' => 'Talha- +8801xxxxx',
            'contract_person_2' => '',
            'note' => 'Ensure the good quality materials',
            'subject' => 'Work Order for Switch',
            'message_body' => 'This is an reference to your discussion had with us today, we are pleased to place an order for supplying Work order for Switch at our project under the following terms & conditions.',

            'item' => '{"items":[{"income_expense_head_id":"5","income_expense_head_name":"Switch & Socket","unit":"Pcs","description":"RFL Switch","qntity":"20","rate":"30","amount":"600"}]}',
            'totalAmount' => '600',

            'created_by' => 'System',

        ]);





    }
}
