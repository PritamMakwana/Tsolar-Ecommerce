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
        Schema::table('cart', function (Blueprint $table) {
            // remove the foreign status_id column
            $table->dropForeign(['status_id']);
            // remove the status_id column
            $table->dropColumn('status_id');
            // add the order_status column
            $table->foreignId('order_status_id')->nullable()->constrained()->onDelete('set null')->after('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            //
        });
    }
};
