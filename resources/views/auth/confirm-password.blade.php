@extends('layouts.auth')

@section('title', 'Confirm password — Joy In Zoe Intercessory Ministries')

@section('content')
    <h2 class="h5 mb-2">Confirm your password</h2>
    <p class="text-muted small mb-4">
        This is a secure area of the application. Please confirm your password before continuing.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                   name="password" required autocomplete="current-password">
            <x-field-error field="password" />
        </div>

        <button type="submit" class="btn btn-brand w-100">Confirm</button>
    </form>
@endsection
