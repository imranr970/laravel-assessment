@component('mail::message')
# Hello Dear {{ $name }}!

You have been invited to create Account on Laravel Assessment.
<br>
Use this Invite link to create a Free Account.
<br>

<a href="{{ $url }}">{{ $url }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
