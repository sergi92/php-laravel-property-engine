<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('street');
            $table->string('number');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('status');
            $table->string('type');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('condition');
            $table->string('room');
            $table->string('bath');
            $table->string('size');
            $table->string('price');
            $table->string('pet');
            $table->string('garden');
            $table->string('air_conditioning');
            $table->string('swimming_pool');
            $table->string('terrace');
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
        Schema::dropIfExists('properties');
    }
}
