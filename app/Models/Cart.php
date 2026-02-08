<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Checkout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $primaryKey = 'cart_id';

    protected $fillable = [
        'product_id',
        'sku_id',
        'user_id',
        'total_price',
        'quantity',
        'special_instruction',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class, 'sku_id', 'sku_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function checkout()
    {
        return $this->hasOne(Checkout::class, 'checkout_id', 'checkout_id');
    }
}
