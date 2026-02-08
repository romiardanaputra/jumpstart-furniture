<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    use HasFactory;

    protected $primaryKey = 'rate_id';

    protected $fillable = [
        'origin_city_id',
        'destination_city_id',
        'courier_code',
        'base_rate',
        'free_shipping_threshold',
        'is_active',
    ];

    protected $casts = [
        'base_rate' => 'float',
        'free_shipping_threshold' => 'float',
        'is_active' => 'boolean',
    ];
}
