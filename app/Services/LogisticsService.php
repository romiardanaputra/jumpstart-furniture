<?php

namespace App\Services;

use App\Contracts\Services\LogisticsServiceInterface;

class LogisticsService extends BaseService implements LogisticsServiceInterface
{
    /**
     * Formula for volumetric weight in Indonesia (standard)
     */
    protected const VOLUMETRIC_DIVISOR = 6000;

    /**
     * Mock rates per KG for different couriers (in Rp)
     */
    protected array $mockRates = [
        'jne' => 15000,
        'pos' => 12000,
        'tiki' => 14000,
    ];

    public function calculateShippingRate(string $destination, float $weight, string $courier): float
    {
        $ratePerKg = $this->mockRates[strtolower($courier)] ?? 15000;
        
        // Dynamic multiplier for destination (mock)
        $destinationMultiplier = $this->getDestinationMultiplier($destination);
        
        return ceil($weight) * $ratePerKg * $destinationMultiplier;
    }

    public function getAvailableCouriers(string $destination): array
    {
        return [
            ['code' => 'jne', 'name' => 'JNE Reguler', 'base_rate' => 15000],
            ['code' => 'pos', 'name' => 'POS Kilat Khusus', 'base_rate' => 12000],
            ['code' => 'tiki', 'name' => 'TIKI ONS', 'base_rate' => 14000],
        ];
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

    /**
     * Mock logic for destination price multipliers
     */
    protected function getDestinationMultiplier(string $destination): float
    {
        // Simple mock logic
        if (str_contains(strtolower($destination), 'jakarta') || str_contains(strtolower($destination), 'bali')) {
            return 1.0;
        }
        
        return 1.5; // Outer region
    }
}
