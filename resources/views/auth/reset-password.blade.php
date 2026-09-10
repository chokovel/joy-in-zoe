@extends('layouts.auth')

@section('title', 'Reset password — Joy In Zoe Intercessory Ministries')

@section('content')
    <h2 class="h5 mb-4">Reset your password</h2>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   value="{{ old('email', $request->email) }}" required autofocus autocomplete="email">
            <x-field-error field="email" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                   name="password" required autocomplete="new-password">
            <x-field-error field="password" />
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm new password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                   id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
            <x-field-error field="password_confirmation" />
        </div>

        <button type="submit" class="btn btn-brand w-100">Reset password</button>
    </form>
@endsection
