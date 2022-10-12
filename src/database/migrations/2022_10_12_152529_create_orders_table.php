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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('user_payment_type_id')->nullable()->constrained('user_payment_types')->onDelete('cascade');
            $table->string('number');
            $table->string('status')->default('Created');
            $table->string('shipping_type')->nullable();
            $table->float('shipping_cost', 6, 2)->default(0);
            $table->float('total_for_items', 8, 2)->default(0);
            $table->float('total', 8, 2)->default(0);
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
        Schema::dropIfExists('orders');
    }
};
