@extends('layouts.admin')

@section('title', 'Tags — Joy In Zoe Administration')
@section('header', 'Blog tags')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="text-muted mb-0">Manage the tags used to label blog posts.</p>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-brand btn-sm"><i class="bi bi-plus-lg me-1"></i>New tag</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Posts</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tags as $tag)
                        <tr>
                            <td class="fw-semibold">{{ $tag->name }}</td>
                            <td><code>{{ $tag->slug }}</code></td>
                            <td>{{ $tag->posts_count }}</td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                        <i class="bi bi-pencil"></i><span class="visually-hidden">Edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}"
                                          onsubmit="return confirm('Delete this tag?')">
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
                            <td colspan="4" class="text-center text-muted py-4">No tags yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $tags->links() }}
    </div>
@endsection
