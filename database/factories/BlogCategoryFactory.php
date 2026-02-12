<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogCategoryFactory extends Factory
{
    protected $model = BlogCategory::class;

    public function definition()
    {
        $name = $this->faker->unique()->randomElement([
            'Interior Design', 'Furniture Care', 'Living Trends', 
            'DIY Projects', 'Sustainable Living', 'Modern Architecture'
        ]);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(),
        ];
    }
}
