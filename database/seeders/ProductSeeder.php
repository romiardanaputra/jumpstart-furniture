<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->delete();
        
        $users = User::all();
        $categories = Category::all();

        for ($i = 0; $i < 30; $i++) {
            Product::factory()->create([
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->category_id,
            ]);
        }
    }
}
