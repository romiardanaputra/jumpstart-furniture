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
        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->id('rate_id');
            $table->unsignedInteger('origin_city_id')->comment('RajaOngkir City ID');
            $table->unsignedInteger('destination_city_id')->comment('RajaOngkir City ID');
            $table->string('courier_code')->default('jne');
            $table->decimal('base_rate', 15, 2)->default(0);
            $table->decimal('free_shipping_threshold', 15, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['origin_city_id', 'destination_city_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_rates');
    }
};
