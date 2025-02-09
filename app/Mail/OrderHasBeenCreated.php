<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Product;

class OrderHasBeenCreated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user, public Product $product) {}
  

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmation of order')
            ->markdown('mail.order');
    }
}
