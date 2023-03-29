<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenity_types', function (Blueprint $table) {
            $table->id();
            $table->string('amenity')->nullable();
            $table->enum('amenityType',['General Amenities','Interior Amenities','Exterior Amenities'])->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Active,2=Inactive,0=Deleted')->nullable();
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
        Schema::dropIfExists('amenity_types');
    }
}
