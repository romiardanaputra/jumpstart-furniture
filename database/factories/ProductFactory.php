<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public $image = ['red-chair.png', 'white-vas.png', 'blue-thin-vas.png', 'cream-table-ratan.png', 'grey-mini-chair.png'];

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'product_name' => $this->faker->words(3, true),
            'product_rating' => $this->faker->numberBetween(4, 5),
            'product_price' => $this->faker->numberBetween(50, 2000),
            'product_short_description' => $this->faker->sentence(10),
            'product_type' => $this->faker->word(),
            'product_sku' => strtoupper($this->faker->bothify('???-####')),
            'product_vendor' => 'JumpStart',
            'product_availability' => 'ready on stock',
            'product_tags' => implode(',', $this->faker->words(3)),
            'product_color' => $this->faker->safeColorName(),
            'product_material' => $this->faker->randomElement(['Wood', 'Metal', 'Fabric', 'Plastic', 'Glass']),
            'product_long_description' => $this->faker->paragraphs(3, true),
            'product_shipping_and_return' => $this->faker->sentence(15),
            'product_discount' => $this->faker->numberBetween(0, 30),
            'product_image' => $this->faker->randomElement($this->image),
        ];
    }
}
