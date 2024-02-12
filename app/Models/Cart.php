<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function checkout()
    {
        return $this->hasOne(Checkout::class, 'checkout_id', 'checkout_id');
    }

    protected $table = 'carts';

    protected $primaryKey = 'cart_id';

    protected $guarded = 'cart_id';

    protected $fillable = [
        'user_id',
        'product_id',
        'special_instruction',
        'quantity',
        'total_price',
    ];
}
