<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpDesksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_desks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId')->nullable();
            $table->tinyInteger('userType')->nullable()->comment('1=Admin,2=Agent,3=Buyer,4=Seller,5=Guest user');
            $table->string('email')->nullable();
            $table->string('subject')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Active,2=Read,0=Deleted')->nullable();
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
        Schema::dropIfExists('help_desks');
    }
}
