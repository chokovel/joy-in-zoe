@extends('layouts.admin')

@section('title', 'Subscribers — Joy In Zoe Administration')
@section('header', 'Subscribers')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <p class="text-muted mb-0">Emails collected from the subscribe forms across the site.</p>
        <a href="{{ route('admin.subscribers.export') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-download me-1"></i>Export CSV
        </a>
    </div>

    <div class="card">
        <div class="card-body border-bottom">
            <form method="GET" action="{{ route('admin.subscribers.index') }}" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label small">Search</label>
                    <input type="text" class="form-control form-control-sm" id="search" name="search"
                           value="{{ request('search') }}" placeholder="Search email...">
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label small">Status</label>
                    <select class="form-select form-select-sm" id="status" name="status">
                        <option value="">All</option>
                        <option value="active" @selected(request('status') === 'active')>Active</option>
                        <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-sm btn-brand w-100">Filter</button>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Subscribed</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subscribers as $subscriber)
                        <tr>
                            <td class="fw-semibold">{{ $subscriber->email }}</td>
                            <td>
                                @if ($subscriber->is_active)
                                    <span class="badge text-bg-success">Active</span>
                                @else
                                    <span class="badge text-bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $subscriber->subscribed_at?->format('M j, Y g:i A') }}</td>
                            <td class="text-end">
                                <form method="POST" action="{{ route('admin.subscribers.destroy', $subscriber) }}"
                                      onsubmit="return confirm('Remove this subscriber?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i><span class="visually-hidden">Delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No subscribers yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $subscribers->links() }}
    </div>
@endsection
