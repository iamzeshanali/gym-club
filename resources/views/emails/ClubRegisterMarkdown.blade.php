@component('mail::message')
# Club Registered

Hi {{$userName}}, <br>
You have registered a new Club {{$clubName}}.<br>
Please Log in to check further details.

@component('mail::button', ['url' => 'http://gym.test/login'])
    Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
