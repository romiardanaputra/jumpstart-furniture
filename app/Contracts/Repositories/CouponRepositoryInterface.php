<?php

namespace App\Contracts\Repositories;

use App\Models\Coupon;

interface CouponRepositoryInterface
{
    public function findByCode(string $code): ?Coupon;
    public function incrementUsage(int $couponId): bool;
    public function getUsageCountForUser(int $couponId, int $userId): int;
}
