<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Blog extends Model
{
    use HasFactory, HasSlug;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    protected $table = 'blogs';

    protected $primaryKey = 'blog_id';

    protected $guarded = 'blog_id';

    protected $fillable = [
        'user_id',
        'blog_category_id',
        'blog_title',
        'blog_slug',
        'blog_image',
        'blog_tags',
        'blog_long_description',
        'meta_description',
        'meta_image',
        'related_products',
    ];

    protected $casts = [
        'related_products' => 'array',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('blog_title')
            ->saveSlugsTo('blog_slug');
    }
}
