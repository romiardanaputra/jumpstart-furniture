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
        'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&q=80&w=800', // Cozy Living Room
        'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&q=80&w=800', // Modern Interior
        'https://images.unsplash.com/photo-1615873968403-89e068629275?auto=format&fit=crop&q=80&w=800', // Minimalist Design
        'https://images.unsplash.com/photo-1631679706909-1844bbd07221?auto=format&fit=crop&q=80&w=800', // Bedroom Concept
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
