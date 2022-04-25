<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;
use App\Models\Order;

class EventHasbeenBooked extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public Event $event, public Order $order){}
   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->subject('Confirmation of event')
            ->markdown('mail.events');
    }
}
