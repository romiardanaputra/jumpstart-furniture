<?php

namespace Database\Seeders;

use App\Models\Blog as ModelsBlogs;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsBlogs::factory(3)->create();
    }
}
