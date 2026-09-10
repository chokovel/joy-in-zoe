<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\GalleryImage;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the authenticated user's dashboard.
     */
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $stats = [
                'users' => User::count(),
                'posts' => Post::count(),
                'publishedPosts' => Post::whereNotNull('published_at')->where('published_at', '<=', now())->count(),
                'upcomingEvents' => Event::published()->upcoming()->count(),
                'galleryImages' => GalleryImage::count(),
                'subscribers' => Subscriber::where('is_active', true)->count(),
            ];

            $recentPosts = Post::with('category')->latest()->limit(5)->get();
            $recentEvents = Event::latest()->limit(5)->get();

            return view('dashboard.admin', compact('user', 'stats', 'recentPosts', 'recentEvents'));
        }

        if ($user->isManager()) {
            return view('dashboard.manager', ['user' => $user]);
        }

        return view('dashboard.user', ['user' => $user]);
    }
}
