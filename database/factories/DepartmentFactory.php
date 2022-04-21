<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = Arr::random(['Inpatient', 'Outpatient', 'ICU']);
        return [
            'name' => $name,
            'slug' => \Str::slug($name),
        ];
    }
}
