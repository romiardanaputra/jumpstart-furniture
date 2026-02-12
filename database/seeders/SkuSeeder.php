<?php

namespace Database\Seeders;

use App\Models\Sku;
use App\Models\Product;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkuSeeder extends Seeder
{
    public function run()
    {
        DB::table('skus')->delete();
        DB::table('attribute_value_sku')->delete();
        
        $products = Product::all();
        $attributeValues = AttributeValue::all();

        foreach ($products as $product) {
            // Each product gets 1-3 SKUs
            $skus = Sku::factory()->count(rand(1, 3))->create([
                'product_id' => $product->product_id,
            ]);

            foreach ($skus as $sku) {
                // Attach 1-2 random attribute values (e.g., a Color and a Material)
                $randomValues = $attributeValues->random(rand(1, 2))->pluck('attribute_value_id');
                $sku->attributeValues()->attach($randomValues);
            }
        }
    }
}
