<?php

namespace App\Traits;

use App\Notifications\VerifyUser;

trait MustVerifyUser
{
	/**
     * Determine if the user has verified yet.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return ! is_null($this->verified_at);
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the email verification confirmation notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyUser($this));
    }

}
