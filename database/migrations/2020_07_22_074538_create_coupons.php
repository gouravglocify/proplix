<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name',25)->default(null)->nullable();
            $table->enum('discount_type',['1','2'])->default(null)->nullable()->comment('1=flat 2=percentage');
            $table->float('discount_value')->default(null)->nullable();
            $table->date('start_date')->default(null)->nullable();
            $table->date('end_date')->default(null)->nullable();
            $table->enum('status',['1','2'])->default('1')->nullable()->comment('1=not deleted 2=deleted');
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
        Schema::dropIfExists('coupons');
    }
}
