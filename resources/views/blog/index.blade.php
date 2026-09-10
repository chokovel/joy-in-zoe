@extends('layouts.app')

@section('title', 'Blog | Joy In Zoe Intercessory Ministries')
@section('meta_description', 'Word, wisdom, and testimonies from Joy In Zoe Intercessory Ministries — articles on prayer, intercession, missions, and the move of God.')
@section('og_title', 'Blog | Joy In Zoe Intercessory Ministries')
@section('og_description', 'Word, wisdom, and testimonies from Joy In Zoe Intercessory Ministries.')

@section('content')
    <section class="py-5 bg-brand-dark">
        <div class="container">
            <div class="text-center">
                <p class="section-eyebrow-light mb-2">Blog</p>
                <h1 class="h2 fw-bold text-white mb-3">Word, Prayers &amp; Testimonies</h1>
                <p class="text-white-50 mx-auto mb-0" style="max-width:640px;">
                    Articles and reflections on prayer, intercession, missions, and the move of God.
                </p>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @if ($categories->isNotEmpty())
                <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
                    <a href="{{ route('blog.index') }}"
                       class="btn btn-sm {{ ! request('category') && ! request('tag') && ! request('search') ? 'btn-brand' : 'btn-outline-brand' }}">
                        All
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category->id]) }}"
                           class="btn btn-sm {{ request('category') == $category->id ? 'btn-brand' : 'btn-outline-brand' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            @if ($posts->isNotEmpty())
                <div class="row g-4">
                    @foreach ($posts as $post)
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                                <div class="card card-hover h-100">
                                    <img src="{{ $post->cover_url }}" alt="{{ $post->title }}" class="blog-card-img"
                                         loading="lazy">
                                    <div class="card-body p-4">
                                        <p class="blog-meta mb-2">
                                            @if ($post->category)
                                                <span class="badge text-bg-brand">{{ $post->category->name }}</span>
                                            @endif
                                            {{ $post->published_at->format('M j, Y') }}
                                            @if ($post->author)
                                                <span class="mx-1">·</span>{{ $post->author }}
                                            @endif
                                        </p>
                                        <h2 class="h6 fw-bold text-dark mb-2">{{ $post->title }}</h2>
                                        <p class="small text-muted mb-3">{{ $post->excerpt }}</p>
                                        <span class="btn btn-sm btn-outline-brand">Read more</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-journal-text display-4 text-muted d-block mb-3"></i>
                    <p class="text-muted mb-0">No articles published yet. Check back soon.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
