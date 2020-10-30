<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('reports');
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',25)->default(null)->nullable();
            $table->bigInteger('user_id')->default(null)->nullable();
            $table->float('sellingprice')->default(null)->nullable();
            $table->float('productcost')->default(null)->nullable();
            $table->float('orders')->default(null)->nullable();
            $table->float('roas')->default(null)->nullable();
            $table->float('delivery')->default(null)->nullable();
            $table->float('salevalue')->default(null)->nullable();
            $table->float('cpp')->default(null)->nullable();
            $table->float('delivered')->default(null)->nullable();
            $table->float('profitperdelivered')->default(null)->nullable();
            $table->float('totalprofit')->default(null)->nullable();
            $table->float('remittance')->default(null)->nullable();
            $table->float('adcost')->default(null)->nullable();
            $table->float('product')->default(null)->nullable();
            $table->float('gst')->default(null)->nullable();
            $table->float('packaging')->default(null)->nullable();
            $table->float('shipping')->default(null)->nullable();
            $table->float('totalexpense')->default(null)->nullable();
            $table->float('shippingcost')->default(null)->nullable();
            $table->float('rtocharge')->default(null)->nullable();
            $table->float('weightsegment')->default(null)->nullable()->comment('in grams');
            $table->float('gstpercentage')->default(null)->nullable();
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
        Schema::dropIfExists('reports');
    }
}
