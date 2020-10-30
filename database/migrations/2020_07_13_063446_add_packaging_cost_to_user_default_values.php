<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPackagingCostToUserDefaultValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_default_values', function (Blueprint $table) {
            $table->string('packaging_cost',25)->after('weight_segment')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_default_values', function (Blueprint $table) {
            $table->dropColumn('packaging_cost');
        });
    }
}
