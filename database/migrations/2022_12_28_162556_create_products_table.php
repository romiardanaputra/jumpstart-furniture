<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('product_name');
            $table->string('product_rating', 5)->default('0');
            $table->bigInteger('product_price');
            $table->string('product_short_description', 1000)->nullable();
            $table->string('product_type');
            $table->string('product_sku');
            $table->string('product_vendor');
            $table->string('product_availability');
            $table->string('product_tags');
            $table->string('product_color');
            $table->string('product_material');
            $table->string('product_long_description', 2000);
            $table->string('product_shipping_and_return');
            $table->string('product_image');
            $table->string('product_discount');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
