<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'parent_id',
        'category_name',
        'category_slug',
        'category_image',
        'category_description',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'category_id', 'category_id');
    }
}
