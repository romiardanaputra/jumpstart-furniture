<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RajaOngkirService extends BaseService
{
    protected string $apiKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('rajaongkir.api_key');
        $this->baseUrl = config('rajaongkir.base_url');
    }

    /**
     * Get list of cities from RajaOngkir
     */
    public function getCities()
    {
        try {
            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->get($this->baseUrl . '/city');

            if ($response->successful()) {
                return $response->json()['rajaongkir']['results'] ?? [];
            }

            Log::error('RajaOngkir API Error (Cities)', ['response' => $response->body()]);
            return [];
        } catch (\Exception $e) {
            Log::error('RajaOngkir Request Exception (Cities)', ['message' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Calculate shipping cost
     */
    public function calculateCost(int $destination, int $weight, string $courier)
    {
        try {
            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->post($this->baseUrl . '/cost', [
                'origin' => config('rajaongkir.origin'),
                'destination' => $destination,
                'weight' => $weight,
                'courier' => strtolower($courier)
            ]);

            if ($response->successful()) {
                return $response->json()['rajaongkir']['results'] ?? [];
            }

            Log::error('RajaOngkir API Error (Cost)', ['response' => $response->body()]);
            return [];
        } catch (\Exception $e) {
            Log::error('RajaOngkir Request Exception (Cost)', ['message' => $e->getMessage()]);
            return [];
        }
    }
}
