<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        $attributes = [
            'Color' => ['Carbon Grey', 'Royal Blue', 'Emerald Green', 'Oak Natural'],
            'Material' => ['Teak Wood', 'Velvet Fabric', 'Premium Leather', 'Rattan'],
            'Size' => ['Small', 'Medium', 'Large', 'Extra Large']
        ];

        foreach ($attributes as $name => $values) {
            $attr = Attribute::create([
                'attribute_name' => $name,
                'attribute_slug' => Str::slug($name),
            ]);

            foreach ($values as $value) {
                $attr->values()->create([
                    'attribute_value_name' => $value,
                    'attribute_value_slug' => Str::slug($value),
                ]);
            }
        }
    }
}
