<?php

return [
    'api_key' => env('RAJAONGKIR_API_KEY'),
    'base_url' => env('RAJAONGKIR_BASE_URL', 'https://api.rajaongkir.com/starter'),
    'origin' => env('RAJAONGKIR_ORIGIN', '114'), // Default to Denpasar city ID in RajaOngkir
];
