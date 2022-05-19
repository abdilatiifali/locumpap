<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Organization;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_new_organization()
    {        
        $user = create(User::class);

        $attributes = [
            'organization_name' => 'Nairobi hospital',
            'email' => 'latiifali@gmail.com',
            'county' => 'nairobi',
            'phone_number' => '08282882',
            'organization_type' => 'hospital',
            'address' => 'jam street',
            'city' => 'nairobi',
            'post_code' => '019191',
            'registration_number' => 'a1010101',
        ];

        $organization = Organization::createNewOrganization($attributes, $user);

        $this->assertDatabaseCount('organizations', 1);
    }
}
