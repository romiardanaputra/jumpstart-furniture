<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Products table indexes - check if not exists
        $this->addIndexIfNotExists('products', 'product_type', 'idx_products_type');
        $this->addIndexIfNotExists('products', 'product_vendor', 'idx_products_vendor');
        $this->addIndexIfNotExists('products', 'product_availability', 'idx_products_availability');

        // Carts table indexes
        $this->addIndexIfNotExists('carts', 'user_id', 'idx_carts_user_id');
        $this->addIndexIfNotExists('carts', 'product_id', 'idx_carts_product_id');

        // Checkouts - add payment_status column
        if (!Schema::hasColumn('checkouts', 'payment_status')) {
            Schema::table('checkouts', function (Blueprint $table) {
                $table->string('payment_status', 50)->default('pending')->after('payment_total');
            });
        }

        // Checkouts - add idempotency_key column
        if (!Schema::hasColumn('checkouts', 'idempotency_key')) {
            Schema::table('checkouts', function (Blueprint $table) {
                $table->string('idempotency_key', 64)->nullable()->after('payment_total');
            });
        }

        // Checkouts indexes
        $this->addIndexIfNotExists('checkouts', 'user_id', 'idx_checkouts_user_id');
        $this->addIndexIfNotExists('checkouts', 'payment_status', 'idx_checkouts_payment_status');

        // Users role index
        if (Schema::hasColumn('users', 'role')) {
            $this->addIndexIfNotExists('users', 'role', 'idx_users_role');
        }
    }

    /**
     * Add index if it doesn't exist
     */
    private function addIndexIfNotExists(string $table, string $column, string $indexName): void
    {
        $indexes = collect(DB::select("SHOW INDEX FROM {$table}"))->pluck('Key_name')->toArray();
        
        if (!in_array($indexName, $indexes)) {
            Schema::table($table, function (Blueprint $table) use ($column, $indexName) {
                $table->index($column, $indexName);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes safely
        $this->dropIndexIfExists('products', 'idx_products_type');
        $this->dropIndexIfExists('products', 'idx_products_vendor');
        $this->dropIndexIfExists('products', 'idx_products_availability');
        
        $this->dropIndexIfExists('carts', 'idx_carts_user_id');
        $this->dropIndexIfExists('carts', 'idx_carts_product_id');
        
        $this->dropIndexIfExists('checkouts', 'idx_checkouts_user_id');
        $this->dropIndexIfExists('checkouts', 'idx_checkouts_payment_status');

        // Drop columns
        if (Schema::hasColumn('checkouts', 'idempotency_key')) {
            Schema::table('checkouts', function (Blueprint $table) {
                $table->dropColumn('idempotency_key');
            });
        }

        if (Schema::hasColumn('checkouts', 'payment_status')) {
            Schema::table('checkouts', function (Blueprint $table) {
                $table->dropColumn('payment_status');
            });
        }

        if (Schema::hasColumn('users', 'role')) {
            $this->dropIndexIfExists('users', 'idx_users_role');
        }
    }

    /**
     * Drop index if exists
     */
    private function dropIndexIfExists(string $table, string $indexName): void
    {
        $indexes = collect(DB::select("SHOW INDEX FROM {$table}"))->pluck('Key_name')->toArray();
        
        if (in_array($indexName, $indexes)) {
            Schema::table($table, function (Blueprint $table) use ($indexName) {
                $table->dropIndex($indexName);
            });
        }
    }
};
