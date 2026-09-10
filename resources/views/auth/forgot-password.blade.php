@extends('layouts.auth')

@section('title', 'Forgot password — Joy In Zoe Intercessory Ministries')

@section('content')
    <h2 class="h5 mb-2">Forgot your password?</h2>
    <p class="text-muted small mb-4">
        Enter your email address and we'll email you a password reset link.
    </p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   value="{{ old('email') }}" required autofocus autocomplete="email">
            <x-field-error field="email" />
        </div>

        <button type="submit" class="btn btn-brand w-100">Email password reset link</button>
    </form>

    <p class="text-center small text-muted mt-4 mb-0">
        <a href="{{ route('login') }}" class="text-decoration-none">&larr; Back to log in</a>
    </p>
@endsection
