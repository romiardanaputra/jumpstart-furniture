<?php

namespace Database\Factories;

use App\Models\Checkout;
use App\Models\User;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckoutFactory extends Factory
{
    protected $model = Checkout::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'sku_id' => Sku::factory(),
            'cart_id' => null,
            'shipping_address' => $this->faker->address(),
            'shipping_price' => $this->faker->numberBetween(10000, 50000),
            'shipping_method' => $this->faker->randomElement(['Standard', 'Express', 'Cargo']),
            'payment_status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'failed', 'cancelled']),
            'payment_total' => $this->faker->numberBetween(100000, 5000000),
            // Removed stripe_charge_id as it doesn't exist in migrations
            'xendit_invoice_id' => 'inv_' . $this->faker->lexify('????????????'),
            'xendit_external_id' => 'ext_' . $this->faker->lexify('????????????'),
        ];
    }
}
