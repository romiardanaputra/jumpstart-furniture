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
        Schema::create('attribute_value_sku', function (Blueprint $table) {
            $table->foreignId('sku_id')->constrained('skus', 'sku_id')->onDelete('cascade');
            $table->foreignId('attribute_value_id')->constrained('attribute_values', 'attribute_value_id')->onDelete('cascade');
            $table->primary(['sku_id', 'attribute_value_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_value_sku');
    }
};
