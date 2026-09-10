<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventRequest;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Event::class);

        $events = Event::query()
            ->when($request->filled('search'), fn ($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->filled('filter'), function ($q) use ($request) {
                if ($request->filter === 'upcoming') {
                    $q->where('starts_at', '>=', now()->startOfDay());
                } elseif ($request->filter === 'past') {
                    $q->where('starts_at', '<', now()->startOfDay());
                }
            })
            ->orderBy('starts_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        $this->authorize('create', Event::class);

        return view('admin.events.create');
    }

    public function store(EventRequest $request): RedirectResponse
    {
        $this->authorize('create', Event::class);

        $validated = $request->safe()->only([
            'title', 'slug', 'description', 'location', 'starts_at', 'ends_at', 'link', 'link_text', 'is_published',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $validated['slug'] = $validated['slug'] ?? null;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('status', 'Event created successfully.');
    }

    public function edit(Event $event): View
    {
        $this->authorize('update', $event);

        return view('admin.events.edit', compact('event'));
    }

    public function update(EventRequest $request, Event $event): RedirectResponse
    {
        $this->authorize('update', $event);

        $validated = $request->safe()->only([
            'title', 'slug', 'description', 'location', 'starts_at', 'ends_at', 'link', 'link_text', 'is_published',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $validated['slug'] = $validated['slug'] ?? null;

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('status', 'Event updated successfully.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->authorize('delete', $event);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return back()->with('status', 'Event deleted successfully.');
    }
}
