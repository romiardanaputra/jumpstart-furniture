<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $guarded = ['product_id'];

    protected $fillable = [
        'user_id',
        'category_id',
        'product_name',
        'product_rating',
        'product_price',
        'product_short_description',
        'product_type',
        'product_sku',
        'product_vendor',
        'product_availability',
        'product_tags',
        'product_color',
        'product_material',
        'product_long_description',
        'product_shipping_and_return',
        'product_image',
        'product_discount',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function skus()
    {
        return $this->hasMany(Sku::class, 'product_id', 'product_id');
    }
}
