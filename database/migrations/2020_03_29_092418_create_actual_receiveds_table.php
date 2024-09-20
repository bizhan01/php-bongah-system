<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActualReceivedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actual_receiveds', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('sells_id')->unsigned();
            
            $table->string('term');
            $table->bigInteger('received_amount');
            $table->bigInteger('adjustment')->nullable();
            $table->bigInteger('actual_amount');
            $table->string('date_of_collection');

            $table->string('made_of_payment')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('bank_name')->nullable();

            $table->longText('remark')->nullable();



            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actual_receiveds');
    }
}
