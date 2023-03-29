<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
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
            $table->unsignedBigInteger('agentId')->nullable();
            $table->unsignedBigInteger('buyerId')->nullable();
            $table->unsignedBigInteger('sellerId')->nullable();
            $table->unsignedBigInteger('typeId')->nullable();
            $table->unsignedBigInteger('garageTypeId')->nullable();
            $table->string('title',1000)->nullable();
            $table->string('mlsId',1000)->nullable();
            $table->date('availableDate')->nullable();
            $table->date('expireDate')->nullable();
            $table->decimal('price',10,2)->default(0.00)->nullable();
            $table->decimal('originalPrice',10,2)->default(0.00)->nullable();
            $table->string('thumbnail',1000)->nullable();
            $table->string('videoUrl',1000)->nullable();
            $table->string('slug',1000)->nullable();
            $table->string('virtualTour',1000)->nullable();
            $table->string('previewText',1000)->nullable();
            $table->tinyInteger('isHideAddress')->default(1)->comment('1=Yes,0=No')->nullable();
            $table->tinyInteger('callForPrice')->default(1)->comment('1=Yes,0=No')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Active,2=Inactive,0=Deleted')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
            $table->foreign('agentId')->references('id')->on('agents')->onDelete('cascade'); 
            $table->foreign('buyerId')->references('id')->on('buyers')->onDelete('cascade'); 
            $table->foreign('sellerId')->references('id')->on('sellers')->onDelete('cascade'); 
            $table->foreign('typeId')->references('id')->on('property_types')->onDelete('cascade'); 
            $table->foreign('garageTypeId')->references('id')->on('garage_types')->onDelete('cascade'); 
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
