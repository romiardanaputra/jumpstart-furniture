<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Sku;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'sku_id' => Sku::factory(),
            'user_id' => User::factory(),
            'total_price' => $this->faker->numberBetween(100, 5000),
            'quantity' => $this->faker->numberBetween(1, 5),
            'special_instruction' => $this->faker->sentence(),
        ];
    }
}
