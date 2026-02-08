<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $image = ['UpziTKaDJryDpP2tgpndGFHX6eBzM6022EytoUA2.png', 'red-chair.png', 'white-vas.png'];

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'product_name' => $this->faker->randomElement(['watch', 'table', 'chair']),
            'product_rating' => $this->faker->randomElement([4, 5]),
            'product_price' => $this->faker->numberBetween(100, 1000),
            'product_short_description' => $this->faker->paragraph(2),
            'product_type' => $this->faker->word(2, true),
            'product_sku' => $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
            'product_vendor' => $this->faker->word(1),
            'product_availability' => $this->faker->randomElement(['ready on stock', 'not ready']),
            'product_tags' => $this->faker->word(['furniture', 'trend2022', 'cheap', 'luxury'], true),
            'product_color' => $this->faker->safeColorName(),
            'product_material' => $this->faker->word(4),
            'product_long_description' => $this->faker->paragraph(10),
            'product_shipping_and_return' => $this->faker->randomElement(['standard', 'exclusive']),
            'product_discount' => $this->faker->numberBetween(1, 12),
            'product_image' => 'product_image/'.$this->faker->randomElement($this->image),
        ];
    }
}
