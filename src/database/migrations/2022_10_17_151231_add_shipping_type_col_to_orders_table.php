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
        Schema::table('orders', function (Blueprint $table) {
            // $table->foreignId('shipping_type_id')->after('user_payment_type_id')->default(0)->constrained('shipping_types')->onDelete('cascade');
            $table->unsignedBigInteger('shipping_type_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['shipping_type_id']);
            $table->dropColumn('shipping_type_id');
        });
    }
};
