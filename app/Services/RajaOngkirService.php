<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RajaOngkirService extends BaseService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('rajaongkir.api_key') ?? 'mock_key';
        $this->baseUrl = config('rajaongkir.base_url') ?? 'http://mock.api';
    }

    /**
     * Get list of cities from Local Mockup
     */
    public function getCities()
    {
        return [
            ['city_id' => '114', 'city_name' => 'Denpasar', 'type' => 'Kota', 'province_id' => '1', 'province' => 'Bali'],
            ['city_id' => '17', 'city_name' => 'Badung', 'type' => 'Kabupaten', 'province_id' => '1', 'province' => 'Bali'],
            ['city_id' => '151', 'city_name' => 'Jakarta Barat', 'type' => 'Kota', 'province_id' => '6', 'province' => 'DKI Jakarta'],
            ['city_id' => '152', 'city_name' => 'Jakarta Pusat', 'type' => 'Kota', 'province_id' => '6', 'province' => 'DKI Jakarta'],
            ['city_id' => '153', 'city_name' => 'Jakarta Selatan', 'type' => 'Kota', 'province_id' => '6', 'province' => 'DKI Jakarta'],
            ['city_id' => '154', 'city_name' => 'Jakarta Timur', 'type' => 'Kota', 'province_id' => '6', 'province' => 'DKI Jakarta'],
            ['city_id' => '155', 'city_name' => 'Jakarta Utara', 'type' => 'Kota', 'province_id' => '6', 'province' => 'DKI Jakarta'],
            ['city_id' => '444', 'city_name' => 'Surabaya', 'type' => 'Kota', 'province_id' => '11', 'province' => 'Jawa Timur'],
            ['city_id' => '23', 'city_name' => 'Bandung', 'type' => 'Kota', 'province_id' => '9', 'province' => 'Jawa Barat'],
            ['city_id' => '255', 'city_name' => 'Medan', 'type' => 'Kota', 'province_id' => '34', 'province' => 'Sumatera Utara'],
            ['city_id' => '128', 'city_name' => 'Makassar', 'type' => 'Kota', 'province_id' => '28', 'province' => 'Sulawesi Selatan'],
            ['city_id' => '501', 'city_name' => 'Yogyakarta', 'type' => 'Kota', 'province_id' => '10', 'province' => 'DI Yogyakarta'],
            ['city_id' => '399', 'city_name' => 'Semarang', 'type' => 'Kota', 'province_id' => '10', 'province' => 'Jawa Tengah'],
        ];
    }

    /**
     * Calculate shipping cost (Local Logic)
     */
    public function calculateCost(int $destination, int $weight, string $courier)
    {
        $weightInKg = max(1, ceil($weight / 1000));
        $baseRate = 15000; // Standard rate for JNE Reguler
        
        // Simple zone-based logic from Denpasar (114)
        if ($destination == 114 || $destination == 17) {
            $baseRate = 8000; // Bali local
        } elseif ($destination >= 151 && $destination <= 155) {
            $baseRate = 22000; // Jakarta
        } elseif ($destination == 444) {
            $baseRate = 18000; // Surabaya
        } elseif ($destination == 501) {
            $baseRate = 20000; // Yogyakarta
        }

        // Adjust based on courier
        $multiplier = 1.0;
        if (strtolower($courier) == 'pos') $multiplier = 0.8;
        if (strtolower($courier) == 'tiki') $multiplier = 1.1;

        $finalValue = (int)($baseRate * $weightInKg * $multiplier);

        // Return structure that mimics RajaOngkir API
        return [
            [
                'code' => strtolower($courier),
                'name' => strtoupper($courier) . ' Local Service',
                'costs' => [
                    [
                        'service' => 'REG',
                        'description' => 'Regular Service (Mock)',
                        'cost' => [
                            ['value' => $finalValue, 'etd' => '2-3', 'note' => '']
                        ]
                    ]
                ]
            ]
        ];
    }
}
