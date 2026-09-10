@php
    $post = $post ?? null;
    $selectedTags = $post?->tags->pluck('id')->all() ?? old('tags', []);
    $selectedCategory = old('category_id', $post?->category_id);
    $status = old('status', $post && $post->published_at && $post->published_at <= now() ? 'published' : 'draft');
@endphp

<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
           value="{{ old('title', $post?->title) }}" required>
    <x-field-error field="title" />
</div>

<div class="mb-3">
    <label for="slug" class="form-label">Slug <span class="text-muted fw-normal">(optional — auto-generated from title)</span></label>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
           value="{{ old('slug', $post?->slug) }}">
    <x-field-error field="slug" />
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-select" id="category_id" name="category_id">
            <option value="">Uncategorized</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected($selectedCategory == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label for="author" class="form-label">Author</label>
        <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $post?->author) }}">
    </div>
</div>

<div class="mb-3">
    <label for="tags" class="form-label">Tags</label>
    <select class="form-select" id="tags" name="tags[]" multiple size="4">
        @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" @selected(in_array($tag->id, $selectedTags))>{{ $tag->name }}</option>
        @endforeach
    </select>
    <div class="form-text">Hold Ctrl (Cmd on Mac) to select multiple tags.</div>
</div>

<div class="mb-3">
    <label for="excerpt" class="form-label">Excerpt <span class="text-muted fw-normal">(optional — auto-generated from body)</span></label>
    <textarea class="form-control" id="excerpt" name="excerpt" rows="2">{{ old('excerpt', $post?->excerpt) }}</textarea>
</div>

<div class="mb-3">
    <label for="body" class="form-label">Content</label>
    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="14">{{ old('body', $post?->body) }}</textarea>
    <div class="form-text">Write in plain text or HTML. Use <code>&lt;h2&gt;</code>, <code>&lt;p&gt;</code>, <code>&lt;strong&gt;</code>, <code>&lt;em&gt;</code>, <code>&lt;ul&gt;</code>, <code>&lt;ol&gt;</code>, <code>&lt;li&gt;</code>, <code>&lt;blockquote&gt;</code>, <code>&lt;img&gt;</code> and <code>&lt;a&gt;</code> tags.</div>
    <x-field-error field="body" />
</div>

<div class="mb-3">
    <label for="cover_image" class="form-label">Cover image</label>
    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*">
    @if ($post && $post->cover_image)
        <div class="mt-2">
            <img src="{{ $post->cover_url }}" alt="Current cover" class="img-thumbnail" style="max-height: 120px;">
        </div>
    @endif
    <x-field-error field="cover_image" />
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status">
            <option value="published" @selected($status === 'published')>Published</option>
            <option value="draft" @selected($status === 'draft')>Draft</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="published_at" class="form-label">Publish date <span class="text-muted fw-normal">(optional — now if blank)</span></label>
        <input type="datetime-local" class="form-control" id="published_at" name="published_at"
               value="{{ old('published_at', $post?->published_at?->format('Y-m-d\TH:i')) }}">
        <x-field-error field="published_at" />
    </div>
</div>

<div class="form-check mb-4">
    <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1"
           @checked(old('is_featured', $post?->is_featured))>
    <label class="form-check-label" for="is_featured">Feature this post on the homepage</label>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-brand">{{ $post ? 'Update post' : 'Create post' }}</button>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Cancel</a>
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
            const form = document.querySelector('form[action*="posts"]');
            const body = document.getElementById('body');
            if (!body || !form) {
                return;
            }

            const syncEditor = () => {
                if (window.tinymce && tinymce.get('body')) {
                    tinymce.get('body').save();
                }
            };

            form.addEventListener('submit', () => {
                syncEditor();
            });

            if (!window.tinymce) {
                return;
            }

            try {
                tinymce.init({
                    selector: '#body',
                    license_key: @json(config('ministry.tinymce.license_key')),
                    height: 420,
                    menubar: false,
                    plugins: 'lists link image code wordcount',
                    toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image | removeformat | code',
                    branding: false,
                    setup: (editor) => {
                        editor.on('input change blur', () => {
                            body.value = editor.getContent();
                        });
                    },
                });
            } catch (e) {
                body.hidden = false;
            }
        });
    </script>
@endpush
