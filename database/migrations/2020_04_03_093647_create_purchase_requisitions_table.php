<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requisitions', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('branch_id')->unsigned();
            $table->bigInteger('employee_id')->unsigned();

            $table->bigInteger('amount');

            $table->string('purpose')->nullable();
            $table->string('requisition_date');
            $table->string('required_date');

            $table->string('comment')->nullable();
            $table->string('contract_person')->nullable();
            $table->string('remark')->nullable();


            $table->longText('item');
            $table->string('requisition_id')->nullable();


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
        Schema::dropIfExists('purchase_requisitions');
    }
}
