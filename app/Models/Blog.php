<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = 'blogs';

    protected $primaryKey = 'blog_id';

    protected $guarded = 'blog_id';

    protected $fillable = [
        'user_id',
        'blog_title',
        'blog_image',
        'blog_tags',
        'blog_long_description',
    ];
}
