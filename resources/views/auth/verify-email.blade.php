@extends('layouts.auth')

@section('title', 'Verify email — Joy In Zoe Intercessory Ministries')

@section('content')
    <h2 class="h5 mb-2">Verify your email address</h2>
    <p class="text-muted small mb-4">
        Thanks for signing up! Before getting started, please verify your email address
        by clicking the link we just emailed to you.
    </p>

    @if (session('status') === 'verification-link-sent')
        <div class="alert alert-success" role="alert">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-brand">Resend verification email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-link text-decoration-none">Log out</button>
    </form>
@endsection
