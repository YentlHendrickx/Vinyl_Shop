@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Dear {{ $request->name }},
Thanks for you message.<br>
We'll contact you as soon as possible.

<hr>
<p>
<b>Your name:</b> {{ $request->name }}<br>
<b>Your email:</b> {{ $request->email }}
</p>
<p>
<b>Your message:</b><br>{!! nl2br($request->message) !!}
</p>
Thanks,<br>
{{ env('APP_NAME') }}
@endcomponent

