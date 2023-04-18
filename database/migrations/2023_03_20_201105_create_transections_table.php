<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transections', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();

            $table->tinyInteger('transection_type')->comment('1=Sale Transection, 2=Listing Transection, 3=others');
            $table->integer('listing_price')->nullable();
            $table->integer('sold_price')->nullable();
            $table->date('listing_date')->nullable();
            $table->date('sold_date')->nullable();

            $table->string('property_address')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->tinyInteger('state')->comment('1=Arizona, 2=Oregon, 3=Washington')->nullable();

            $table->string('buyer_one_name')->nullable();
            $table->string('buyer_two_name')->nullable();
            $table->string('buyer_address')->nullable();
            $table->string('buyer_phone')->nullable();
            $table->string('buyer_agent')->nullable();
            $table->string('buyer_agent_email')->nullable();
            $table->string('buyer_agent_phone')->nullable();
            
            $table->string('seller_one_name')->nullable();
            $table->string('seller_two_name')->nullable();
            $table->string('seller_address')->nullable();
            $table->string('seller_phone')->nullable();
            $table->string('seller_agent')->nullable();
            $table->string('seller_agent_email')->nullable();
            $table->string('seller_agent_phone')->nullable();

            $table->string('closing_title')->nullable();
            $table->string('escrow_transection')->nullable();
            $table->string('title_address')->nullable();
            $table->string('title_phone')->nullable();
            $table->string('title_agent')->nullable();
            $table->string('title_email')->nullable();

            $table->float('commission_amount',10,2)->nullable();
            $table->string('commission_type')->nullable();
            $table->float('earnest_money',10,2)->nullable();
            $table->string('earnest_money_holder')->nullable();
            $table->string('home_warrenty')->nullable();
            $table->string('broker_note')->nullable();
            $table->string('agent_note')->nullable();
            $table->string('office_note')->nullable();
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
            $table->string('send_mail')->nullable();

            $table->boolean('is_approved')->default(0)->comment('0=Not approved, 1=Approved');
            $table->boolean('is_paid')->default(0)->comment('0=Not paid, 1=Paid');
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
        Schema::dropIfExists('transections');
    }
}
