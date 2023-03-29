<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_activities', function (Blueprint $table) {
            $table->id();
            $table->string('reportName');
            $table->string('reportSubject');
            $table->string('reportDetails');
            $table->string('shareStatus')->comment('0=Not Shared, 1=Shared');
            $table->string('attachmentOne')->nullable();
            $table->string('attachmentTwo')->nullable();
            $table->string('attachmentThree')->nullable();
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
        Schema::dropIfExists('market_activities');
    }
}
