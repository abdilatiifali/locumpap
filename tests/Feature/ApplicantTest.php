<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Organization;
use App\Models\User;
use App\Models\JobListing;
use App\Models\Profile;

class ApplicantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_view_applicants()
    {
        $this->get("/applicants")
            ->assertRedirect('/login');
    }

    /** @test */
    // public function an_organization_can_only_view_applicants_who_apply_to_them()
    // {
    //     $organizationA = create(Organization::class);
    //     $organizationB = create(Organization::class);

    //     $nairobiHospitalUser = create(User::class, [
    //         'organization' => true,
    //         'organization_id' => $organizationA->id,
    //     ]);

    //     $kenyattaHospitalUser = create(User::class, [
    //         'organization' => true,
    //         'organization_id' => $organizationB,
    //     ]);

    //     $this->signedIn(create(User::class, ['id' => 5]));

    //     $job = create(JobListing::class, ['organization_id' => $organizationA->id]);

    //     $profile = create(Profile::class, ['user_id' => auth()->id()]);

    //     $this->post('/apply', ['job' => $job->slug]);

    //     $this->signedIn($kenyattaHospitalUser)
    //         ->get("/applicants")
    //         ->assertJsonCount(0);

    //     $this->signedIn($nairobiHospitalUser)
    //         ->get("/applicants")
    //         ->assertJsonCount(1);

    // }

    /** @test */
    public function a_doctor_can_not_view_applicants()
    {
        $this->loginAsDoctor();

        $this->get("/applicants")
            ->assertForbidden();
    }

}
