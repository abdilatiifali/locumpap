<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\JobListing;
use App\Models\Organization;

class JobListingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_view_jobs()
    {
        $this->get("/jobs")
            ->assertRedirect('/login');
    }

    /** @test */
    public function unverified_locums_can_not_access_jobs()
    {
        $this->loginAsDoctor(['verified_at' => null]);

        $this->get("/jobs")
            ->assertRedirect('/verification/notice');
    }

    /** @test */
    public function an_authenticated_user_can_view_jobs()
    {
        $this->signedIn();
        
        $this->withOutExceptionHandling()
            ->get("/jobs")
            ->assertStatus(200);
    }

    /** @test */
    public function guest_can_not_create_jobs()
    {
        $this->post("/jobs", [])
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_doctor_can_not_create_jobs()
    {
        $this->loginAsDoctor();
        
        $this->post('/jobs')->assertForbidden();
    }

    /** @test */
    public function a_title_is_required_to_post_a_job()
    {
        $organization = create(Organization::class);

        $this->loginAsOrganization();

        $job = make(JobListing::class, [
            'title' => null,
        ])->toArray();

        $response = $this->post('/jobs')
            ->assertStatus(302)
            ->assertSessionHasErrors('title');

    }

    /** @test */
    public function a_description_is_required_to_post_a_job()
    {        
        $this->loginAsOrganization();

        $job = make(JobListing::class, [
            'description' => null,
        ])->toArray();

        $response = $this->post('/jobs')
            ->assertStatus(302)
            ->assertSessionHasErrors('description');

    }

    /** @test */
    public function a_county_is_required_to_post_a_job()
    {
        $this->loginAsOrganization();

        $job = make(JobListing::class, [
            'county_id' => null,
        ])->toArray();

        $response = $this->post('/jobs')
            ->assertStatus(302)
            ->assertSessionHasErrors('county_id');

    }
}
