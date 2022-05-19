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
            'registration_number' => 'a09100',
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
            'registration_number' => 'a09100',
            'post_code' => '08182',
        ]);
    }

    /** @test */
    public function an_organization_can_create_locum_jobs()
    {
        $this->loginAsOrganization();

        $job = make(JobListing::class, [
            'title' => 'locum job title',
            'job_type' => 'Locum',
            'start_at' => now()->addWeek(),
            'end_at' => now()->addMonth(),
        ]);

        $this->withOutExceptionHandling()
            ->post('/jobs', $job->toArray());
        
        $job = JobListing::first();
        $locum = Locum::first();

        $this->assertDatabaseCount('job_listings', 1);
        $this->assertDatabaseCount('locums', 1);
        $this->assertEquals('locum job title', $job->title);
        $this->assertEquals($locum->id, $job->typable_id);
        $this->assertEquals(get_class($locum), $job->typable_type);
    }

    /** @test */
    public function an_organization_can_create_permanent_jobs()
    {
        $this->loginAsOrganization();

        $job = make(JobListing::class, [
            'title' => 'permanent job title',
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
