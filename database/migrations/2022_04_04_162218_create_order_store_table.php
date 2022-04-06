<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_order_store', function (Blueprint $table) {
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('order_id');

            $table->foreign('store_id')->references('id')->on('tb_stores');
            $table->foreign('order_id')->references('id')->on('tb_user_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_order_store');
    }
}
