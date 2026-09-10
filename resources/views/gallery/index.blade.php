@extends('layouts.app')

@section('title', 'Gallery | Joy In Zoe Intercessory Ministries')
@section('meta_description', 'Browse photographs from Joy In Zoe Intercessory Ministries fellowships and outreaches across Nigeria.')
@section('og_title', 'Gallery | Joy In Zoe Intercessory Ministries')
@section('og_description', 'Browse photographs from Joy In Zoe Intercessory Ministries fellowships and outreaches across Nigeria.')

@section('content')
    <section class="py-5 bg-brand-dark">
        <div class="container">
            <div class="text-center">
                <p class="section-eyebrow-light mb-2">Gallery</p>
                <h1 class="h2 fw-bold text-white mb-3">Glimpses of the Ministry</h1>
                <p class="text-white-50 mx-auto mb-0" style="max-width:640px;">
                    Choose a category to browse photographs from our fellowships, prayer gatherings, and outreaches.
                </p>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @if ($categories->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-image display-4 text-muted d-block mb-3"></i>
                    <p class="text-muted mb-0">No gallery categories yet. Check back soon.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($categories as $category)
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('gallery.show', $category->slug) }}" class="text-decoration-none">
                                <div class="card card-hover h-100">
                                    <div class="position-relative">
                                        <img src="{{ $category->cover_url }}" alt="{{ $category->name }}"
                                             class="gallery-category-cover" loading="lazy">
                                        <span class="badge bg-accent position-absolute top-0 end-0 m-3">
                                            {{ $category->published_images_count }} {{ Str::plural('photo', $category->published_images_count) }}
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <h2 class="h6 fw-bold mb-1">{{ $category->name }}</h2>
                                        <p class="small text-muted mb-0">{{ $category->description }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
