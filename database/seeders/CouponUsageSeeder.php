<?php

namespace Database\Seeders;

use App\Models\CouponUsage;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Checkout;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponUsageSeeder extends Seeder
{
    public function run()
    {
        DB::table('coupon_usages')->delete();
        
        $coupons = Coupon::all();
        $users = User::all();
        $checkouts = Checkout::all();

        for ($i = 0; $i < 30; $i++) {
            CouponUsage::create([
                'coupon_id' => $coupons->random()->coupon_id,
                'user_id' => $users->random()->id,
                'order_id' => $checkouts->isNotEmpty() ? $checkouts->random()->checkout_id : null,
            ]);
        }
    }
}
