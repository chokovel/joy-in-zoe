@extends('layouts.app')

@section('title', $category->name.' | Gallery | Joy In Zoe Intercessory Ministries')
@section('meta_description', $category->description)
@section('og_title', $category->name.' | Joy In Zoe Intercessory Ministries')
@section('og_description', $category->description)
@section('og_image', $category->cover_url)

@section('content')
    <section class="py-5 bg-brand-dark">
        <div class="container">
            <div class="text-center">
                <p class="section-eyebrow-light mb-2">Gallery</p>
                <h1 class="h2 fw-bold text-white mb-3">{{ $category->name }}</h1>
                <p class="text-white-50 mx-auto mb-0" style="max-width:640px;">{{ $category->description }}</p>
                <a href="{{ route('gallery.index') }}" class="btn btn-outline-white btn-sm mt-4">
                    <i class="bi bi-arrow-left me-2"></i>All categories
                </a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @if ($images->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-image display-4 text-muted d-block mb-3"></i>
                    <p class="text-muted mb-0">No photographs in this category yet.</p>
                </div>
            @else
                <div class="gallery-grid">
                    @foreach ($images as $image)
                        <a href="{{ $image->url }}" class="d-block" data-lightbox="gallery"
                           data-title="{{ $image->title }}">
                            <img src="{{ $image->url }}" alt="{{ $image->alt_text }}" class="gallery-img" loading="lazy">
                            {{-- @if ($image->title)
                                <span class="d-block small text-muted text-center mt-2">{{ $image->title }}</span>
                            @endif --}}
                        </a>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        {{ $images->links() }}
                    </div>

                    @endif
                </div>
    </section>
@endsection
