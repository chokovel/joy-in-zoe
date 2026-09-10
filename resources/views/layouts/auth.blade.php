<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Joy In Zoe Intercessory Ministries'))</title>

    <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/jpeg">
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="container" style="max-width: 460px;">
            <div class="text-center mb-4">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Joy In Zoe Intercessory Ministries logo"
                         class="rounded-circle mb-3 shadow" style="width:84px;height:84px;object-fit:cover">
                </a>
                <h1 class="h4 mb-0">Joy In Zoe</h1>
                <p class="text-muted small">Intercessory Ministries</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    @include('components.alert')
                    @yield('content')
                </div>
            </div>

            <p class="text-center text-muted small mt-4 mb-0">
                &copy; {{ date('Y') }} Joy In Zoe Intercessory Ministries
            </p>
        </div>
    </div>
</body>
</html>
