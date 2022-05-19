@component('mail::message')
# Dear {{ $job->organization->name }}

Following your opening for locums, below are the applications submitted via locum pap for your attention. 

Kind Regards,

@component('mail::button', ['url' => config('app.url') . '/dashboard/healthcare-professionals'])
Check all Healthcare Professionals
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
