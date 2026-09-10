<section id="blog" class="py-5 py-lg-6 bg-white">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5">
            <div>
                <p class="section-eyebrow mb-2">From the Blog</p>
                <h2 class="h3 fw-bold mb-0">Word, Prayers &amp; Testimonies</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="btn btn-outline-brand mt-3 mt-md-0">Read all posts</a>
        </div>

        @if ($featuredPosts->isNotEmpty())
            <div class="row g-4">
                @foreach ($featuredPosts as $post)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                            <div class="card card-hover h-100">
                                <img src="{{ $post->cover_url }}" alt="{{ $post->title }}" class="blog-card-img"
                                     loading="lazy">
                                <div class="card-body p-4">
                                    <p class="blog-meta mb-2">
                                        {{ $post->published_at->format('M j, Y') }}
                                        @if ($post->author)
                                            <span class="mx-1">·</span>{{ $post->author }}
                                        @endif
                                    </p>
                                    <h3 class="h6 fw-bold text-dark mb-2">{{ $post->title }}</h3>
                                    <p class="small text-muted mb-3">{{ $post->excerpt }}</p>
                                    <span class="btn btn-sm btn-outline-brand">Read more</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted text-center">New articles are being written. Check back soon.</p>
        @endif
    </div>
</section>
