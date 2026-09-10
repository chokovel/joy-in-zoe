<section id="gallery" class="py-5 py-lg-6 bg-soft">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5">
            <div>
                <p class="section-eyebrow mb-2">Outreach Gallery</p>
                <h2 class="h3 fw-bold mb-0">Glimpses of the Ministry</h2>
            </div>
            <a href="{{ route('gallery.index') }}" class="btn btn-outline-brand mt-3 mt-md-0">View full gallery</a>
        </div>

        <div class="row g-3">
            @php
                $previewImages = [
                    ['src' => asset('images/gallery/preview-1.jpg'), 'alt' => 'Joy In Zoe fellowship gathering'],
                    ['src' => asset('images/gallery/preview-2.jpg'), 'alt' => 'Members gathered in fellowship'],
                    ['src' => asset('images/gallery/preview-3.jpg'), 'alt' => 'Joy In Zoe fellowship moment'],
                    ['src' => asset('images/gallery/preview-4.jpg'), 'alt' => 'Intercessors at a ministry gathering'],
                    ['src' => asset('images/gallery/preview-5.jpg'), 'alt' => 'Outreach in Ada-Irri, Delta State'],
                    ['src' => asset('images/gallery/preview-6.jpg'), 'alt' => 'Missionaries during Delta outreach'],
                    ['src' => asset('images/gallery/preview-7.jpg'), 'alt' => 'Community outreach in Gwagwalada, Abuja'],
                    ['src' => asset('images/gallery/preview-8.jpg'), 'alt' => 'Gwagwalada outreach ministry'],
                    ['src' => asset('images/gallery/preview-9.jpg'), 'alt' => 'Kwara State missionary outreach'],
                ];
            @endphp
            @foreach ($previewImages as $image)
                <div class="col-6 col-md-4 col-lg-4">
                    <a href="{{ $image['src'] }}" class="d-block" data-lightbox="home-gallery">
                        <img src="{{ $image['src'] }}" alt="{{ $image['alt'] }}" class="gallery-img rounded-3 shadow"
                             loading="lazy">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
