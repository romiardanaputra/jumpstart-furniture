<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;

    protected $primaryKey = 'sku_id';

    protected $fillable = [
        'product_id',
        'sku_code',
        'sku_price',
        'sku_stock',
        'low_stock_threshold',
        'sku_weight',
        'sku_dimensions',
    ];

    protected $casts = [
        'sku_dimensions' => 'array',
        'sku_price' => 'integer',
        'sku_stock' => 'integer',
        'low_stock_threshold' => 'integer',
        'sku_weight' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'attribute_value_sku', 'sku_id', 'attribute_value_id');
    }
}
