<?php

namespace Database\Factories;

use App\Models\AttributeValue;
use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AttributeValueFactory extends Factory
{
    protected $model = AttributeValue::class;

    public function definition()
    {
        return [
            'attribute_id' => Attribute::factory(),
            'attribute_value_name' => $this->faker->word(),
            'attribute_value_slug' => function (array $attributes) {
                return Str::slug($attributes['attribute_value_name']);
            },
        ];
    }
}
