<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Restaurant;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 3),
            'name' => $this->faker->word,
            'name_katakana' => 'フリガナ',
            'review' => $this->faker->numberBetween(1, 5),
            'food_picture' => $this->faker->imageUrl(),
            'map_url' => 'https://www.google.com/maps?q=' . $this->faker->latitude . ',' . $this->faker->longitude,
            'tel' => $this->faker->phoneNumber,
            'comment' => $this->faker->realText(300),
        ];
    }
}
