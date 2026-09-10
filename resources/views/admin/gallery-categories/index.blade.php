@extends('layouts.admin')

@section('title', 'Gallery categories — Joy In Zoe Administration')
@section('header', 'Gallery categories')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="text-muted mb-0">Manage the photo categories shown in the public gallery.</p>
        <a href="{{ route('admin.gallery-categories.create') }}" class="btn btn-brand btn-sm"><i class="bi bi-plus-lg me-1"></i>New category</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Images</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>
                                @if ($category->cover_url)
                                    <img src="{{ $category->cover_url }}" alt="" class="rounded" style="width: 60px; height: 45px; object-fit: cover;">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>{{ $category->images_count }}</td>
                            <td>
                                @if ($category->is_active)
                                    <span class="badge text-bg-success">Active</span>
                                @else
                                    <span class="badge text-bg-secondary">Hidden</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.gallery-categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                        <i class="bi bi-pencil"></i><span class="visually-hidden">Edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.gallery-categories.destroy', $category) }}"
                                          onsubmit="return confirm('Delete this gallery category?')">
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
                            <td colspan="6" class="text-center text-muted py-4">No gallery categories yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $categories->links() }}
    </div>
@endsection
