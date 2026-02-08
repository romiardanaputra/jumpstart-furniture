<?php

namespace Database\Seeders;

use App\Models\ShippingRate;
use Illuminate\Database\Seeder;

class ShippingRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rates = [
            [
                'origin_city_id' => 114, // Denpasar
                'destination_city_id' => 151, // Jakarta City
                'courier_code' => 'jne',
                'base_rate' => 20000,
                'free_shipping_threshold' => 5000000, // Free shipping if spend > 5jt
                'is_active' => true,
            ],
            [
                'origin_city_id' => 114, // Denpasar
                'destination_city_id' => 23, // Bandung City
                'courier_code' => 'jne',
                'base_rate' => 25000,
                'free_shipping_threshold' => 7000000,
                'is_active' => true,
            ],
            [
                'origin_city_id' => 114, // Denpasar
                'destination_city_id' => 444, // Surabaya
                'courier_code' => 'jne',
                'base_rate' => 15000,
                'free_shipping_threshold' => 3000000,
                'is_active' => true,
            ],
        ];

        foreach ($rates as $rate) {
            ShippingRate::create($rate);
        }
    }
}
