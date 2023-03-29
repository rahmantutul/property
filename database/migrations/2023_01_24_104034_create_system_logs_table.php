<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dataId')->nullable()->comment('no of id of table');
            $table->bigInteger('staffId')->nullable()->comment('done by who');
            $table->string('referenceTable')->nullable()->comment('data table name');
            $table->string('note',1000)->nullable()->comment('data transaction details');
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
        Schema::dropIfExists('system_logs');
    }
}
