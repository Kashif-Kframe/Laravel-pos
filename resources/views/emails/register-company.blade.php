@component('mail::message')
    Hi {{ $company->name ?? '' }}, <br>
    Your have been registered successfully.
    <br>Thanks,<br>
    {{ config('app.name') }}
@endcomponent
