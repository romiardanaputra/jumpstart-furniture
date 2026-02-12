<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        DB::table('attributes')->delete();
        Attribute::factory()->count(4)->create(); // Color, Material, Size, Finish
    }
}
