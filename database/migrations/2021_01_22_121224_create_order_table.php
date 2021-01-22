<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->bigInteger('order_no');
            $table->uuid('shipping_code');
            $table->integer('total_price');
            $table->foreignId('users_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->index('product_id');
            $table->index('users_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
