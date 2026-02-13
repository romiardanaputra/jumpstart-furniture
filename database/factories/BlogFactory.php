<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public $blog_image_urls = [
        'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&q=80&w=1200', // Cozy Living Room
        'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&q=80&w=1200', // Modern Interior
        'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&q=80&w=1200', // Minimalist Design
        'https://images.unsplash.com/photo-1631679706909-1844bbd07221?auto=format&fit=crop&q=80&w=1200', // Bedroom Concept
        'https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&q=80&w=1200', // Modern Office
        'https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?auto=format&fit=crop&q=80&w=1200', // Scandinavian Furniture
        'https://images.unsplash.com/photo-1540518614846-7eded433c457?auto=format&fit=crop&q=80&w=1200', // Zen Bedroom
        'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&q=80&w=1200', // Designer Sofa
        'https://images.unsplash.com/photo-1503602642458-232111445657?auto=format&fit=crop&q=80&w=1200', // Artisan Chair
        'https://images.unsplash.com/photo-1503602642458-232111445657?auto=format&fit=crop&q=80&w=1200', // Minimalist Working Space
    ];

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'blog_category_id' => BlogCategory::factory(),
            'blog_title' => $this->faker->sentence(),
            'blog_tags' => implode(',', $this->faker->words(5)),
            'blog_long_description' => $this->faker->paragraphs(5, true),
            'blog_image' => $this->faker->randomElement($this->blog_image_urls),
            'meta_description' => $this->faker->sentence(),
            'related_products' => [],
        ];
    }
}
