<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_paid_offs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_order');
            $table->foreignId('id_user');
            $table->timestamps();

            $table->foreign('id_order')->references('id')->on('orders');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_paid_offs');
    }
};
