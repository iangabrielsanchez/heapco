@component('mail::message') 
# Hello!
Thank you for creating a HeapCo account. To activate your account, please click the button below.
@component('mail::button',['url'=> url('/something')])
Confirm Account
@endcomponent


Regards,  
HeapCo


@component('mail::subcopy')
If you’re having trouble clicking the "Confirm Account" button, copy and paste the URL below into your web browser:

{{config('app.url')}}/confirm/c4597299ff39b9f94cf6278e8ad476422306c381a8eb08f961730753a4a8960a
@endcomponent
@endcomponent