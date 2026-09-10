<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryCategoryController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', GalleryCategory::class);

        $categories = GalleryCategory::withCount('images')->orderBy('name')->paginate(20);

        return view('admin.gallery-categories.index', compact('categories'));
    }

    public function create(): View
    {
        $this->authorize('create', GalleryCategory::class);

        return view('admin.gallery-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', GalleryCategory::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:gallery_categories,slug'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('gallery/covers', 'public');
        }

        GalleryCategory::create($validated);

        return redirect()
            ->route('admin.gallery-categories.index')
            ->with('status', 'Gallery category created successfully.');
    }

    public function edit(GalleryCategory $gallery_category): View
    {
        $this->authorize('update', $gallery_category);

        return view('admin.gallery-categories.edit', ['category' => $gallery_category]);
    }

    public function update(Request $request, GalleryCategory $gallery_category): RedirectResponse
    {
        $this->authorize('update', $gallery_category);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:gallery_categories,slug,'.$gallery_category->id],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            if ($gallery_category->cover_image) {
                Storage::disk('public')->delete($gallery_category->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('gallery/covers', 'public');
        }

        $gallery_category->update($validated);

        return redirect()
            ->route('admin.gallery-categories.index')
            ->with('status', 'Gallery category updated successfully.');
    }

    public function destroy(GalleryCategory $gallery_category): RedirectResponse
    {
        $this->authorize('delete', $gallery_category);

        $gallery_category->delete();

        return back()->with('status', 'Gallery category deleted successfully.');
    }
}
