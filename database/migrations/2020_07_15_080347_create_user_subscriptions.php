<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->default(null);
            $table->string('subscription_id',50)->nullable()->default(null);
            $table->string('plan_id',50)->nullable()->default(null);
            $table->string('customer_id',50)->nullable()->default(null);
            $table->string('payment_id',50)->nullable()->default(null);
            $table->longText('signature',50)->nullable()->default(null);
            $table->longText('short_url',50)->nullable()->default(null);
            $table->string('status',50)->nullable()->default(null);
            $table->dateTime('charge_at')->nullable()->default(null);
            $table->dateTime('start_at')->nullable()->default(null);
            $table->dateTime('end_at')->nullable()->default(null);
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
        Schema::dropIfExists('user_subscriptions');
    }
}
