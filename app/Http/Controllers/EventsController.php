<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Event;
use App\Models\Order;
use App\Models\EventType;
use Illuminate\Support\Facades\Request;
use App\Http\Resources\EventResource;
use Mail;
use App\mail\EventHasbeenBooked;
use App\Mail\UserHasBookedEvent;

class EventsController extends Controller
{
    public function index()
    {   
        return Inertia::render('Events/Index', [
            'events' => EventResource::collection(Event::latest()->get())
        ]);
    }

    public function show(Event $event)
    {
        return Inertia::render('Events/Show', [
            'event' => EventResource::make($event),
        ]);
    }

    public function create(Event $event)
    {
        return Inertia::render('Events/Create', [
            'event' => EventResource::make($event)
        ]);
    }

    public function store()
    { 
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required',
            'eventId' => 'required',
        ]);

        $event = Event::findOrFail(request('eventId'));

        $order = Order::create([
            'name' => request('name'),
            'email' => request('email'),
            'number' => request('number'),
            'price' => $event->price,
            'event_id' => $event->id,
        ]);

        // send email to user
        Mail::to($order->email)
            ->queue(new EventHasbeenBooked($event, $order));

        // todo mail to the instiution
        Mail::to($event->email)
            ->queue(new UserHasBookedEvent($event, $order));
        // confirmation page

        return Inertia::render('Events/Success');
    }
}
