@php
    $user = auth()->user();
    $current = request()->route()?->getName();
@endphp

<ul class="nav flex-column gap-1">
    <li class="nav-item">
        <a class="nav-link {{ $current === 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard
        </a>
    </li>

    @if ($user->isAdmin())
        <li class="nav-item">
            <a class="nav-link {{ str_starts_with($current, 'admin.users') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people me-2"></i>Users
            </a>
        </li>
    @endif

    @if ($user->isStaff())
        <li class="nav-item mt-2">
            <span class="nav-section-label">Content</span>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ str_starts_with($current, 'admin.posts') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                <i class="bi bi-journal-text me-2"></i>Posts
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ str_starts_with($current, 'admin.categories') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                <i class="bi bi-tags me-2"></i>Categories
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ str_starts_with($current, 'admin.tags') ? 'active' : '' }}" href="{{ route('admin.tags.index') }}">
                <i class="bi bi-tag me-2"></i>Tags
            </a>
        </li>
    @endif

    @if ($user->isStaff())
        <li class="nav-item mt-2">
            <span class="nav-section-label">Outreach</span>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ str_starts_with($current, 'admin.events') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">
                <i class="bi bi-calendar-event me-2"></i>Events
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ str_starts_with($current, 'admin.subscribers') ? 'active' : '' }}" href="{{ route('admin.subscribers.index') }}">
                <i class="bi bi-envelope-open me-2"></i>Subscribers
            </a>
        </li>
    @endif

    @if ($user->isStaff())
        <li class="nav-item mt-2">
            <span class="nav-section-label">Media</span>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ str_starts_with($current, 'admin.gallery-categories') ? 'active' : '' }}" href="{{ route('admin.gallery-categories.index') }}">
                <i class="bi bi-collection me-2"></i>Gallery Categories
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ str_starts_with($current, 'admin.gallery-images') ? 'active' : '' }}" href="{{ route('admin.gallery-images.index') }}">
                <i class="bi bi-images me-2"></i>Gallery Images
            </a>
        </li>
    @endif

    <li class="nav-item mt-3">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="bi bi-globe me-2"></i>View website
        </a>
    </li>
</ul>
