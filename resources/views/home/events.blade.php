<section id="events" class="py-5 py-lg-6">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-eyebrow mb-2">Upcoming Events</p>
            <h2 class="h3 fw-bold">Come and Be Part of the Move of God</h2>
            <p class="text-muted mx-auto" style="max-width:680px;">
                Fellowship, Bible study, prayer, and outreach — there is always a place for you at the altar.
            </p>
        </div>

        @if ($events->isNotEmpty())
            <div class="row g-4">
                @foreach ($events as $event)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-hover h-100">
                            @if ($event->image)
                                <a href="{{ route('events.show', $event) }}">
                                    <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="card-img-top event-img" loading="lazy">
                                </a>
                            @endif
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="text-center me-3">
                                        <div class="display-6 fw-bold text-accent lh-1">{{ $event->starts_at->format('d') }}</div>
                                        <div class="text-uppercase small fw-bold text-muted">{{ $event->starts_at->format('M') }}</div>
                                    </div>
                                    <div class="border-start ps-3">
                                        <h3 class="h6 fw-bold mb-1" title="{{ $event->title }}">
                                            <a href="{{ route('events.show', $event) }}" class="text-decoration-none text-dark">{{ Str::limit($event->title, 40) }}</a>
                                        </h3>
                                        <p class="small text-muted mb-0">
                                            <i class="bi bi-clock me-1"></i>{{ $event->starts_at->format('g:i A') }}
                                            <span class="mx-1">·</span>
                                            <i class="bi bi-geo-alt me-1"></i>{{ $event->location }}
                                        </p>
                                    </div>
                                </div>
                                <p class="small text-muted mb-3 event-desc-clamp">{{ Str::limit(strip_tags($event->description), 110) }}</p>
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('events.show', $event) }}" class="btn btn-outline-brand btn-sm">View details</a>
                                    @if ($event->link)
                                        <a href="{{ $event->link }}" target="_blank" rel="noopener" class="btn btn-outline-secondary btn-sm">
                                            {{ $event->link_text ?? 'Find out more' }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted text-center">New event dates are being confirmed. Check back soon.</p>
        @endif
    </div>
</section>
