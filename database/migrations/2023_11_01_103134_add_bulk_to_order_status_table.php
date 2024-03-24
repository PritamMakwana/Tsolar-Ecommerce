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
        Schema::table('order_statuses', function (Blueprint $table) {
            $table->boolean('bulk')->default(false)->after('cart_id');
        });
        Schema::table('cart', function (Blueprint $table) {
            // remove the order_status_id column and foreign key
            $table->dropForeign(['order_status_id']);
            $table->dropColumn('order_status_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_status', function (Blueprint $table) {
            //
        });
    }
};
