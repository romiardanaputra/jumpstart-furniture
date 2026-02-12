<?php

namespace Database\Seeders;

use App\Models\ShippingRate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingRateSeeder extends Seeder
{
    public function run()
    {
        DB::table('shipping_rates')->delete();
        ShippingRate::factory()->count(5)->create();
    }
}
