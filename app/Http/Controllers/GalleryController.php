<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display gallery categories, each with its cover photo.
     */
    public function index()
    {
        $categories = GalleryCategory::where('is_active', true)
            ->withCount('publishedImages')
            ->orderBy('name')
            ->get();

        return view('gallery.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Display all photos within a category.
     */
    public function show(Request $request, string $slug)
    {
        $category = GalleryCategory::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $images = GalleryImage::where('gallery_category_id', $category->id)
            ->where('is_published', true)
            ->latest()
            ->paginate(24)
            ->withQueryString();

        return view('gallery.show', [
            'category' => $category,
            'images' => $images,
        ]);
    }
}
