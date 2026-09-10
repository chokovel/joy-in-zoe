<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $post->title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #120e24;
            margin: 0;
            padding: 24px;
        }
        .header {
            border-bottom: 3px solid #09428f;
            padding-bottom: 12px;
            margin-bottom: 24px;
            text-align: center;
        }
        .header .ministry {
            font-size: 20px;
            font-weight: 700;
            color: #09428f;
            letter-spacing: .02em;
        }
        .header .tagline {
            font-size: 11px;
            color: #555;
            margin-top: 4px;
        }
        h1 {
            font-size: 22px;
            margin: 0 0 8px 0;
            color: #09428f;
        }
        .meta {
            font-size: 11px;
            color: #666;
            margin-bottom: 24px;
        }
        .content p {
            margin: 0 0 14px 0;
        }
        .content h2,
        .content h3 {
            color: #09428f;
        }
        .content blockquote {
            border-left: 4px solid #b30000;
            margin: 0 0 14px 0;
            padding: 4px 0 4px 14px;
            font-style: italic;
            color: #444;
        }
        .content img {
            max-width: 100%;
        }
        .footer {
            margin-top: 40px;
            padding-top: 12px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="ministry">Joy In Zoe Intercessory Ministries</div>
        <div class="tagline">Prayer &middot; Intercession &middot; Missions</div>
    </div>

    <h1>{{ $post->title }}</h1>
    <div class="meta">
        {{ $post->published_at->format('F j, Y') }}
        @if ($post->author)
            &middot; {{ $post->author }}
        @endif
        @if ($post->category)
            &middot; {{ $post->category->name }}
        @endif
    </div>

    <div class="content">
        {!! $post->body !!}
    </div>

    <div class="footer">
        {{ config('ministry.brand.name') }} &middot; {{ url('/') }}
    </div>
</body>
</html>
