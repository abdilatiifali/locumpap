<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;
use App\Models\Order;

class UserHasBookedEvent extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, Order $order)
    {
        $this->order = $order;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("{$this->order->email} has booked your event")
                    ->markdown('mail.eventCreator');
    }
}
