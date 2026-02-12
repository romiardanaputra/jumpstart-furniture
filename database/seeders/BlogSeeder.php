<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    public function run()
    {
        DB::table('blogs')->delete();
        
        $users = User::all();
        $categories = BlogCategory::all();

        for ($i = 0; $i < 30; $i++) {
            Blog::factory()->create([
                'user_id' => $users->random()->id,
                'blog_category_id' => $categories->random()->category_id,
            ]);
        }
    }
}
