<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('propertyId')->nullable();
            $table->unsignedBigInteger('categoryId')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('propertyId')->references('id')->on('properties')->onDelete('cascade'); 
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_categories');
    }
}
