<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = Arr::random(['Doctor', 'Dentist', 'Nurse']);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
