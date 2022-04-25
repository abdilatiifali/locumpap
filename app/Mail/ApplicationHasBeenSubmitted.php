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


    public function __construct(public JobListing $job, public User $user) {}


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
