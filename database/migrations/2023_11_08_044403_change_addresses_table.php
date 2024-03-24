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
        // drop foreign key
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign('addresses_customer_id_foreign');
        });
        // drop foreign key
        Schema::table('order', function (Blueprint $table) {
            $table->dropForeign('order_address_id_foreign');
            $table->dropColumn('address_id');
        });
        // drop table addresses
        Schema::dropIfExists('addresses');
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->noActionOnDelete();
            $table->string('line1');
            $table->string('line2')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('zip');
            $table->timestamps();
        });
        // add foreign key
        Schema::table('order', function (Blueprint $table) {
            $table->foreignId('address_id')->constrained('addresses')->nullable()->noActionOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
