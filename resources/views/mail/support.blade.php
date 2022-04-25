@component('mail::message')
# Customer Has Support Request

{{ $name }} has said the following message to us {{ $message }}

his phone number is {{ $phone }} and his email is {{ $email }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
