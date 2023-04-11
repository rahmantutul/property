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
            $table->string('bannerImage')->nullable();
            $table->string('image')->nullable();
            $table->string('attachmentThree')->nullable();
            $table->string('created_by')->nullable();
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
