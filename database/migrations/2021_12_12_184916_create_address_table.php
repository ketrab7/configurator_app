<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->references('id')->on('users');
            $table->string('last_name', 50);
            $table->integer('phone_number');
            $table->string('address', 50);
            $table->string('house_number', 10);
            $table->string('zip_code', 6);
            $table->string('city', 50);
            $table->string('province', 50);
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
        Schema::dropIfExists('address');
    }
}
