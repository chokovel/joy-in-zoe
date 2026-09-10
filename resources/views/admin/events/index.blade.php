@extends('layouts.admin')

@section('title', 'Events — Joy In Zoe Administration')
@section('header', 'Events')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 gap-2 flex-wrap">
        <form method="GET" action="{{ route('admin.events.index') }}" class="d-flex gap-2 flex-wrap">
            <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm"
                   placeholder="Search events" aria-label="Search events">
            <select name="filter" class="form-select form-select-sm">
                <option value="">All events</option>
                <option value="upcoming" @selected(request('filter') === 'upcoming')>Upcoming</option>
                <option value="past" @selected(request('filter') === 'past')>Past</option>
            </select>
            <button class="btn btn-sm btn-outline-secondary" type="submit">Filter</button>
        </form>
        <a href="{{ route('admin.events.create') }}" class="btn btn-brand btn-sm"><i class="bi bi-plus-lg me-1"></i>New event</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td class="fw-semibold">
                                {{ $event->title }}
                                @if ($event->image)
                                    <i class="bi bi-image text-muted ms-1" title="Has image"></i>
                                @endif
                            </td>
                            <td>{{ $event->starts_at->format('M j, Y') }}</td>
                            <td>{{ $event->location ?? '—' }}</td>
                            <td>
                                @if ($event->is_published)
                                    <span class="badge text-bg-success">Published</span>
                                @else
                                    <span class="badge text-bg-secondary">Hidden</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                        <i class="bi bi-pencil"></i><span class="visually-hidden">Edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}"
                                          onsubmit="return confirm('Delete this event?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i><span class="visually-hidden">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No events found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $events->links() }}
    </div>
@endsection
