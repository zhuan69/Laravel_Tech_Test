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
            $table->bigInteger('order_no')->unique();
            $table->string('shipping_code')->nullable(true);
            $table->integer('total_price');
            $table->timestamp('order_date');
            $table->string('order_type');
            $table->foreignId('users_id')->constrained();
            $table->foreignId('topup_id')->constrained('topup_history')->nullable(true);
            $table->foreignId('product_id')->constrained()->nullable(true);
            $table->index('product_id');
            $table->index('topup_id');
            $table->index('users_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
