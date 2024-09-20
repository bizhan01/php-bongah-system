<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger("user_id");
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->integer("gender")->nullable();
            $table->string("designation")->nullable();
            $table->string("phone_number")->nullable();
            $table->unsignedBigInteger("NID")->nullable();
            $table->string("permanent_address")->nullable();
            $table->string("present_address")->nullable();
            $table->string('avatar')->nullable();
            $table->string('education')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
