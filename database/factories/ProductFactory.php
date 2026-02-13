<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public $image_urls = [
        'https://images.unsplash.com/photo-1592078615290-033ee584e267?auto=format&fit=crop&q=80&w=800', // Modern Chair
        'https://images.unsplash.com/photo-1567016432779-094069958ea5?auto=format&fit=crop&q=80&w=800', // Sofa
        'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&q=80&w=800', // Desk
        'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&q=80&w=800', // Modern Green Sofa
        'https://images.unsplash.com/photo-1581539250439-c96689b516dd?auto=format&fit=crop&q=80&w=800', // Chair Detail
        'https://images.unsplash.com/photo-1538688525198-9b88f6f53126?auto=format&fit=crop&q=80&w=800', // Minimalist Chair
    ];

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'product_name' => $this->faker->words(3, true),
            'product_rating' => $this->faker->numberBetween(4, 5),
            'product_price' => $this->faker->numberBetween(50000, 5000000), // Adjusted for IDR
            'product_short_description' => $this->faker->sentence(10),
            'product_type' => $this->faker->word(),
            'product_sku' => strtoupper($this->faker->bothify('???-####')),
            'product_vendor' => 'JumpStart',
            'product_availability' => 'ready on stock',
            'product_tags' => implode(',', $this->faker->words(3)),
            'product_color' => $this->faker->safeColorName(),
            'product_material' => $this->faker->randomElement(['Solid Wood', 'Velvet', 'Leather', 'Steel', 'Rattan']),
            'product_long_description' => $this->faker->paragraphs(3, true),
            'product_shipping_and_return' => $this->faker->sentence(15),
            'product_discount' => $this->faker->numberBetween(0, 30),
            'product_image' => $this->faker->randomElement($this->image_urls),
        ];
    }
}
