<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Post::class);

        $posts = Post::query()
            ->with(['category', 'user'])
            ->when($request->filled('search'), fn ($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->filled('category'), fn ($q) => $q->where('category_id', $request->category))
            ->when($request->filled('status'), function ($q) use ($request) {
                if ($request->status === 'published') {
                    $q->whereNotNull('published_at')->where('published_at', '<=', now());
                } elseif ($request->status === 'draft') {
                    $q->where(fn ($query) => $query->whereNull('published_at')->orWhere('published_at', '>', now()));
                }
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $categories = BlogCategory::orderBy('name')->get();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function create(): View
    {
        $this->authorize('create', Post::class);

        $categories = BlogCategory::orderBy('name')->get();
        $tags = BlogTag::orderBy('name')->get();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $this->authorize('create', Post::class);

        $validated = $request->safe()->only([
            'title', 'excerpt', 'body', 'category_id', 'author',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        $isDraft = strtolower($request->status ?? '') === 'draft';

        if ($isDraft) {
            $validated['published_at'] = null;
        } elseif ($request->filled('published_at')) {
            $validated['published_at'] = $request->date('published_at');
        } else {
            $validated['published_at'] = now();
        }

        $validated['slug'] = $this->uniqueSlug($validated['title']);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('blogs', 'public');
        }

        $post = Post::create($validated);

        if ($request->filled('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()
            ->route('admin.posts.index')
            ->with('status', 'Post created successfully.');
    }

    public function edit(Post $post): View
    {
        $this->authorize('update', $post);

        $post->load('tags');
        $categories = BlogCategory::orderBy('name')->get();
        $tags = BlogTag::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        $validated = $request->safe()->only([
            'title', 'excerpt', 'body', 'category_id', 'author',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->filled('slug')) {
            $validated['slug'] = Str::slug($request->slug);
        }

        $isDraft = strtolower($request->status ?? '') === 'draft';

        if ($isDraft) {
            $validated['published_at'] = null;
        } elseif ($request->filled('published_at')) {
            $validated['published_at'] = $request->date('published_at');
        } else {
            $validated['published_at'] = $post->published_at;
        }

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('blogs', 'public');
        }

        $post->update($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags ?? []);
        }

        return redirect()
            ->route('admin.posts.index')
            ->with('status', 'Post updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }

        $post->delete();

        return back()->with('status', 'Post deleted successfully.');
    }

    protected function uniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $base = $slug;
        $i = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
