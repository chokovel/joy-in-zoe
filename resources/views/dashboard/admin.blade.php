@extends('layouts.admin')

@section('title', 'Admin Dashboard — Joy In Zoe Intercessory Ministries')
@section('header', 'Admin Dashboard')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4 col-xl-2">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small">Users</div>
                                <div class="fs-3 fw-bold">{{ $stats['users'] }}</div>
                            </div>
                            <i class="bi bi-people fs-2 text-muted"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <a href="{{ route('admin.posts.index') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small">Published posts</div>
                                <div class="fs-3 fw-bold">{{ $stats['publishedPosts'] }}</div>
                            </div>
                            <i class="bi bi-journal-text fs-2 text-muted"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <a href="{{ route('admin.events.index') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small">Upcoming events</div>
                                <div class="fs-3 fw-bold">{{ $stats['upcomingEvents'] }}</div>
                            </div>
                            <i class="bi bi-calendar-event fs-2 text-muted"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <a href="{{ route('admin.gallery-images.index') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small">Gallery images</div>
                                <div class="fs-3 fw-bold">{{ $stats['galleryImages'] }}</div>
                            </div>
                            <i class="bi bi-images fs-2 text-muted"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Subscribers</div>
                            <div class="fs-3 fw-bold">{{ $stats['subscribers'] }}</div>
                        </div>
                        <i class="bi bi-envelope fs-2 text-muted"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-transparent">
                    <h5 class="card-title mb-0">Recent posts</h5>
                </div>
                <div class="card-body">
                    @forelse ($recentPosts as $post)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <a href="{{ route('admin.posts.edit', $post) }}" class="fw-semibold text-decoration-none">{{ $post->title }}</a>
                                <div class="small text-muted">{{ $post->category?->name ?? 'Uncategorized' }} · {{ $post->published_at?->format('M j, Y') ?? 'Draft' }}</div>
                            </div>
                            @if ($post->published_at && $post->published_at <= now())
                                <span class="badge text-bg-success">Published</span>
                            @else
                                <span class="badge text-bg-secondary">Draft</span>
                            @endif
                        </div>
                    @empty
                        <p class="text-muted mb-0">No posts yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-transparent">
                    <h5 class="card-title mb-0">Recent events</h5>
                </div>
                <div class="card-body">
                    @forelse ($recentEvents as $event)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <a href="{{ route('admin.events.edit', $event) }}" class="fw-semibold text-decoration-none">{{ $event->title }}</a>
                                <div class="small text-muted">{{ $event->starts_at->format('M j, Y') }} · {{ $event->location ?? 'Online' }}</div>
                            </div>
                            @if ($event->is_published)
                                <span class="badge text-bg-success">Published</span>
                            @else
                                <span class="badge text-bg-secondary">Hidden</span>
                            @endif
                        </div>
                    @empty
                        <p class="text-muted mb-0">No events yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Welcome back, {{ $user->name }}</h5>
            <p class="card-text mb-0">
                This is the Joy In Zoe ministry administration area. Manage users, blog posts, events, gallery, and ministry settings from here.
            </p>
        </div>
    </div>
@endsection
