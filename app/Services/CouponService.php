<?php

namespace App\Services;

use App\Contracts\Repositories\CouponRepositoryInterface;
use App\Contracts\Services\CouponServiceInterface;
use App\Models\CouponUsage;

class CouponService implements CouponServiceInterface
{
    protected CouponRepositoryInterface $couponRepository;

    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function validateCoupon(string $code, int $userId, float $orderTotal): array
    {
        $coupon = $this->couponRepository->findByCode($code);

        if (!$coupon) {
            return ['valid' => false, 'coupon' => null, 'message' => 'Invalid coupon code.'];
        }

        if (!$coupon->isValidForOrder($orderTotal)) {
            return ['valid' => false, 'coupon' => null, 'message' => 'Coupon is expired, inactive, or order total is too low.'];
        }

        // Check per-user limit
        if ($coupon->usage_limit_per_user) {
            $userUsage = $this->couponRepository->getUsageCountForUser($coupon->coupon_id, $userId);
            if ($userUsage >= $coupon->usage_limit_per_user) {
                return ['valid' => false, 'coupon' => null, 'message' => 'You have already reached the usage limit for this coupon.'];
            }
        }

        return ['valid' => true, 'coupon' => $coupon, 'message' => 'Coupon applied successfully!'];
    }

    public function applyCoupon(int $userId, int $couponId, ?int $orderId = null): bool
    {
        CouponUsage::create([
            'user_id' => $userId,
            'coupon_id' => $couponId,
            'order_id' => $orderId
        ]);

        return $this->couponRepository->incrementUsage($couponId);
    }
}
