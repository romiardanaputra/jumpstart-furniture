<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $primaryKey = 'attribute_value_id';

    protected $fillable = [
        'attribute_id',
        'attribute_value_name',
        'attribute_value_slug',
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id', 'attribute_id');
    }

    public function skus()
    {
        return $this->belongsToMany(Sku::class, 'attribute_value_sku', 'attribute_value_id', 'sku_id');
    }
}
