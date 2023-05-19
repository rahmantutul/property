<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agentId');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('message');
            $table->foreign('agentId')->references('id')->on('agents')->onDelete('cascade');
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
        Schema::dropIfExists('agent_contacts');
    }
}
