<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('products_id')->constrained('products');
            $table->unsignedBigInteger('size_id');
            $table->foreign('size_id')->references('id')->on('size_quantities');
            $table->foreignId('order_id')->nullable()->constrained('order');
            $table->integer('quantity');
            $table->boolean('payment_status')->default(false);
            $table->dateTime('checked_out_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};