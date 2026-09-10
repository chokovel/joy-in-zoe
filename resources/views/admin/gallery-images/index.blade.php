@extends('layouts.admin')

@section('title', 'Gallery images — Joy In Zoe Administration')
@section('header', 'Gallery images')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 gap-2 flex-wrap">
        <form method="GET" action="{{ route('admin.gallery-images.index') }}" class="d-flex gap-2 flex-wrap">
            <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm"
                   placeholder="Search images" aria-label="Search images">
            <select name="category" class="form-select form-select-sm">
                <option value="">All categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-sm btn-outline-secondary" type="submit">Filter</button>
        </form>
        <a href="{{ route('admin.gallery-images.create') }}" class="btn btn-brand btn-sm"><i class="bi bi-plus-lg me-1"></i>Upload image</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($images as $image)
                        <tr>
                            <td><img src="{{ $image->url }}" alt="" class="rounded" style="width: 60px; height: 45px; object-fit: cover;"></td>
                            <td class="fw-semibold">{{ $image->title ?? '(untitled)' }}</td>
                            <td>{{ $image->category?->name ?? '—' }}</td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.gallery-images.edit', $image) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                        <i class="bi bi-pencil"></i><span class="visually-hidden">Edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.gallery-images.destroy', $image) }}"
                                          onsubmit="return confirm('Delete this image?')">
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
                            <td colspan="4" class="text-center text-muted py-4">No images found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $images->links() }}
    </div>
@endsection
