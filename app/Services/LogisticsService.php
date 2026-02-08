<?php

namespace App\Services;

use App\Contracts\Services\LogisticsServiceInterface;
use App\Models\ShippingRate;
use Illuminate\Support\Facades\Log;

class LogisticsService extends BaseService implements LogisticsServiceInterface
{
    protected RajaOngkirService $rajaOngkir;

    /**
     * Formula for volumetric weight in Indonesia (standard)
     */
    protected const VOLUMETRIC_DIVISOR = 6000;

    public function __construct(RajaOngkirService $rajaOngkir)
    {
        $this->rajaOngkir = $rajaOngkir;
    }

    public function calculateShippingRate(string $destination, float $weight, string $courier): float
    {
        // 1. Check for Local Overrides first (Enterprise Logic)
        $localRate = ShippingRate::where('destination_city_id', $destination)
            ->where('courier_code', strtolower($courier))
            ->where('is_active', true)
            ->first();

        if ($localRate) {
            // Check for free shipping threshold
            if ($localRate->free_shipping_threshold && $this->calculateOrderTotalForShipping() >= $localRate->free_shipping_threshold) {
                return 0;
            }
            
            return ceil($weight) * $localRate->base_rate;
        }

        // 2. Fallback to RajaOngkir API if destination is numeric (City ID)
        if (is_numeric($destination)) {
            $results = $this->rajaOngkir->calculateCost((int)$destination, (int)($weight * 1000), $courier);
            
            if (!empty($results)) {
                $costs = $results[0]['costs'] ?? [];
                foreach ($costs as $cost) {
                    // Default to first service for now (usually the cheapest/standard)
                    return (float)$cost['cost'][0]['value'];
                }
            }
        }

        // 3. Ultimate Fallback (Mock)
        $ratePerKg = 15000;
        return ceil($weight) * $ratePerKg;
    }

    public function getAvailableCouriers(string $destination): array
    {
        // In Starter RajaOngkir, only jne, pos, tiki are supported
        return [
            ['code' => 'jne', 'name' => 'JNE Reguler', 'base_rate' => 15000],
            ['code' => 'pos', 'name' => 'POS Kilat Khusus', 'base_rate' => 12000],
            ['code' => 'tiki', 'name' => 'TIKI ONS', 'base_rate' => 14000],
        ];
    }

    protected function calculateOrderTotalForShipping(): float
    {
        // This would normally come from the CartService
        // Injecting it here might cause circular dependency, so we use a simple approach
        return app(\App\Contracts\Repositories\CartRepositoryInterface::class)->calculateTotal(auth()->id());
    }

    public function calculateVolumetricWeight(float $length, float $width, float $height): float
    {
        if ($length <= 0 || $width <= 0 || $height <= 0) {
            return 0;
        }

        return ($length * $width * $height) / self::VOLUMETRIC_DIVISOR;
    }

    public function getChargableWeight(float $actualWeight, float $length, float $width, float $height): float
    {
        $volumetric = $this->calculateVolumetricWeight($length, $width, $height);
        
        return max($actualWeight, $volumetric);
    }
}
