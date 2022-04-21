<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(1);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => '<p>Testing</p>',
            'rate_per_hour' => 4000,
            'department_id' => 1,
            'profession_id' => 1,
            'county_id' => 1,
            'job_type' => 'full-time',
            'location' => 'nairobi',
            'organization_id' => 1,
        ];
    }
}
