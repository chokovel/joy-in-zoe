@extends('layouts.auth')

@section('title', 'Log in — Joy In Zoe Intercessory Ministries')

@section('content')
    <h2 class="h5 mb-4">Log in to your account</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   value="{{ old('email') }}" required autofocus autocomplete="email">
            <x-field-error field="email" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                   name="password" required autocomplete="current-password">
            <x-field-error field="password" />
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            @if (Route::has('password.request'))
                <a class="small text-decoration-none" href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="btn btn-brand w-100">Log in</button>
    </form>

    <p class="text-center small text-muted mt-4 mb-0">
        Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Create one</a>
    </p>
@endsection
