<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of published events.
     */
    public function index(Request $request)
    {
        $events = Event::published()
            ->orderBy('starts_at', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('events.index', compact('events'));
    }

    /**
     * Display a single event in full detail.
     */
    public function show(string $slug)
    {
        $event = Event::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $upcoming = Event::published()
            ->where('id', '!=', $event->id)
            ->orderBy('starts_at', 'desc')
            ->limit(3)
            ->get();

        return view('events.show', compact('event', 'upcoming'));
    }
}
