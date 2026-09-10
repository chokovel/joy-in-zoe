@extends('layouts.auth')

@section('title', 'Create an account — Joy In Zoe Intercessory Ministries')

@section('content')
    <h2 class="h5 mb-4">Create your account</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Full name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                   value="{{ old('name') }}" required autofocus autocomplete="name">
            <x-field-error field="name" />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   value="{{ old('email') }}" required autocomplete="email">
            <x-field-error field="email" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                   name="password" required autocomplete="new-password">
            <x-field-error field="password" />
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                   id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
            <x-field-error field="password_confirmation" />
        </div>

        <button type="submit" class="btn btn-brand w-100">Create account</button>
    </form>

    <p class="text-center small text-muted mt-4 mb-0">
        Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Log in</a>
    </p>
@endsection
