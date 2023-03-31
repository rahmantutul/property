<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResoapiPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resoapi_properties', function (Blueprint $table) {
            $table->id();
            $table->integer('BathroomsTotalInteger')->nullable();
            $table->integer('BedroomsTotal')->nullable();
            $table->float('BuildingAreaTotal')->nullable();
            $table->string('BuyerOfficeName')->nullable();
            $table->string('BuyerOfficePhone')->nullable();
            $table->string('City')->nullable();
            $table->string('CloseDate')->nullable();
            $table->unsignedBigInteger('ClosePrice')->nullable();
            $table->string('CondominiumElevatorYN')->nullable();
            $table->string('CondominiumGarageType')->nullable();
            $table->string('Country')->nullable();
            $table->unsignedBigInteger('CurrentPriceForStatus')->nullable();
            $table->string('Directions')->nullable();
            $table->float('GarageSpaces')->nullable();
            $table->string('GarageType')->nullable();
            $table->string('Latitude')->nullable();
            $table->string('ListPrice')->nullable();
            $table->string('Longitude')->nullable();
            $table->string('ListingId')->nullable();
            $table->string('LotSizeDimensions')->nullable();
            $table->unsignedBigInteger('LotSizeSquareFeet')->nullable();
            $table->integer('MainLevelAreaTotal')->nullable();
            $table->float('ParkingTotal')->nullable();
            $table->string('Photo1URL')->nullable();
            $table->string('PropertyType')->nullable();
            $table->string('PropertySubType')->nullable();
            $table->longText('PublicRemarks')->nullable();
            $table->string('StreetName')->nullable();
            $table->string('StreetNumber')->nullable();
            $table->integer('StreetNumberNumeric')->nullable();
            $table->integer('YearBuilt')->nullable();
            $table->string('PostalCode')->nullable();
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
        Schema::dropIfExists('resoapi_properties');
    }
}
