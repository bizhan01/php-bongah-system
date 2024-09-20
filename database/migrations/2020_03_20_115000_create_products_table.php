<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedBigInteger('branch_id');
            $table->string('product_unique_id')->unique();
            $table->string('flat_type');
            $table->string('floor_number');

            $table->bigInteger('flat_size');
            $table->bigInteger('unite_price');
            $table->bigInteger('total_flat_price');

            $table->bigInteger('car_parking_charge')->nullable();
            $table->bigInteger('utility_charge')->nullable();
            $table->bigInteger('additional_work_charge')->nullable();
            $table->bigInteger('other_charge')->nullable();
            $table->bigInteger('discount_or_deduction')->nullable();
            $table->bigInteger('refund_additional_work_charge')->nullable();

            $table->bigInteger('net_sells_price');

            $table->string('description')->nullable();

            $table->string('product_img')->nullable();



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
        Schema::dropIfExists('products');
    }
}
