<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Event;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display the blog listing.
     */
    public function index(Request $request)
    {
        $posts = Post::published()
            ->with('category')
            ->when($request->filled('category'), function ($q) use ($request) {
                $q->where('category_id', $request->integer('category'));
            })
            ->when($request->filled('tag'), function ($q) use ($request) {
                $q->whereHas('tags', fn ($t) => $t->where('slug', $request->tag));
            })
            ->when($request->filled('search'), fn ($q) => $q->where(function ($query) use ($request) {
                $query->where('title', 'like', "%{$request->search}%")
                    ->orWhere('body', 'like', "%{$request->search}%");
            }))
            ->orderBy('published_at', 'desc')
            ->paginate(6)
            ->withQueryString();

        $categories = BlogCategory::where('is_active', true)->withCount('publishedPosts')->orderBy('name')->get();
        $tags = BlogTag::withCount('posts')->orderBy('name')->get();

        return view('blog.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * Display a single post.
     */
    public function show(string $slug)
    {
        $post = Post::published()
            ->with(['category', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        $recent = Post::published()
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        $categories = BlogCategory::where('is_active', true)->withCount('publishedPosts')->orderBy('name')->get();
        $tags = BlogTag::withCount('posts')->orderBy('name')->get();
        $nextEvent = Event::published()->upcoming()->orderBy('starts_at')->first();
        $likesCount = $post->likes()->count();

        $likedByUser = false;
        if (auth()->check()) {
            $likedByUser = $post->likedBy()->where('users.id', auth()->id())->exists();
        }

        return view('blog.show', compact(
            'post', 'recent', 'categories', 'tags', 'nextEvent', 'likesCount', 'likedByUser'
        ));
    }
}
