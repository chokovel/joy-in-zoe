@php
    $tag = $tag ?? null;
@endphp

<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
           value="{{ old('name', $tag?->name) }}" required>
    <x-field-error field="name" />
</div>

<div class="mb-4">
    <label for="slug" class="form-label">Slug <span class="text-muted fw-normal">(optional — auto-generated from name)</span></label>
    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $tag?->slug) }}">
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-brand">{{ $tag ? 'Update tag' : 'Create tag' }}</button>
    <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
