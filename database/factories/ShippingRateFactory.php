<?php

namespace Database\Factories;

use App\Models\ShippingRate;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingRateFactory extends Factory
{
    protected $model = ShippingRate::class;

    public function definition()
    {
        return [
            'origin_city_id' => $this->faker->numberBetween(1, 500),
            'destination_city_id' => $this->faker->numberBetween(1, 500),
            'courier_code' => $this->faker->randomElement(['jne', 'pos', 'tiki']),
            'base_rate' => $this->faker->numberBetween(10000, 50000),
            'free_shipping_threshold' => $this->faker->randomElement([null, 200000, 500000]),
            'is_active' => true,
        ];
    }
}
