<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Organization;
use App\Models\JobListing;
use App\Models\Profile;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationHasBeenSubmitted;
use App\Mail\ApplicationRecieved;
use Illuminate\Support\Facades\Queue;

class JobApplicationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_doctor_can_apply_jobs()
    {
        $this->loginAsDoctor();

        $organization = create(Organization::class);

        $job = create(JobListing::class, ['organization_id' => $organization->id]);

        $profile = create(Profile::class, ['user_id' => auth()->id()]);

        $this->assertEmpty($job->candidates);

        $this->withOutExceptionHandling()
            ->post('/apply', ['job' => $job->slug])
            ->assertRedirect('/success');

        $this->assertNotNull($job->fresh()->candidates);
        $this->assertEquals(1, count($job->fresh()->candidates));
    }

    /** @test */
    public function when_doctor_applies_the_job_both_organization_and_applicant_should_recieve_an_email()
    {
        $this->loginAsDoctor();

        $organization = create(Organization::class);

        $job = create(JobListing::class, ['organization_id' => $organization->id]);

        $profile = create(Profile::class);

        Mail::fake();

        Mail::assertNothingOutgoing();

        $this->post('/apply', ['job' => $job->slug]);

        Mail::assertQueued(ApplicationHasBeenSubmitted::class);
        Mail::assertQueued(ApplicationRecieved::class);

        Mail::assertQueued(function (ApplicationRecieved $mail) use ($job) {
            return $mail->hasTo($job->organization->email);
        });

        Mail::assertQueued(function (ApplicationHasBeenSubmitted $mail) {
            return $mail->hasTo(auth()->user()->email);
        });

    }

    /** @test */
    public function a_guest_can_not_apply_jobs()
    {
        $this->post('/apply')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_admin_can_not_apply_jobs()
    {
        $this->loginAsAdmin();

        $this->post('/apply')
            ->assertForbidden()
            ->assertStatus(403);
    }

    /** @test */
    public function an_organization_can_not_apply_jobs()
    {
        $organization = create(Organization::class);

        $this->loginAsOrganization();

        $this->post('/apply')
            ->assertForbidden()
            ->assertStatus(403);
    }

    /** @test */
    public function a_doctor_can_not_apply_jobs_with_out_a_profile()
    {
        $this->loginAsDoctor();

        $job = create(JobListing::class);

        $this->post('/apply', ['job' => $job])
            ->assertRedirect('/profile');
    }

    /** @test */
    public function to_apply_job_u_need_to_upload_cv()
    {
        $this->loginAsDoctor();

        $job = create(JobListing::class);
        $profile = Profile::factory()->create([
            'cv' => null,
        ]);

        $this->post('/apply', ['job' => $job])
            ->assertRedirect('/profile');
    }

    /** @test */
    public function to_apply_job_u_need_to_upload_nationalId()
    {
        $this->loginAsDoctor();

        $job = create(JobListing::class);

        $profile = create(Profile::class, [
            'nationalId' => null,
        ]);

        $this->post('/apply', ['job' => $job])
            ->assertRedirect('/profile');
    }
}
