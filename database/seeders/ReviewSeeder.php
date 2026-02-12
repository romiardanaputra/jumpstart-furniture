<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        DB::table('reviews')->delete();
        
        $products = Product::all();
        $users = User::all();

        foreach ($products as $product) {
            // Each product gets 0-3 reviews
            $count = rand(0, 3);
            for ($i = 0; $i < $count; $i++) {
                Review::factory()->create([
                    'product_id' => $product->product_id,
                    'user_id' => $users->random()->id,
                ]);
            }
        }
    }
}
