@component('mail::message')
# Hello {{ $user->username }} ,
Your Email is <strong> {{ $user->email }} </strong> <br>
Good day to you !<br>
Welcome to Eled community.<br>
Please click below link to complete registration.<br>

{{  $URL  }}

@component('mail::button', ['url' => $URL, 'color' => 'success'])
Click Me
@endcomponent

Thanks,<br>
Best Regards,<br>
{{ config('app.name') }} Team
@endcomponent
