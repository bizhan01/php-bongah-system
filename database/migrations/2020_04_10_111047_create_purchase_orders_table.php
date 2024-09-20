<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('branch_id')->unsigned();

            $table->string('requisition_id');
            $table->string('purchase_id')->nullable();

            $table->bigInteger('vendor_id')->unsigned();

            $table->string('media_name')->nullable();
            $table->string('issuing_date');

            $table->string('date_of_delevery');

            $table->string('contract_person_1')->nullable();
            $table->string('contract_person_2')->nullable();
            $table->longText('note')->nullable();

            $table->longText('subject');

            $table->longText('message_body');

            $table->longText('item');

            $table->bigInteger('totalAmount');


            $table->timestamps();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
}
