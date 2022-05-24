<?php

namespace App\Mail;

use App\Models\JobListing;
use App\Models\Profile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicationRecieved extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Profile $profile, public JobListing $job){}
   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('User has applied The job')
            ->markdown('mail.hospital');
    }

    public function name()
    {
        return $this->profile->user->name;
    }
}
