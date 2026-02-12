<?php

namespace Database\Seeders;

use App\Models\Checkout;
use App\Models\User;
use App\Models\Sku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckoutSeeder extends Seeder
{
    public function run()
    {
        DB::table('checkouts')->delete();
        
        $users = User::all();
        $skus = Sku::all();

        for ($i = 0; $i < 30; $i++) {
            $user = $users->random();
            $sku = $skus->random();
            Checkout::factory()->create([
                'user_id' => $user->id,
                'sku_id' => $sku->sku_id,
                'product_id' => $sku->product_id,
            ]);
        }
    }
}
