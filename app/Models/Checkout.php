<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class, 'sku_id', 'sku_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    protected $table = 'checkouts';

    protected $primaryKey = 'checkout_id';

    protected $guarded = 'checkout_id';

    protected $fillable = [
        'user_id',
        'product_id',
        'sku_id',
        'cart_id',
        'shipping_address',
        'shipping_price',
        'shipping_method',
        'payment_status',
        'payment_total_per_item',
        'stripe_charge_id',
        'xendit_invoice_id',
        'xendit_external_id',
    ];
}
