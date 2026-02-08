<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sku;
use App\Models\AttributeValue;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSkuSeeder extends Seeder
{
    public function run()
    {
        $admin = User::first() ?? User::factory()->create();
        $sofaCategory = Category::where('category_name', 'Sofa')->first();
        $tableCategory = Category::where('category_name', 'Table')->first();

        // 1. Sofa Minimalis
        $sofa = Product::create([
            'user_id' => $admin->id,
            'category_id' => $sofaCategory->category_id,
            'product_name' => 'Sofa Minimalis Modern',
            'product_rating' => '4.8',
            'product_short_description' => 'A comfortable and stylish sofa for your modern living room.',
            'product_long_description' => 'Our Sofa Minimalis Modern is designed with premium aesthetics and comfort in mind. Built with solid frames and high-density foam.',
            'product_type' => 'Variation',
            'product_vendor' => 'JumpStart Internal',
            'product_tags' => 'sofa,minimalist,livingroom',
            'product_image' => 'products/sofa-placeholder.jpg',
            'product_shipping_and_return' => 'Free shipping within 10km. 7-day return policy.',
        ]);

        // Variants for Sofa
        $colors = ['Carbon Grey', 'Royal Blue'];
        $materials = ['Velvet Fabric', 'Premium Leather'];

        foreach ($colors as $color) {
            foreach ($materials as $material) {
                $colorVal = AttributeValue::where('attribute_value_name', $color)->first();
                $materialVal = AttributeValue::where('attribute_value_name', $material)->first();

                $sku = Sku::create([
                    'product_id' => $sofa->product_id,
                    'sku_code' => 'SOFA-MIN-' . strtoupper(substr($color, 0, 3)) . '-' . strtoupper(substr($material, 0, 3)),
                    'sku_price' => $material === 'Premium Leather' ? 5500000 : 3500000,
                    'sku_stock' => rand(5, 20),
                    'sku_weight' => 45.00,
                    'sku_dimensions' => ['length' => 200, 'width' => 90, 'height' => 85],
                ]);

                $sku->attributeValues()->attach([$colorVal->attribute_value_id, $materialVal->attribute_value_id]);
            }
        }

        // 2. Meja Makan Kayu Jati
        $table = Product::create([
            'user_id' => $admin->id,
            'category_id' => $tableCategory->category_id,
            'product_name' => 'Meja Makan Kayu Jati Solid',
            'product_rating' => '4.9',
            'product_short_description' => 'Premium dining table made from high-quality teak wood.',
            'product_long_description' => 'Handcrafted solid teak wood table with a natural finish. Perfect for family gatherings.',
            'product_type' => 'Variation',
            'product_vendor' => 'JumpStart Artisan',
            'product_tags' => 'table,dining,teakwood',
            'product_image' => 'products/table-placeholder.jpg',
            'product_shipping_and_return' => 'Includes professional assembly. No returns for custom sizes.',
        ]);

        $oakVal = AttributeValue::where('attribute_value_name', 'Oak Natural')->first();
        $teakVal = AttributeValue::where('attribute_value_name', 'Teak Wood')->first();

        $skuTable = Sku::create([
            'product_id' => $table->product_id,
            'sku_code' => 'TBL-TEAK-NAT',
            'sku_price' => 7500000,
            'sku_stock' => 5,
            'sku_weight' => 60.00,
            'sku_dimensions' => ['length' => 180, 'width' => 90, 'height' => 75],
        ]);

        $skuTable->attributeValues()->attach([$oakVal->attribute_value_id, $teakVal->attribute_value_id]);
    }
}
