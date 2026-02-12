<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            BlogCategorySeeder::class,
            CouponSeeder::class,
            ShippingRateSeeder::class,
            ProductSeeder::class,
            SkuSeeder::class,
            BlogSeeder::class,
            CartSeeder::class,
            CheckoutSeeder::class,
            CouponUsageSeeder::class,
            ReviewSeeder::class,
            WishlistSeeder::class,
        ]);
    }
}
