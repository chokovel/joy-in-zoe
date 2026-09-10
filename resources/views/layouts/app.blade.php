<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Joy In Zoe Intercessory Ministries'))</title>
    <meta name="description" content="@yield('meta_description', 'Joy In Zoe Intercessory Ministries — Reaching the Unreached Through Prayer and Outreach.')">
    <meta property="og:site_name" content="Joy In Zoe Intercessory Ministries">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', 'Raising an altar of prayer, intercession, and spiritual awakening. Reaching the unreached through prayer and outreach.')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('og_title', config('app.name'))">
    <meta name="twitter:description" content="@yield('og_description', 'Raising an altar of prayer, intercession, and spiritual awakening. Reaching the unreached through prayer and outreach.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logo.jpg'))">

    @stack('meta')

    <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/jpeg">
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    @include('components.public-navbar')

    <main>
        @yield('content')
    </main>

    @include('components.public-footer')

    @stack('scripts')
</body>
</html>
