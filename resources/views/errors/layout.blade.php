<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Error — Joy In Zoe Intercessory Ministries')</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/jpeg">
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="container text-center" style="max-width:560px;">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.jpg') }}" alt="Joy In Zoe Intercessory Ministries logo"
                     class="rounded-circle mb-4 shadow" style="width:96px;height:96px;object-fit:cover">
            </a>

            <h1 class="display-1 fw-bold text-brand mb-2">@yield('code')</h1>
            <h2 class="h4 mb-3">@yield('heading')</h2>
            <p class="text-muted mb-4">@yield('message')</p>

            <a href="{{ route('home') }}" class="btn btn-brand">Back to home</a>
        </div>
    </div>
</body>
</html>
