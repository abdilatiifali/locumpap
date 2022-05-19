<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mobile_number' => '120229',
            'professional_registration_number' => '1234',
            'profession_id' => 1,
            'county_id' => 1,
            'speciality_id' => 1,
            'gender' => 'male',
            'qualification' => 'phd',
            'experience' => '2 years',
            'from' => Carbon::now()->addWeek(),
            'to' => Carbon::now()->addMonth(),
            'cv' => 'application/abdi.pdf',
            'nationalId' => '203020',
            'recommendation_letter' => 'application/testing.pdf',
            'user_id' => 1,
            'about' => 'hello world',
        ];
    }
}
