<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propertyId')->nullable();
            $table->string('imageUrl')->nullable();
            $table->enum('type',['Image','Video'])->nullable();
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
        Schema::dropIfExists('property_images');
    }
}
