<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard — Joy In Zoe Intercessory Ministries')</title>

    <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/jpeg">
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="admin-body">
    <div class="d-flex">
        <nav class="admin-sidebar d-none d-lg-block" style="width:260px;">
            <div class="p-3">
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-white text-decoration-none mb-4">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Joy In Zoe logo" class="rounded-circle me-2" style="width:42px;height:42px;object-fit:cover">
                    <span class="fw-bold lh-sm">
                        Joy In Zoe
                        <small class="d-block fw-normal text-white-50" style="font-size:.66rem">ADMIN</small>
                    </span>
                </a>

                @include('components.admin-nav')
            </div>
        </nav>

        <div class="flex-grow-1" style="min-width:0;">
            <header class="bg-white border-bottom sticky-top shadow-sm">
                <div class="d-flex align-items-center justify-content-between px-3 px-md-4 py-2">
                    <button class="btn btn-outline-secondary d-lg-none" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#adminOffcanvas" aria-controls="adminOffcanvas">
                        <i class="bi bi-list"></i>
                        <span class="visually-hidden">Open menu</span>
                    </button>

                    <h1 class="h5 mb-0 d-none d-md-block">@yield('header', 'Dashboard')</h1>

                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-none d-sm-inline">{{ auth()->user()->name }}</span>
                            <i class="bi bi-person-circle fs-5"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('home') }}"><i class="bi bi-globe me-2"></i>View website</a></li>
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Log out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <main class="p-3 p-md-4">
                @include('components.alert')
                @yield('content')
            </main>
        </div>
    </div>

    <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="adminOffcanvas" aria-labelledby="adminOffcanvasLabel">
        <div class="offcanvas-header bg-brand-dark">
            <h5 class="offcanvas-title text-white" id="adminOffcanvasLabel">Admin Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @include('components.admin-nav')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
