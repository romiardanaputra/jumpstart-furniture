<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $blog_image = ['blog-minimalis-desk.png', 'blog-purple-soffa.png', 'blog-white-soffa.png'];

    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement([1]),
            'blog_title' => $this->faker->sentence(4),
            'blog_tags' => $this->faker->sentence(6),
            'blog_long_description' => $this->faker->paragraph(10),
            'blog_image' => 'blog_image/'.$this->faker->randomElement($this->blog_image),
        ];
    }
}
