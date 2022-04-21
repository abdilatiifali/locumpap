<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use App\Models\Organization;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signedIn($user = null)
    {
        $user = $user ?? User::factory()->create();

        $this->actingAs($user);
        
        return $this;
    }

    public function loginAsOrganization($attributes = [])
    {
        $this->signedIn(Create(User::class, array_merge([
            'organization' => true,
            'organization_id' => create(Organization::class)->id,
        ], $attributes)));
    }

    public function loginAsDoctor($attributes = [])
    {
         $this->signedIn(Create(User::class, array_merge([
            'organization' => false,
            'organization_id' => null,
        ], $attributes)));
    }

    public function loginAsAdmin()
    {
         $this->signedIn(Create(User::class, [
            'email' => 'abdilatiifali@gmail.com',
         ]));
    }

}
