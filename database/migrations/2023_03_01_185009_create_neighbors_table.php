<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeighborsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neighbors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('titleOne')->nullable();
            $table->text('titleOneDetails',228);
            $table->string('titleTwo')->nullable();
            $table->text('titleTwoDetails')->nullable();
            $table->string('titleThree')->nullable();
            $table->text('titleThreeDetails')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('neighbors');
    }
}
