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
            'department_id' => 1,
            'profession_id' => 1,
            'rate' => 'negotiable',
            'county_id' => 1,
            'location' => 'nairobi',
            'organization_id' => 1,
            'typable_id' => 1,
            'typable_type' => 'App\Models\Locum',
            'candidates' => [],
        ];
    }
}
