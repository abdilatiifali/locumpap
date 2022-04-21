@component('mail::message')
# Dear {{ $event->name }}

A User has booked your event that u created {{ $event->name }}!


We have successfully received your order. Once it has left our logistics centre you will receive an email confirming that it is on its way.


@component('mail::button', ['url' => 'http://inertiajobs.test/'])
Purchase More Products
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
