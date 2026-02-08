<?php

namespace App\Contracts\Services;

use App\Models\Coupon;

interface CouponServiceInterface
{
    /**
     * @return array ['valid' => bool, 'coupon' => ?Coupon, 'message' => string]
     */
    public function validateCoupon(string $code, int $userId, float $orderTotal): array;
    public function applyCoupon(int $userId, int $couponId, ?int $orderId = null): bool;
}
