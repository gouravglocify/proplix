<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterToCoupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->longText('description')->after('name')->default(null)->nullable();
            $table->integer('duration')->after('discount_value')->default(1)->nullable()->comment('13=lifetime');
            $table->integer('number_of_use')->after('duration')->default(1)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->date('start_date')->after('discount_value')->default(null)->nullable();
            $table->dropColumn('description');
            $table->dropColumn('duration');
            $table->dropColumn('number_of_use');
        });
    }
}
