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
            $count = rand(0, 5);
            for ($i = 0; $i < $count; $i++) {
                Wishlist::factory()->create([
                    'user_id' => $user->id,
                    'product_id' => $products->random()->product_id,
                ]);
            }
        }
    }
}
