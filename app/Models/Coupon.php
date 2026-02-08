<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $primaryKey = 'coupon_id';

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_amount',
        'usage_limit',
        'usage_limit_per_user',
        'used_count',
        'starts_at',
        'expires_at',
        'is_active'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'value' => 'float',
        'min_order_amount' => 'float',
    ];

    public function usages()
    {
        return $this->hasMany(CouponUsage::class, 'coupon_id', 'coupon_id');
    }

    public function isValidForOrder(float $orderTotal): bool
    {
        if (!$this->is_active) return false;

        $now = now();
        if ($this->starts_at && $now->lt($this->starts_at)) return false;
        if ($this->expires_at && $now->gt($this->expires_at)) return false;

        if ($this->usage_limit && $this->used_count >= $this->usage_limit) return false;

        if ($orderTotal < $this->min_order_amount) return false;

        return true;
    }

    public function calculateDiscount(float $orderTotal): float
    {
        if ($this->type === 'percentage') {
            return ($orderTotal * $this->value) / 100;
        }

        return min($this->value, $orderTotal);
    }
}
