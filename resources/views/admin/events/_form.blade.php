@php
    $event = $event ?? null;
@endphp

<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
           value="{{ old('title', $event?->title) }}" required>
    <x-field-error field="title" />
</div>

<div class="mb-3">
    <label for="slug" class="form-label">Slug <span class="text-muted fw-normal">(optional — auto-generated from title)</span></label>
    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $event?->slug) }}">
    <x-field-error field="slug" />
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $event?->description) }}</textarea>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label for="starts_at" class="form-label">Starts <span class="text-danger">*</span></label>
        <input type="datetime-local" class="form-control @error('starts_at') is-invalid @enderror" id="starts_at" name="starts_at"
               value="{{ old('starts_at', $event?->starts_at?->format('Y-m-d\TH:i')) }}" required>
        <x-field-error field="starts_at" />
    </div>
    <div class="col-md-6">
        <label for="ends_at" class="form-label">Ends</label>
        <input type="datetime-local" class="form-control" id="ends_at" name="ends_at"
               value="{{ old('ends_at', $event?->ends_at?->format('Y-m-d\TH:i')) }}">
    </div>
</div>

<div class="mb-3">
    <label for="location" class="form-label">Location</label>
    <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $event?->location) }}">
</div>

<div class="mb-3">
    <label for="image" class="form-label">Banner image</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/*">
    @if ($event && $event->image)
        <div class="mt-2">
            <img src="{{ $event->image_url }}" alt="Event image" class="img-thumbnail" style="max-height: 120px;">
        </div>
    @endif
    <x-field-error field="image" />
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label for="link" class="form-label">Link</label>
        <input type="url" class="form-control" id="link" name="link" value="{{ old('link', $event?->link) }}">
    </div>
    <div class="col-md-6">
        <label for="link_text" class="form-label">Link text</label>
        <input type="text" class="form-control" id="link_text" name="link_text" value="{{ old('link_text', $event?->link_text) }}">
    </div>
</div>

<div class="form-check mb-4">
    <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1"
           @checked((bool) old('is_published', $event?->is_published ?? true))>
    <label class="form-check-label" for="is_published">Published (visible on the website)</label>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-brand">{{ $event ? 'Update event' : 'Create event' }}</button>
    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>

@push('scripts')
    @once
        @php
            $tm = config('ministry.tinymce');
        @endphp
        <script src="{{ $tm['api_key'] ? $tm['base_url'].$tm['api_key'].'/tinymce/7/tinymce.min.js' : 'https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js' }}"></script>
    @endonce
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.tinymce) {
                tinymce.init({
                    selector: '#description',
                    license_key: @json(config('ministry.tinymce.license_key')),
                    height: 320,
                    menubar: false,
                    plugins: 'lists link image code wordcount',
                    toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image | removeformat | code',
                    branding: false,
                });
            }
        });
    </script>
@endpush
