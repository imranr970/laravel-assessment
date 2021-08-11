@component('mail::message')
# Hello Dear {{ $name }}!

You have been invited to create Account on Laravel Assessment.
<br>
Use this Invite Token to create a Free Account.
<br>
{{ $token }}

@component('mail::button', ['url' => $url ])
Create a Free Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
