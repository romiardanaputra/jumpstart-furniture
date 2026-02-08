<?php

namespace App\Contracts\Services;

interface LogisticsServiceInterface
{
    /**
     * Calculate shipping rate based on destination and weight
     */
    public function calculateShippingRate(string $destination, float $weight, string $courier): float;

    /**
     * Get available couriers for a destination
     */
    public function getAvailableCouriers(string $destination): array;

    /**
     * Calculate volumetric weight based on dimensions
     * Formula: (L x W x H) / 6000
     */
    public function calculateVolumetricWeight(float $length, float $width, float $height): float;

    /**
     * Get chargable weight (greater of actual vs volumetric)
     */
    public function getChargableWeight(float $actualWeight, float $length, float $width, float $height): float;
}
