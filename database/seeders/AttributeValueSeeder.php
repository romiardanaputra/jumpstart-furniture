<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Attribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeValueSeeder extends Seeder
{
    public function run()
    {
        DB::table('attribute_values')->delete();
        
        $attributes = Attribute::all();

        $values = [
            'Color' => ['Matte Black', 'White Pearl', 'Natural Oak', 'Smoked Gray', 'Emerald Green'],
            'Material' => ['Solid Mahogany', 'Teak Wood', 'Premium Velvet', 'Italian Leather', 'Polished Steel'],
            'Size' => ['Small', 'Medium', 'Large', 'Extra Large', 'Compact'],
            'Finish' => ['Glossy', 'Matte', 'Satin', 'Distressed', 'Oiled'],
        ];

        foreach ($attributes as $attr) {
            if (isset($values[$attr->attribute_name])) {
                foreach ($values[$attr->attribute_name] as $val) {
                    AttributeValue::create([
                        'attribute_id' => $attr->attribute_id,
                        'attribute_value_name' => $val,
                        'attribute_value_slug' => \Illuminate\Support\Str::slug($val),
                    ]);
                }
            }
        }
    }
}
