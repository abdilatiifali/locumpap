@component('mail::message')
# Dear {{ $order->name }}

Thank you for enrolling in the {{ $event->name }}. Please find attached the info pack detailing the training specifications. 
Feel free to contact us if you haver any queries. 

We look forward to hosting you!
Best, 

@component('mail::button', ['url' => 'http://inertiajobs.test/events'])
Check upcoming events
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
