<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AaddColumnsToUserSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->bigInteger('coupon_id')->after('current_end')->default(null)->nullable();
            $table->float('discount_amount')->after('coupon_id')->default(null)->nullable();
            $table->float('discount_price')->after('discount_amount')->default(null)->nullable()->comment('Amount left after applying coupon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dropColumn('coupon_id');
            $table->dropColumn('discount_amount');
            $table->dropColumn('discount_price');
        });
    }
}
