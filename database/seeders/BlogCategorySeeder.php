<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('blog_categories')->delete();
        BlogCategory::factory()->count(6)->create();
    }
}
