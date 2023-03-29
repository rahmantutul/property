<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propertyId')->nullable();
            $table->string('numOfBedroom')->nullable();
            $table->string('numOfBathroom')->nullable();
            $table->string('totalUnit')->nullable();
            $table->string('squareFeet')->nullable();
            $table->string('lotSize')->nullable();
            $table->string('lotAcre')->nullable();
            $table->string('lotType')->nullable();
            $table->string('heat')->nullable();
            $table->string('cooling')->nullable();
            $table->string('fuel')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Active,2=Inactive,0=Deleted')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('propertyId')->references('id')->on('properties')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_details');
    }
}
