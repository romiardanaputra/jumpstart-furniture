<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    public function run()
    {
        DB::table('carts')->delete();
        
        $users = User::all();
        $skus = Sku::all();

        foreach ($users as $user) {
            // Randomly give 0-3 items in cart to each user
            $count = rand(0, 3);
            for ($i = 0; $i < $count; $i++) {
                $sku = $skus->random();
                Cart::factory()->create([
                    'user_id' => $user->id,
                    'sku_id' => $sku->sku_id,
                    'product_id' => $sku->product_id,
                ]);
            }
        }
    }
}
