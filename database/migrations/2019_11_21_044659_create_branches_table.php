<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();

            $table->longText('location')->nullable();
            $table->longText('address')->nullable();

            $table->string('facing')->nullable();
            $table->string('building_height')->nullable();
            $table->string('land_area')->nullable();

            $table->string('launching_date')->nullable();
            $table->string('hand_over_date')->nullable();


            $table->longText('description')->nullable();


            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->string('delete_by')->nullable();

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
        Schema::dropIfExists('branches');
    }
}
