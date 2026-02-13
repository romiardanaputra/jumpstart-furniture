<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    public function run()
    {
        DB::table('wishlists')->delete();
        
        $users = User::all();
        $products = Product::all();

        foreach ($users as $user) {
            $count = min(rand(1, 5), $products->count());
            $randomProducts = $products->random($count);

            foreach ($randomProducts as $product) {
                Wishlist::factory()->create([
                    'user_id' => $user->id,
                    'product_id' => $product->product_id,
                ]);
            }
        }
    }
}
