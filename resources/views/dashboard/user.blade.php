@extends('layouts.app')

@section('title', 'My Dashboard — Joy In Zoe Intercessory Ministries')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Joy In Zoe logo"
                         class="rounded-circle shadow mb-3" style="width:96px;height:96px;object-fit:cover">
                    <h1 class="h3 mb-1">Welcome, {{ $user->name }}</h1>
                    <p class="text-muted">Your account is active. Explore the ministry and grow in prayer.</p>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header">Profile</div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Name</dt>
                            <dd class="col-sm-8">{{ $user->name }}</dd>
                            <dt class="col-sm-4">Email</dt>
                            <dd class="col-sm-8">{{ $user->email }}</dd>
                            <dt class="col-sm-4">Member since</dt>
                            <dd class="col-sm-8">{{ $user->created_at?->format('M j, Y') }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Change password</h5>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current password</label>
                                <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                       id="current_password" name="current_password" required>
                                <x-field-error field="current_password" />
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New password</label>
                                <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                       id="password" name="password" required>
                                <x-field-error field="password" />
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm new password</label>
                                <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                       id="password_confirmation" name="password_confirmation" required>
                                <x-field-error field="password_confirmation" />
                            </div>

                            <button type="submit" class="btn btn-brand">Update password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
