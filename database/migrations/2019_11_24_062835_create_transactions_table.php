<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('voucher_no');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('cheque_number')->nullable();
            $table->unsignedBigInteger('income_expense_head_id')->nullable();
            $table->unsignedBigInteger('bank_cash_id')->nullable();
            $table->string('voucher_type');
            $table->date('voucher_date');
            $table->bigInteger('dr')->nullable();
            $table->bigInteger('cr')->nullable();
            $table->string('particulars')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            $table->timestamps();
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
        Schema::dropIfExists('transactions');
    }
}
