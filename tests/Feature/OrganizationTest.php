<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Organization;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function register_an_organization()
    {
        $response = $this->withOutExceptionHandling()->post('/practices', [
            'organization_name' => 'Nairobi Hospital',
            'first_name' => 'abdi',
            'last_name' => 'ali',
            'email' => 'latiifabdi@gmail.com',
            'email_confirmation' => 'latiifabdi@gmail.com',
            'password' => 'testing123',
            'password_confirmation' => 'testing123',
            'county' => 'nairobi',
            'phone_number' => '01819181',
            'organization_type' => 'Hospital',
            'address' => 'jam',
            'city' => 'nairobi',
            'post_code' => '08182',
            'organization' => true,
        ]);

        $this->assertDatabaseCount('users', 1);

        $organization = Organization::first();

        $this->assertDatabaseHas('users', [
            'name' => 'abdi ali',
            'email' => 'latiifabdi@gmail.com',
            'organization_id' => $organization->id
        ]);

        $this->assertDatabaseHas('organizations', [
            'name' => 'Nairobi Hospital',
            'email' => 'latiifabdi@gmail.com',
            'county' => 'nairobi',
            'phone_number' => '01819181',
            'organization_type' => 'Hospital',
            'address' => 'jam',
            'city' => 'nairobi',
            'post_code' => '08182',
        ]);
    }
}
