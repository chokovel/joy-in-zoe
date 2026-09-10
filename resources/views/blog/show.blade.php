@extends('layouts.app')

@section('title', $post->title.' | Joy In Zoe Intercessory Ministries')
@section('meta_description', $post->excerpt)
@section('og_title', $post->title)
@section('og_description', $post->excerpt)
@section('og_image', $post->cover_url)

@section('content')
    <section class="py-5 bg-brand-dark">
        <div class="container">
            <div class="mx-auto" style="max-width:820px;">
                <p class="section-eyebrow-light mb-2">Blog</p>
                <h1 class="h2 fw-bold text-white mb-3">{{ $post->title }}</h1>
                <p class="text-white-50 mb-0">
                    {{ $post->published_at->format('F j, Y') }}
                    @if ($post->author)
                        <span class="mx-1">·</span>{{ $post->author }}
                    @endif
                </p>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <article class="bg-white rounded-4 shadow-sm p-4 p-lg-5">
                        <img src="{{ $post->cover_url }}" alt="{{ $post->title }}" class="img-fluid rounded-3 mb-4">
                        <div class="fs-6 lh-lg">
                            {!! $post->body !!}
                        </div>

                        @if ($post->tags->isNotEmpty())
                            <div class="d-flex flex-wrap gap-2 mt-4 pt-4 border-top">
                                @foreach ($post->tags as $tag)
                                    <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}"
                                       class="badge text-bg-soft-brand text-decoration-none">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        @endif

                        <div class="d-flex flex-wrap align-items-center gap-2 mt-4">
                            <button type="button" class="btn btn-outline-brand" id="like-btn"
                                    data-post="{{ $post->id }}"
                                    data-liked="{{ $likedByUser ? '1' : '0' }}"
                                    @guest disabled @endguest>
                                <i class="bi {{ $likedByUser ? 'bi-heart-fill' : 'bi-heart' }} me-1" id="like-icon"></i>
                                <span id="like-count">{{ $likesCount }}</span>
                            </button>

                            <button type="button" class="btn btn-outline-brand" id="tts-btn">
                                <i class="bi bi-volume-up me-1" id="tts-icon"></i><span id="tts-label">Listen</span>
                            </button>

                            <a href="{{ route('blog.pdf', $post->slug) }}" class="btn btn-outline-brand">
                                <i class="bi bi-download me-1"></i>PDF
                            </a>

                            <div class="dropdown">
                                <button class="btn btn-outline-brand dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-share me-1"></i>Share
                                </button>
                                <ul class="dropdown-menu share-menu">
                                    <li>
                                        <a class="dropdown-item share-link" target="_blank" rel="noopener" data-share="facebook" href="#">
                                            <i class="bi bi-facebook me-2 text-primary"></i>Facebook
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item share-link" target="_blank" rel="noopener" data-share="whatsapp" href="#">
                                            <i class="bi bi-whatsapp me-2 text-success"></i>WhatsApp
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item share-link" target="_blank" rel="noopener" data-share="twitter" href="#">
                                            <i class="bi bi-twitter-x me-2"></i>X (Twitter)
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item share-link" target="_blank" rel="noopener" data-share="telegram" href="#">
                                            <i class="bi bi-telegram me-2 text-info"></i>Telegram
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <button class="dropdown-item" type="button" id="copy-link-btn">
                                            <i class="bi bi-link-45deg me-2"></i>Copy link
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </article>

                    <div class="d-flex gap-3 flex-wrap mt-4">
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-brand">
                            <i class="bi bi-arrow-left me-2"></i>All posts
                        </a>
                        <a href="{{ route('home') }}#join" class="btn btn-brand">Join the ministry</a>
                    </div>
                </div>

                <div class="col-lg-4 blog-sidebar">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" action="{{ route('blog.index') }}" class="d-flex gap-2">
                                <input type="search" name="search" class="form-control" placeholder="Search articles..." value="{{ request('search') }}">
                                <button class="btn btn-brand" type="submit" aria-label="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    @if ($categories->isNotEmpty())
                        <div class="card mb-4">
                            <div class="card-header bg-transparent fw-semibold">Categories</div>
                            <ul class="list-group list-group-flush">
                                @foreach ($categories as $category)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('blog.index', ['category' => $category->id]) }}" class="text-decoration-none">{{ $category->name }}</a>
                                        <span class="badge text-bg-light">{{ $category->published_posts_count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($tags->isNotEmpty())
                        <div class="card mb-4">
                            <div class="card-header bg-transparent fw-semibold">Tags</div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($tags as $tag)
                                        <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}"
                                           class="badge text-bg-soft-brand text-decoration-none">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($nextEvent)
                        <div class="card mb-4 event-sidebar-card">
                            @if ($nextEvent->image)
                                <img src="{{ $nextEvent->image_url }}" alt="{{ $nextEvent->title }}" class="card-img-top event-sidebar-img">
                            @endif
                            <div class="card-body">
                                <div class="text-uppercase small fw-bold text-accent mb-1">Upcoming event</div>
                                <h3 class="h6 fw-bold mb-2">{{ $nextEvent->title }}</h3>
                                <p class="small text-muted mb-2">
                                    <i class="bi bi-calendar me-1"></i>{{ $nextEvent->starts_at->format('F j, Y') }}
                                    @if ($nextEvent->location)
                                        <br><i class="bi bi-geo-alt me-1"></i>{{ $nextEvent->location }}
                                    @endif
                                </p>
                                <a href="{{ route('events.show', $nextEvent) }}" class="btn btn-sm btn-brand">View details</a>
                            </div>
                        </div>
                    @endif

                    <div class="card mb-4 ad-placeholder">
                        <div class="card-body text-center text-muted py-4">
                            <small>Advertisement</small>
                            <div class="ad-slot">
                                <span>Google Ad placeholder</span>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 bg-brand-dark text-white border-0 subscribe-card">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success mb-2 py-2 small">
                                    <i class="bi bi-check-circle me-1"></i>{{ session('status') }}
                                </div>
                            @endif
                            <h3 class="h6 fw-bold mb-1">Subscribe to updates</h3>
                            <p class="small text-white-50 mb-3">Get new articles and ministry updates by email.</p>
                            <form method="POST" action="{{ route('blog.subscribe') }}" class="d-flex flex-column gap-2">
                                @csrf
                                <input type="email" name="email" class="form-control" placeholder="Your email address" required>
                                @error('email')
                                    <span class="small text-danger">{{ $message }}</span>
                                @enderror
                                <button type="submit" class="btn btn-highlight w-100">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($recent->isNotEmpty())
        <section class="py-5 bg-soft">
            <div class="container">
                <h2 class="h4 fw-bold mb-4">Recent posts</h2>
                <div class="row g-4">
                    @foreach ($recent as $post)
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                                <div class="card card-hover h-100">
                                    <img src="{{ $post->cover_url }}" alt="{{ $post->title }}" class="blog-card-img"
                                         loading="lazy">
                                    <div class="card-body p-4">
                                        <h3 class="h6 fw-bold text-dark mb-2">{{ $post->title }}</h3>
                                        <p class="small text-muted mb-0">{{ $post->published_at->format('M j, Y') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const postUrl = window.location.href;
            const postTitle = {{ Illuminate\Support\Js::from($post->title) }};

            const shareLinks = document.querySelectorAll('.share-link[data-share]');
            shareLinks.forEach(link => {
                const type = link.dataset.share;
                let href = '#';
                switch (type) {
                    case 'facebook':
                        href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(postUrl)}`;
                        break;
                    case 'whatsapp':
                        href = `https://wa.me/?text=${encodeURIComponent(postTitle + ' — ' + postUrl)}`;
                        break;
                    case 'twitter':
                        href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(postUrl)}&text=${encodeURIComponent(postTitle)}`;
                        break;
                    case 'telegram':
                        href = `https://t.me/share/url?url=${encodeURIComponent(postUrl)}&text=${encodeURIComponent(postTitle)}`;
                        break;
                }
                link.href = href;
            });

            const copyBtn = document.getElementById('copy-link-btn');
            if (copyBtn) {
                copyBtn.addEventListener('click', async () => {
                    try {
                        await navigator.clipboard.writeText(postUrl);
                        copyBtn.innerHTML = '<i class="bi bi-check2 me-2"></i>Link copied!';
                        setTimeout(() => {
                            copyBtn.innerHTML = '<i class="bi bi-link-45deg me-2"></i>Copy link';
                        }, 2000);
                    } catch (e) {
                        copyBtn.innerHTML = '<i class="bi bi-x me-2"></i>Copy failed';
                    }
                });
            }
        });
    </script>
@endsection
