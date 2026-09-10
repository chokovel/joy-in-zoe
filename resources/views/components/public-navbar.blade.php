@php
    $currentRoute = request()->route()?->getName();
    $navItems = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'Events', 'route' => 'events.index'],
        ['label' => 'Missions', 'route' => 'missions'],
        ['label' => 'Gallery', 'route' => 'gallery.index'],
        ['label' => 'Blog', 'route' => 'blog.index'],
        ['label' => 'Contact', 'route' => 'contact'],
    ];
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Joy In Zoe Intercessory Ministries logo" class="rounded-circle me-2">
            <span class="d-none d-sm-inline">
                Joy In Zoe
                <small class="d-block fw-normal text-muted" style="font-size:.68rem;letter-spacing:.08em">INTERCESSORY MINISTRIES</small>
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
            <ul class="navbar-nav align-items-lg-center">
                @foreach ($navItems as $item)
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute === $item['route'] && !isset($item['anchor']) ? 'active' : '' }}"
                           href="{{ isset($item['anchor']) ? route($item['route']).'#'.$item['anchor'] : route($item['route']) }}">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="d-flex align-items-center ms-auto ms-lg-0">
            @auth
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Log out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a class="btn btn-brand btn-sm" href="{{ route('login') }}" target="_blank">Log in</a>
            @endauth
        </div>
    </div>
</nav>
