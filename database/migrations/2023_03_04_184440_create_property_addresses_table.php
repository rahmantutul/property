<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propertyId')->nullable();
            $table->unsignedBigInteger('cityId')->nullable();
            $table->unsignedBigInteger('stateId')->nullable();
            $table->unsignedBigInteger('countryId')->nullable();
            $table->string('streetNumber')->nullable();
            $table->string('streetAddressOne')->nullable();
            $table->string('streetAddressTwo')->nullable();
            $table->string('shuitAppertment')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('subDivision')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('propertyId')->references('id')->on('properties')->onDelete('cascade'); 
            $table->foreign('countryId')->references('id')->on('countries')->onDelete('cascade'); 
            $table->foreign('cityId')->references('id')->on('cities')->onDelete('cascade'); 
            $table->foreign('stateId')->references('id')->on('states')->onDelete('cascade'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_addresses');
    }
}
