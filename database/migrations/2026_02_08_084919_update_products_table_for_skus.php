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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('user_id')->constrained('categories', 'category_id')->onDelete('set null');
        });

        // Use native SQL for changing columns to nullable (avoids doctrine/dbal requirement in L9)
        \DB::statement('ALTER TABLE products MODIFY product_price BIGINT NULL');
        \DB::statement('ALTER TABLE products MODIFY product_sku VARCHAR(255) NULL');
        \DB::statement('ALTER TABLE products MODIFY product_color VARCHAR(255) NULL');
        \DB::statement('ALTER TABLE products MODIFY product_material VARCHAR(255) NULL');
        \DB::statement('ALTER TABLE products MODIFY product_availability VARCHAR(255) NULL');
        \DB::statement('ALTER TABLE products MODIFY product_discount VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
