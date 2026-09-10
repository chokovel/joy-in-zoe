<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogTagController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', BlogTag::class);

        $tags = BlogTag::withCount('posts')->orderBy('name')->paginate(20);

        return view('admin.tags.index', compact('tags'));
    }

    public function create(): View
    {
        $this->authorize('create', BlogTag::class);

        return view('admin.tags.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', BlogTag::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blog_tags,slug'],
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        BlogTag::create($validated);

        return redirect()
            ->route('admin.tags.index')
            ->with('status', 'Tag created successfully.');
    }

    public function edit(BlogTag $tag): View
    {
        $this->authorize('update', $tag);

        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, BlogTag $tag): RedirectResponse
    {
        $this->authorize('update', $tag);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blog_tags,slug,'.$tag->id],
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        $tag->update($validated);

        return redirect()
            ->route('admin.tags.index')
            ->with('status', 'Tag updated successfully.');
    }

    public function destroy(BlogTag $tag): RedirectResponse
    {
        $this->authorize('delete', $tag);

        $tag->delete();

        return back()->with('status', 'Tag deleted successfully.');
    }
}
