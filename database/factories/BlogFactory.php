<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public $blog_image = ['blog-minimalis-desk.png', 'blog-purple-soffa.png', 'blog-white-soffa.png'];

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'blog_category_id' => BlogCategory::factory(),
            'blog_title' => $this->faker->sentence(),
            'blog_tags' => implode(',', $this->faker->words(5)),
            'blog_long_description' => $this->faker->paragraphs(5, true),
            'blog_image' => $this->faker->randomElement($this->blog_image),
            'meta_description' => $this->faker->sentence(),
            'related_products' => [],
        ];
    }
}
