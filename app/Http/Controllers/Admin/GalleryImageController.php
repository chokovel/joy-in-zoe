<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryImageRequest;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryImageController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', GalleryImage::class);

        $images = GalleryImage::query()
            ->with('category')
            ->when($request->filled('category'), fn ($q) => $q->where('gallery_category_id', $request->category))
            ->when($request->filled('search'), fn ($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->latest()
            ->paginate(24)
            ->withQueryString();

        $categories = GalleryCategory::orderBy('name')->get();

        return view('admin.gallery-images.index', compact('images', 'categories'));
    }

    public function create(): View
    {
        $this->authorize('create', GalleryImage::class);

        $categories = GalleryCategory::orderBy('name')->get();

        return view('admin.gallery-images.create', compact('categories'));
    }

    public function store(GalleryImageRequest $request): RedirectResponse
    {
        $this->authorize('create', GalleryImage::class);

        $validated = $request->safe()->only([
            'gallery_category_id', 'title', 'alt_text',
        ]);

        $count = 0;
        foreach ($request->file('images', []) as $file) {
            GalleryImage::create(array_merge($validated, [
                'path' => $file->store('gallery', 'public'),
                'filename' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'is_published' => true,
            ]));
            $count++;
        }

        return redirect()
            ->route('admin.gallery-images.index')
            ->with('status', $count.' image'.($count === 1 ? '' : 's').' uploaded successfully.');
    }

    public function edit(GalleryImage $gallery_image): View
    {
        $this->authorize('update', $gallery_image);

        $categories = GalleryCategory::orderBy('name')->get();

        return view('admin.gallery-images.edit', ['image' => $gallery_image, 'categories' => $categories]);
    }

    public function update(GalleryImageRequest $request, GalleryImage $gallery_image): RedirectResponse
    {
        $this->authorize('update', $gallery_image);

        $validated = $request->safe()->only([
            'gallery_category_id', 'title', 'alt_text',
        ]);

        if ($request->hasFile('image')) {
            if ($gallery_image->path) {
                Storage::disk('public')->delete($gallery_image->path);
            }
            $file = $request->file('image');
            $validated['path'] = $file->store('gallery', 'public');
            $validated['filename'] = $file->getClientOriginalName();
            $validated['mime_type'] = $file->getMimeType();
            $validated['size'] = $file->getSize();
        }

        $gallery_image->update($validated);

        return redirect()
            ->route('admin.gallery-images.index')
            ->with('status', 'Image updated successfully.');
    }

    public function destroy(GalleryImage $gallery_image): RedirectResponse
    {
        $this->authorize('delete', $gallery_image);

        if ($gallery_image->path) {
            Storage::disk('public')->delete($gallery_image->path);
        }
        $gallery_image->delete();

        return back()->with('status', 'Image deleted successfully.');
    }
}
