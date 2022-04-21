@component('mail::message')
# Dear {{ $job->organization->name }}

Following your opening for locums, below are the applications submitted via locum pap for your attention. 


Kind Regards,

@component('mail::button', ['url' => 'http://inertiajobs.test/jobs'])
Check all Locums
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
