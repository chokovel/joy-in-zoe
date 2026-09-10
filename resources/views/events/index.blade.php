@extends('layouts.app')

@section('title', 'Events | Joy In Zoe Intercessory Ministries')
@section('meta_description', 'Upcoming events, fellowships, and prayer gatherings at Joy In Zoe Intercessory Ministries.')
@section('og_title', 'Events | Joy In Zoe Intercessory Ministries')
@section('og_description', 'Upcoming events, fellowships, and prayer gatherings.')

@section('content')
    <section class="py-5 bg-brand-dark">
        <div class="container">
            <div class="text-center">
                <p class="section-eyebrow-light mb-2">Events</p>
                <h1 class="h2 fw-bold text-white mb-3">Come and Be Part of the Move of God</h1>
                <p class="text-white-50 mx-auto mb-0" style="max-width:640px;">
                    Fellowship, Bible study, prayer, and outreach — there is always a place for you at the altar.
                </p>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @if ($events->isNotEmpty())
                <div class="row g-4">
                    @foreach ($events as $event)
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('events.show', $event) }}" class="text-decoration-none">
                                <div class="card card-hover h-100">
                                    @if ($event->image)
                                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="card-img-top event-img" loading="lazy">
                                    @endif
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="text-center me-3">
                                                <div class="display-6 fw-bold text-accent lh-1">{{ $event->starts_at->format('d') }}</div>
                                                <div class="text-uppercase small fw-bold text-muted">{{ $event->starts_at->format('M') }}</div>
                                            </div>
                                    <div class="border-start ps-3">
                                        <h2 class="h6 fw-bold text-dark mb-1" title="{{ $event->title }}">{{ Str::limit($event->title, 40) }}</h2>
                                        <p class="small text-muted mb-0">
                                            <i class="bi bi-clock me-1"></i>{{ $event->starts_at->format('g:i A') }}
                                            @if ($event->location)
                                                <span class="mx-1">·</span>
                                                <i class="bi bi-geo-alt me-1"></i>{{ $event->location }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @if ($event->description)
                                    <p class="small text-muted mb-3 event-desc-clamp">{{ Str::limit(strip_tags($event->description), 110) }}</p>
                                @endif
                                        <span class="btn btn-sm btn-outline-brand">View details</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    {{ $events->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x display-4 text-muted d-block mb-3"></i>
                    <p class="text-muted mb-0">New event dates are being confirmed. Check back soon.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
