<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->tinyInteger('user_type')->comment('1=Admin,2=Agent,3=Seller,4=Buyer');
            $table->tinyInteger('status')->default(1)->comment('1=Active,2=Inactive,0=Deleted')->nullable();
            $table->tinyInteger('is_approved')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_online')->default(0);
            $table->timestamp('last_activity')->default(now());
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
