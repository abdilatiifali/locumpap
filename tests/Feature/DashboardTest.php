<?php

namespace Tests\Feature;

use App\Models\JobListing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unverified_organization_can_not_access_dashboard()
    {
        $this->loginAsOrganization(['verified_at' => null]);

        $this->get("/dashboard")
            ->assertRedirect('/verification/notice');
    }

    /** @test */
    public function guest_can_not_view_dashboard()
    {
        $this->get("/dashboard")
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_doctor_can_not_view_dashboard()
    {
        $this->signedIn();

        $this->get("/dashboard")
            ->assertForbidden();
    }

    /** @test */
    public function an_admin_can_not_view_dashboard()
    {
        $this->loginAsAdmin();

        $this->get("/dashboard")
            ->assertForbidden();
    }

    /** @test */
    public function an_organization_can_view_dashboard_home_page()
    {
        $this->loginAsOrganization();

        $this->get("/dashboard")
            ->assertOk();
    }

    /** @test */
    public function an_organization_can_view_dashboard_doctors_page()
    {
        $this->loginAsOrganization();

        $this->get("/dashboard/healthcare-professionals")
            ->assertOk();
    }

    /** @test */
    public function organization_can_retrive_monthly_posted_jobs()
    {
        $this->loginAsOrganization();

        $job = create(JobListing::class, [
            'organization_id' => auth()->id(),
            'created_at' => now()->subMonth(),
        ]);

        $job2 = create(JobListing::class, [
            'organization_id' => auth()->id(),
            'created_at' => now()->subWeek(2),
        ]);

         $job3 = create(JobListing::class, [
            'organization_id' => auth()->id(),
            'created_at' => now()->addMonths(2),
        ]);

        $this->assertEquals(2, JobListing::monthly()->count());
    }

    /** @test */
    public function organization_can_retrive_weekly_posted_jobs()
    {
        $this->loginAsOrganization();

        $job = create(JobListing::class, [
            'organization_id' => auth()->id(),
            'created_at' => now()->subWeek(),
        ]);

        $job2 = create(JobListing::class, [
            'organization_id' => auth()->id(),
            'created_at' => now()->subDays(5),
        ]);

        $job2 = create(JobListing::class, [
            'organization_id' => auth()->id(),
            'created_at' => now()->subDays(6),
        ]);

         $job3 = create(JobListing::class, [
            'organization_id' => auth()->id(),
            'created_at' => now()->addMonths(2),
        ]);

        $this->assertEquals(3, JobListing::weekly()->count());
    }

    /** @test */
    public function organization_can_retrive_past_year_posted_jobs()
    {
        $this->loginAsOrganization();

        $job = create(JobListing::class, [
            'organization_id' => auth()->id(),
            'created_at' => now()->subWeek(),
        ]);

        $job2 = create(JobListing::class, [
            'organization_id' => auth()->id(),
            'created_at' => now()->subDays(13),
        ]);

        $job2 = create(JobListing::class, [
            'organization_id' => auth()->id(),
            'created_at' => now()->subMonths(4),
        ]);

        $job3 = create(JobListing::class, [
            'organization_id' => auth()->id(),
            'created_at' => now()->addYear(3),
        ]);

        $job4 = create(JobListing::class, [
            'organization_id' => 14,
            'created_at' => now()->subDays(7),
        ]);

        $this->assertEquals(
            3, 
            JobListing::where('organization_id', auth()->id())->yearly()->count(),
        );
    }


}
