<?php

namespace App\Mail;

use App\Models\JobListing;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicationHasBeenSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $job;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(JobListing $job, User $user)
    {

        $this->job = $job;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Application Has Been submitted')
            ->markdown('mail.user');
    }
}
