<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategoryTag;

class CategoryTagFactory extends Factory
{
    protected $model = CategoryTag::class;

    private $restaurantId = 1;

    public function definition()
    {
        return [
            'restaurant_id' => $this->restaurantId++,
            'category_id' => $this->faker->numberBetween(1, 8),
        ];
    }
}
