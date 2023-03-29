<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_amenities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propertyId')->nullable();
            $table->unsignedBigInteger('amenityId')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('propertyId')->references('id')->on('properties')->onDelete('cascade'); 
            $table->foreign('amenityId')->references('id')->on('amenity_types')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_amenities');
    }
}
