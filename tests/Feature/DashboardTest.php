<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

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
}
