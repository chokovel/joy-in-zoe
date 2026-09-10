@php
    $image = $image ?? null;
@endphp

<div class="mb-3">
    <label for="gallery_category_id" class="form-label">Category</label>
    <select class="form-select @error('gallery_category_id') is-invalid @enderror" id="gallery_category_id" name="gallery_category_id" required>
        <option value="">Select a category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('gallery_category_id', $image?->gallery_category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    <x-field-error field="gallery_category_id" />
</div>

<div class="mb-3">
    <label for="image" class="form-label">{{ $image ? 'Image' : 'Images' }}</label>
    @if ($image)
        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
        <div class="mt-2">
            <img src="{{ $image->url }}" alt="" class="img-thumbnail" style="max-height: 120px;">
        </div>
        <x-field-error field="image" />
    @else
        <input type="file" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
               id="image" name="images[]" accept="image/*" multiple required>
        <div class="form-text">Hold Ctrl (Cmd on Mac) to select multiple images at once. They will all be added to the selected category.</div>
        <div id="imagePreview" class="d-flex flex-wrap gap-2 mt-2"></div>
        <x-field-error field="images" />
    @endif
</div>

<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $image?->title) }}">
</div>

<div class="mb-4">
    <label for="alt_text" class="form-label">Alt text <span class="text-muted fw-normal">(for accessibility)</span></label>
    <input type="text" class="form-control" id="alt_text" name="alt_text" value="{{ old('alt_text', $image?->alt_text) }}">
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-brand">{{ $image ? 'Update image' : 'Upload image(s)' }}</button>
    <a href="{{ route('admin.gallery-images.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>

@if (!$image)
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('image');
            const preview = document.getElementById('imagePreview');
            if (!input || !preview) return;
            input.addEventListener('change', () => {
                preview.innerHTML = '';
                const files = Array.from(input.files);
                files.forEach(file => {
                    const url = URL.createObjectURL(file);
                    const img = document.createElement('img');
                    img.src = url;
                    img.alt = file.name;
                    img.title = file.name;
                    img.className = 'img-thumbnail';
                    img.style.maxHeight = '80px';
                    preview.appendChild(img);
                });
            });
        });
    </script>
@endif
