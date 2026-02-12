<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition()
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('?????###')),
            'type' => $this->faker->randomElement(['fixed', 'percentage']),
            'value' => $this->faker->numberBetween(10000, 50000), // Adjusted for decimal(15,2) and realistic IDR/Amount
            'min_order_amount' => $this->faker->numberBetween(100000, 500000),
            'is_active' => true,
            'starts_at' => now(),
            'expires_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'usage_limit' => $this->faker->numberBetween(10, 1000),
            'usage_limit_per_user' => 1,
            'used_count' => 0,
        ];
    }
}
