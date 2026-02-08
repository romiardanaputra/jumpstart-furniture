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
        Schema::table('checkouts', function (Blueprint $table) {
            // Drop the existing foreign key
            // Note: The constraint name might vary, but in Laravel it's usually table_column_foreign
            $table->dropForeign(['cart_id']);
            
            // Add it back without CASCADE
            $table->foreign('cart_id')
                ->references('cart_id')
                ->on('carts')
                ->onDelete('restrict'); 
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
            $table->foreign('cart_id')
                ->references('cart_id')
                ->on('carts')
                ->onDelete('cascade');
        });
    }
};
