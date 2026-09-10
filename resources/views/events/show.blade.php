@extends('layouts.app')

@section('title', $event->title.' | Joy In Zoe Intercessory Ministries')
@section('meta_description', $event->description)
@section('og_title', $event->title)
@section('og_description', $event->description)
@section('og_image', $event->image_url ?: asset('images/logo.jpg'))

@section('content')
    <section class="py-5 bg-brand-dark">
        <div class="container">
            <div class="mx-auto" style="max-width:820px;">
                <p class="section-eyebrow-light mb-2">Events</p>
                <h1 class="h2 fw-bold text-white mb-3">{{ $event->title }}</h1>
                <p class="text-white-50 mb-0">
                    <i class="bi bi-calendar-event me-1"></i>{{ $event->starts_at->format('F j, Y') }}
                    @if ($event->location)
                        <span class="mx-2">·</span><i class="bi bi-geo-alt me-1"></i>{{ $event->location }}
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
                        @if ($event->image)
                            <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="img-fluid rounded-3 mb-4 w-100 event-show-img">
                        @endif

                        <div class="d-flex flex-wrap gap-3 mb-4 pb-4 border-bottom">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar-event fs-4 text-accent me-2"></i>
                                <div>
                                    <div class="small text-muted">Date</div>
                                    <div class="fw-semibold">{{ $event->starts_at->format('F j, Y') }}</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock fs-4 text-accent me-2"></i>
                                <div>
                                    <div class="small text-muted">Time</div>
                                    <div class="fw-semibold">{{ $event->starts_at->format('g:i A') }}@if ($event->ends_at) – {{ $event->ends_at->format('g:i A') }}@endif</div>
                                </div>
                            </div>
                            @if ($event->location)
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-geo-alt fs-4 text-accent me-2"></i>
                                    <div>
                                        <div class="small text-muted">Location</div>
                                        <div class="fw-semibold">{{ $event->location }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if ($event->description)
                            <div class="fs-6 lh-lg">
                                {!! $event->description_html !!}
                            </div>
                        @endif

                        <div class="d-flex flex-wrap align-items-center gap-2 mt-4 pt-4 border-top">
                            @if ($event->link)
                                <a href="{{ $event->link }}" target="_blank" rel="noopener" class="btn btn-brand">
                                    <i class="bi bi-box-arrow-up-right me-1"></i>{{ $event->link_text ?? 'Find out more' }}
                                </a>
                            @endif

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
                                        <button class="dropdown-item" type="button" data-copy-link>
                                            <i class="bi bi-link-45deg me-2"></i>Copy link
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>All events
                            </a>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-4 event-sidebar-card">
                        <div class="card-body">
                            <h3 class="h6 fw-bold mb-2">Event details</h3>
                            <ul class="list-unstyled small mb-0">
                                <li class="d-flex mb-2">
                                    <i class="bi bi-calendar-event me-2 text-accent"></i>
                                    <span>{{ $event->starts_at->format('l, F j, Y') }}</span>
                                </li>
                                <li class="d-flex mb-2">
                                    <i class="bi bi-clock me-2 text-accent"></i>
                                    <span>{{ $event->starts_at->format('g:i A') }}@if ($event->ends_at) – {{ $event->ends_at->format('g:i A') }}@endif</span>
                                </li>
                                @if ($event->location)
                                    <li class="d-flex mb-2">
                                        <i class="bi bi-geo-alt me-2 text-accent"></i>
                                        <span>{{ $event->location }}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="card mb-4 ad-placeholder">
                        <div class="card-body text-center text-muted py-4">
                            <small>Advertisement</small>
                            <div class="ad-slot">
                                <span>Google Ad placeholder</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($upcoming->isNotEmpty())
        <section class="py-5 bg-soft">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 fw-bold mb-0">More events</h2>
                    <a href="{{ route('events.index') }}" class="btn btn-outline-brand btn-sm">View all</a>
                </div>
                <div class="row g-4">
                    @foreach ($upcoming as $event)
                        <div class="col-md-4">
                            <a href="{{ route('events.show', $event) }}" class="text-decoration-none">
                                <div class="card card-hover h-100">
                                    @if ($event->image)
                                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="card-img-top event-img" loading="lazy">
                                    @endif
                                    <div class="card-body p-4">
                                        <h3 class="h6 fw-bold text-dark mb-2" title="{{ $event->title }}">{{ Str::limit($event->title, 40) }}</h3>
                                        <p class="small text-muted mb-0">
                                            <i class="bi bi-calendar me-1"></i>{{ $event->starts_at->format('M j, Y') }}
                                        </p>
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
            const pageUrl = window.location.href;
            const pageTitle = {{ Illuminate\Support\Js::from($event->title) }};

            const shareLinks = document.querySelectorAll('.share-link[data-share]');
            shareLinks.forEach(link => {
                const type = link.dataset.share;
                let href = '#';
                switch (type) {
                    case 'facebook':
                        href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(pageUrl)}`;
                        break;
                    case 'whatsapp':
                        href = `https://wa.me/?text=${encodeURIComponent(pageTitle + ' — ' + pageUrl)}`;
                        break;
                    case 'twitter':
                        href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(pageUrl)}&text=${encodeURIComponent(pageTitle)}`;
                        break;
                    case 'telegram':
                        href = `https://t.me/share/url?url=${encodeURIComponent(pageUrl)}&text=${encodeURIComponent(pageTitle)}`;
                        break;
                }
                link.href = href;
            });

            const copyBtn = document.querySelector('[data-copy-link]');
            if (copyBtn) {
                copyBtn.addEventListener('click', async () => {
                    try {
                        await navigator.clipboard.writeText(pageUrl);
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
