<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('email',228);
            $table->string('phone')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('roleId')->default(1);
            $table->string('avatar')->nullable();
            $table->string('address',2000)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Active,2=Inactive,0=Deleted')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); 
            $table->foreign('roleId')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
