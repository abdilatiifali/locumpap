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

    public $profile;
    public $job;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Profile $profile, JobListing $job)
    {
        $this->profile = $profile;
        $this->job = $job;
        $this->user = auth()->user();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('User has applied The job')
            ->markdown('mail.hospital')
            ->attach(storage_path("app/public/{$this->profile->cv}"), [
                'as' => "{$this->name()}.cv.pdf"
            ])
            ->attach(storage_path("app/public/{$this->profile->nationalId}"), [
                'as' => "{$this->name()}.nationalId.pdf"
            ])
            ->attach(storage_path("app/public/{$this->profile->indemnity_cover}"), [
                'as' => "{$this->name()}.indemnity_cover.pdf"
            ])
            ->attach(storage_path("app/public/{$this->profile->recommendation_letter}"), [
                'as' => "{$this->name()}.recommendation_letter.pdf"
            ]);
    }

    public function name()
    {
        return $this->profile->user->name;
    }
}
