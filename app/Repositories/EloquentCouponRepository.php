<?php

namespace App\Repositories;

use App\Contracts\Repositories\CouponRepositoryInterface;
use App\Models\Coupon;
use App\Models\CouponUsage;

class EloquentCouponRepository implements CouponRepositoryInterface
{
    public function findByCode(string $code): ?Coupon
    {
        return Coupon::where('code', $code)->first();
    }

    public function incrementUsage(int $couponId): bool
    {
        return Coupon::where('coupon_id', $couponId)->increment('used_count');
    }

    public function getUsageCountForUser(int $couponId, int $userId): int
    {
        return CouponUsage::where('coupon_id', $couponId)
            ->where('user_id', $userId)
            ->count();
    }
}
