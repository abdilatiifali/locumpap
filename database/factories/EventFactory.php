<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(1),
            'description' => $this->faker->paragraph(3),
            'type_id' => 1,
            'price' => 15000,
            'address' => $this->faker->address(),
            'author' => $this->faker->lastName(),
            'city' => Arr::random(['nairobi', 'kisumu', 'mombasa', 'nakuru']),
            'phoneNumber' => '0745793438',
            'published_at' => Carbon::now()->addWeek(),
        ];
    }
}
