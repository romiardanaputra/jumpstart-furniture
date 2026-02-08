<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Drop existing foreign key (try both common names)
        try {
            DB::statement('ALTER TABLE checkouts DROP FOREIGN KEY checkouts_cart_id_foreign');
        } catch (\Exception $e) {}

        // 2. Make column nullable using raw SQL
        DB::statement('ALTER TABLE checkouts MODIFY cart_id BIGINT UNSIGNED NULL');

        // 3. Add back foreign key with SET NULL
        Schema::table('checkouts', function (Blueprint $table) {
            $table->foreign('cart_id')
                ->references('cart_id')
                ->on('carts')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropForeign(['cart_id']);
        });

        DB::statement('ALTER TABLE checkouts MODIFY cart_id BIGINT UNSIGNED NOT NULL');

        Schema::table('checkouts', function (Blueprint $table) {
            $table->foreign('cart_id')
                ->references('cart_id')
                ->on('carts')
                ->onDelete('cascade');
        });
    }
};
