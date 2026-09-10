<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;
use App\Services\YouTubeService;

class HomeController extends Controller
{
    /**
     * Show the homepage.
     */
    public function index(YouTubeService $youtube)
    {
        $featuredPosts = Post::published()
            ->where('is_featured', true)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        if ($featuredPosts->count() < 3) {
            $additional = Post::published()
                ->orderBy('published_at', 'desc')
                ->whereNotIn('id', $featuredPosts->pluck('id'))
                ->limit(3 - $featuredPosts->count())
                ->get();

            $featuredPosts = $featuredPosts->merge($additional)->take(3);
        }

        return view('home', [
            'events' => Event::published()->upcoming()->orderBy('starts_at')->limit(3)->get(),
            'featuredPosts' => $featuredPosts,
            'youtubeVideos' => $youtube->recentVideoIds(),
        ]);
    }
}
