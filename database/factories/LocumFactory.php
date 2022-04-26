<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_at' => now(),
            'end_at' => now()->addMonth(),
        ];
    }
}
