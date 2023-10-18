<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('order_id')->index();
            $table->string('name');
            $table->string('email');
            $table->enum('status', ['NEW', 'FULLFILLED']);
            $table->enum('shipping_type', ['PICK_UP_AT_STORE', 'COURIER_SHIPPING']);
            $table->string('shipping_name');
            $table->string('shipping_postcode');
            $table->string('shipping_city');
            $table->string('shipping_address');
            $table->string('billing_name');
            $table->string('billing_postcode');
            $table->string('billing_city');
            $table->string('billing_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
