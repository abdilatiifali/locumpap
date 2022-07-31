<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Organization;
use App\Models\JobListing;
use App\Models\Locum;
use App\Models\Permanent;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function register_an_organization()
    {
        $response = $this->withOutExceptionHandling()->post('/practices', [
            'organization_name' => 'Nairobi Hospital',
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
            'name' => 'Nairobi Hospital',
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

    /** @test */
    public function an_organization_can_not_create_jobs_if_thier_trial_is_ended()
    {
        $this->loginAsOrganization([
            'created_at' => now()->subMonths(4),
        ]);

        $organization = Organization::first();

        $organization->endTrial();

        $job = make(JobListing::class, [
            'job_type' => 'permanent',
        ]);

        $this->post('/jobs', $job->toArray())
            ->assertForbidden();
    }

    /** @test */
    public function subscribed_organization_can_create_locum_jobs()
    {
        $this->loginAsOrganization();

        $organization = Organization::first();

        $organization->endTrial();

        $organization->update([
            'subscribed_at' => now(),
            'subscription_ends_at' => now()->addMonths(12)
        ]);

        $deadline = now()->addMonth();

        $job = make(JobListing::class, [
            'title' => 'locum job title',
            'job_type' => 'Locum',
            'deadline_at' => $deadline,
            'start_at' => now()->addWeek(),
            'end_at' => now()->addMonth(),
        ]);

        $this->withOutExceptionHandling()
            ->post('/jobs', $job->toArray());
        
        $job = JobListing::first();
        $locum = Locum::first();

        $this->assertDatabaseCount('job_listings', 1);
        $this->assertDatabaseCount('locums', 1);
        $this->assertEquals($deadline->diffForHumans(), $job->deadline_at->diffForHumans());
        $this->assertEquals('locum job title', $job->title);
        $this->assertEquals($locum->id, $job->typable_id);
        $this->assertEquals(get_class($locum), $job->typable_type);
        $this->assertEquals(
            $organization->subscribed_at->format('d-m-Y'),
            now()->format('d-m-Y')
        );
        $this->assertEquals(
            $organization->subscription_ends_at->format('d-m-Y'), 
            now()->addMonths(12)->format('d-m-Y')
        );
    }

    /** @test */
    public function an_organization_can_create_permanent_jobs()
    {
        $this->loginAsOrganization();

        $job = make(JobListing::class, [
            'title' => 'permanent job title',
            'deadline_at' => now()->addMonths(2),
            'job_type' => 'permanent',
        ]);

        $this->post('/jobs', $job->toArray());
        
        $job = JobListing::first();
        $permanent = Permanent::first();

        $this->assertDatabaseCount('job_listings', 1);
        $this->assertDatabaseCount('permanents', 1);
        $this->assertEquals('permanent job title', $job->title);
        $this->assertEquals($permanent->id, $job->typable_id);
        $this->assertEquals(get_class($permanent), $job->typable_type);
    }
}
