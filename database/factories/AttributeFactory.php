<?php

namespace Database\Factories;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AttributeFactory extends Factory
{
    protected $model = Attribute::class;

    public function definition()
    {
        $name = $this->faker->unique()->randomElement(['Color', 'Material', 'Size', 'Finish']);
        
        return [
            'attribute_name' => $name,
            'attribute_slug' => Str::slug($name),
        ];
    }
}
