@extends('layouts.admin')

@section('title', 'Edit user — Joy In Zoe Administration')
@section('header', 'Edit user')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Full name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                           value="{{ old('name', $user->name) }}" required>
                    <x-field-error field="name" />
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                           value="{{ old('email', $user->email) }}" required>
                    <x-field-error field="email" />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">New password <span class="text-muted small">(optional)</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                           name="password" autocomplete="new-password">
                    <x-field-error field="password" />
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                        @foreach (\App\Enums\Role::cases() as $role)
                            <option value="{{ $role->value }}" @selected(old('role', $user->role->value) === $role->value)>{{ $role->label() }}</option>
                        @endforeach
                    </select>
                    <x-field-error field="role" />
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-brand">Save changes</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
