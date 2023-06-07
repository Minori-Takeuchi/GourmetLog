<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategoryTag;

class CategoryTagFactory extends Factory
{
    protected $model = CategoryTag::class;

    public function definition()
    {
        return [
            'restaurant_id' => $this->faker->numberBetween(1, 30),
            'category_id' => $this->faker->numberBetween(1, 8),
        ];
    }
}
