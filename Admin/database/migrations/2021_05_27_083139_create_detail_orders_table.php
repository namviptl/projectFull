<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->tinyInteger('size');
            $table->primary(['order_id','product_id','size']);
            $table->tinyInteger('quantity');
            $table->integer('price');
            $table->integer('price_total');
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
            // $table->foreign('order_id')->references('id')->on('orders');
            // $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_orders');
    }
}
