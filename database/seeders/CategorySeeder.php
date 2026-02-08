<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Sofa',
            'Bed',
            'Table',
            'Chair',
            'Storage',
            'Lighting',
            'Outdoor'
        ];

        foreach ($categories as $cat) {
            Category::create([
                'category_name' => $cat,
                'category_slug' => Str::slug($cat),
                'category_description' => "Explore our premium selection of {$cat} items.",
            ]);
        }
    }
}
