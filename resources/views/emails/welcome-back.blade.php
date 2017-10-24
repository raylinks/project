@component('mail::message')
# Introduction

Thank you so much for registering with us at gitlinks blog, {{ $user->full_name }}

@component('mail::button', ['url' => 'https://google.com'])
Return to Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
