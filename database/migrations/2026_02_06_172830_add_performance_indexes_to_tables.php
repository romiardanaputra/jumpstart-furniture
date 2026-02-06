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
        // Products table indexes
        Schema::table('products', function (Blueprint $table) {
            $table->index('product_type', 'idx_products_type');
            $table->index('product_vendor', 'idx_products_vendor');
            $table->index('product_availability', 'idx_products_availability');
            $table->index(['product_type', 'product_availability'], 'idx_products_type_availability');
        });

        // Carts table indexes
        Schema::table('carts', function (Blueprint $table) {
            $table->index('user_id', 'idx_carts_user_id');
            $table->index('product_id', 'idx_carts_product_id');
            $table->index(['user_id', 'product_id'], 'idx_carts_user_product');
        });

        // Checkouts table indexes and idempotency column
        Schema::table('checkouts', function (Blueprint $table) {
            $table->string('idempotency_key', 64)->nullable()->unique()->after('payment_status');
            $table->index('user_id', 'idx_checkouts_user_id');
            $table->index('payment_status', 'idx_checkouts_payment_status');
            $table->index(['user_id', 'payment_status'], 'idx_checkouts_user_status');
        });

        // Users table indexes (for role-based queries)
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->index('role', 'idx_users_role');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_type');
            $table->dropIndex('idx_products_vendor');
            $table->dropIndex('idx_products_availability');
            $table->dropIndex('idx_products_type_availability');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->dropIndex('idx_carts_user_id');
            $table->dropIndex('idx_carts_product_id');
            $table->dropIndex('idx_carts_user_product');
        });

        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropColumn('idempotency_key');
            $table->dropIndex('idx_checkouts_user_id');
            $table->dropIndex('idx_checkouts_payment_status');
            $table->dropIndex('idx_checkouts_user_status');
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropIndex('idx_users_role');
            }
        });
    }
};

