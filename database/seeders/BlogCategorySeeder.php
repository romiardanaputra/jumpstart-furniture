<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Tips & Inspiration', 'description' => 'Creative ideas for your home decor.'],
            ['name' => 'Furniture Care', 'description' => 'How to maintain your wood, fabric, and leather furniture.'],
            ['name' => 'Promos & Collections', 'description' => 'Latest news about sales and new product drops.'],
            ['name' => 'Behind the Scenes', 'description' => 'Meet our craftsmen and see how we work.'],
        ];

        foreach ($categories as $category) {
            BlogCategory::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
