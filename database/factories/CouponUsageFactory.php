<?php

namespace Database\Factories;

use App\Models\CouponUsage;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponUsageFactory extends Factory
{
    protected $model = CouponUsage::class;

    public function definition()
    {
        return [
            'coupon_id' => Coupon::factory(),
            'user_id' => User::factory(),
            'used_at' => now(),
        ];
    }
}
