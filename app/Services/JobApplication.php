<?php

namespace App\Services;

use App\Models\JobListing;
use App\Models\User;
use App\Mail\ApplicationHasBeenSubmitted;
use App\Mail\ApplicationRecieved;
use Illuminate\Support\Facades\Mail;
use App\Models\Applicant;

class JobApplication
{
    public function applyFor(User $user, JobListing $job)
    {
        Mail::to($job->organization->email)
            ->cc('mohamednoor766@gmail.com')
            ->bcc('abdilatiifali@gmail.com')
            ->queue(new ApplicationRecieved($user->profile, $job));

        Mail::to($user->email)
            ->queue(new ApplicationHasBeenSubmitted($job, $user));

        // candidate create
        Applicant::create([
            'user_id' => $user->id,
            'job_listing_id' => $job->id,
        ]);

        $job->update([
            'candidates' => array_merge($job->candidates, [auth()->id()])
        ]);

    }
}
