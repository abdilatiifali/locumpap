<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $email = $this->faker->unique()->safeEmail();
        $password = $this->faker->password();

        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->email(),
            'county' => $this->faker->state(),
            'phone_number' => $this->faker->phoneNumber(),
            'organization_type' => 'Hospital',
            'address' => $this->faker->streetAddress(),
            'registration_number' => 'a109191',
            'city' => $this->faker->city(),
            'post_code' => $this->faker->postcode(),
        ];
    }
}
