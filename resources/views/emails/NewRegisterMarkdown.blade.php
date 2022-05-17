@component('mail::message')
# New Registration

Hi {{$user->name}},<br>

Welcome to GymClub. You have been registered.<br>
Please Login to continue further.

@component('mail::button', ['url' => 'http://gym.test/login'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
