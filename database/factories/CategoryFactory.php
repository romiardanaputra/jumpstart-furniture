<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $name = $this->faker->unique()->randomElement([
            'Living Room', 'Bedroom', 'Kitchen', 'Dining Room', 
            'Office', 'Outdoor', 'Storage', 'Lighting', 'Decor', 'Kids'
        ]);
        
        return [
            'parent_id' => null,
            'category_name' => $name,
            'category_slug' => Str::slug($name),
            'category_image' => 'categories/sample.png',
            'category_description' => $this->faker->sentence(),
        ];
    }
}
