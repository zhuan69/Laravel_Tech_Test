<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('order_id')->constrained();
            $table->boolean('payment_status');
            $table->index('order_id');
        });
    }
    public function down()
    {
        Schema::dropIfExists('paymanets');
    }
}
