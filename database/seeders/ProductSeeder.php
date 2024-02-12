<?php

namespace Database\Seeders;

use App\Models\Product as ModelsProduct;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsProduct::factory(10)->create();
    }
}
