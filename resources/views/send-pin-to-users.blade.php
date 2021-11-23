@component('mail::message')
# Hello Dear User

Click on the link below and use this pin to verify your account.
Your 6 Digit Pin is {{ $pin }}

Click on the button to verify account.

@component('mail::button', ['url' => $url])
Verify 
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
