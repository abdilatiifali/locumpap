@component('mail::message')
# Congratulations {{ $name }}

Your Have been Offer a job for nairobi hospital and they will shortly contact you as soon as possible

If you are shortlisted, you’ll be contacted for an interview. If after 3 weeks your invitation hasn’t come, consider your application unsuccessful.

## Did you Know?

Your Career Profile is sent to employers along with your CV when applying for a job. You are 50% more likely to be shortlisted if your profile is complete.

@component('mail::button', ['url' => 'http://inertiajobs.test/'])
Checkout Our Latest Jobs
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
