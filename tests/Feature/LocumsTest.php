<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Profession;
use App\Models\Profile;
use App\Models\County;
use App\Models\speciality;

class LocumsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_register_a_new_doctor()
    {
        $profession = create(Profession::class);
        $county = create(County::class);
        $speciality = create(Speciality::class);

        $response = $this->withOutExceptionHandling()->post('/locum', [
            'first_name' => 'abdi',
            'last_name' => 'ali',
            'email' => 'latiif@gmail.com',
            'email_confirmation' => 'latiif@gmail.com',
            'password' => 'testing123',
            'password_confirmation' => 'testing123',
            'countyId' => $county->id,
            'specialityId' => $speciality->id,
            'mobile_number' => '0123456',
            'professionId' => $profession->id,
            'registration_number' => 'a12345678',
            'organization' => false,
        ]);

        $profile = Profile::first();

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseCount('profiles', 1);

        $this->assertEquals($profession->id, $profile->profession_id);
        $this->assertEquals($county->id, $profile->county_id);
        $this->assertEquals($speciality->id, $profile->speciality_id);
        $this->assertEquals('a12345678', $profile->professional_registration_number);
    }

    /** @test */
    public function email_is_required_to_register_as_doctor()
    {
        $profession = create(Profession::class);
        $county = create(County::class);
        $speciality = create(Speciality::class);

        $this->post('/locum', [
            'first_name' => 'abdi',
            'last_name' => 'ali',
            'email_confirmation' => 'latiif@gmail.com',
            'password' => 'testing123',
            'email' => null,
            'password_confirmation' => 'testing123',
            'countyId' => $county->id,
            'specialityId' => $speciality->id,
            'mobile_number' => '0123456',
            'professionId' => $profession->id,
            'registration_number' => '012345678',
            'organization' => false,
        ])
        ->assertStatus(302)
        ->assertSessionHasErrors('email');
    }
}
