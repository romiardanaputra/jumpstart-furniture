<?php

namespace Database\Factories;

use App\Models\Sku;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkuFactory extends Factory
{
    protected $model = Sku::class;

    public function definition()
    {
        $price = $this->faker->numberBetween(50, 2000);
        return [
            'product_id' => Product::factory(),
            'sku_code' => strtoupper($this->faker->unique()->bothify('SKU-####-????')),
            'sku_price' => $price,
            'sku_stock' => $this->faker->numberBetween(10, 100),
            'low_stock_threshold' => 5,
            'sku_weight' => $this->faker->randomFloat(2, 1, 50),
            'sku_dimensions' => [
                'length' => $this->faker->numberBetween(10, 200),
                'width' => $this->faker->numberBetween(10, 200),
                'height' => $this->faker->numberBetween(10, 200),
                'unit' => 'cm'
            ],
        ];
    }
}
