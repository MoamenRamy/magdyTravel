@extends('layouts.mail')

@section('content')

    <h2>Custom Password Reset</h2>

    <p>You are receiving this email because we received a password reset request for your account.</p>

    @component('mail::button', ['url' => $url])
        Reset Password
    @endcomponent

    <p>If you did not request a password reset, no further action is required.</p>

    <p>thanks</p>
    {{-- {{ config('app.name') }} --}}
@endsection
