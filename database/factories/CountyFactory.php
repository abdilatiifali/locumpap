<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class CountyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = Arr::random(['Nairobi', 'Mombasa', 'Nakuru']);

        return [
            'name' => $name,
            'slug' => \Str::slug($name),
        ];
    }
}
