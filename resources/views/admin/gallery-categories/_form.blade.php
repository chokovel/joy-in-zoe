@php
    $category = $category ?? null;
@endphp

<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
           value="{{ old('name', $category?->name) }}" required>
    <x-field-error field="name" />
</div>

<div class="mb-3">
    <label for="slug" class="form-label">Slug <span class="text-muted fw-normal">(optional — auto-generated from name)</span></label>
    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $category?->slug) }}">
</div>

<div class="mb-3">
    <label for="cover_image" class="form-label">Cover image</label>
    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*">
    @if ($category && $category->cover_image)
        <div class="mt-2">
            <img src="{{ $category->cover_url }}" alt="" class="img-thumbnail" style="max-height: 120px;">
        </div>
    @endif
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category?->description) }}</textarea>
</div>

<div class="form-check mb-4">
    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
           @checked((bool) old('is_active', $category?->is_active ?? true))>
    <label class="form-check-label" for="is_active">Active</label>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-brand">{{ $category ? 'Update category' : 'Create category' }}</button>
    <a href="{{ route('admin.gallery-categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
