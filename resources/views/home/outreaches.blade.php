<section id="outreaches" class="py-5 py-lg-6 bg-soft">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-eyebrow mb-2">Outreaches</p>
            <h2 class="h3 fw-bold mb-3">Not Just Praying for the Lost — Reaching Them</h2>
            <p class="text-muted mx-auto" style="max-width:680px;">
                JIZIM believes in not just praying for the lost but reaching them. The ministry has carried
                out life-changing medical, food, and gospel outreaches across Nigeria.
            </p>
        </div>

        <div class="row g-4 mb-5 align-items-center">
            <div class="col-lg-5">
                <ul class="list-unstyled">
                    @php
                        $outreaches = [
                            ['place' => 'Etche, Rivers State', 'detail' => 'Medical & Missionary Outreach', 'date' => 'May 2023'],
                            ['place' => 'Igberi Owode, Kwara State', 'detail' => 'Food, Medical & Missionary Outreach', 'date' => 'August 2023'],
                            ['place' => 'Badikko, Bauchi State', 'detail' => 'Food & Missionary Outreach', 'date' => null],
                            ['place' => 'Ada-Irri, Isoko, Delta State', 'detail' => 'Food & Missionary Outreach', 'date' => null],
                            ['place' => 'Gwagwalada, Abuja', 'detail' => 'Medical, Food & Missionary Outreach', 'date' => null],
                            ['place' => 'Miya and Burku, Bauchi State', 'detail' => 'Medical, Food & Missionary Outreach', 'date' => null],
                        ];
                    @endphp
                    @foreach ($outreaches as $outreach)
                        <li class="d-flex mb-3">
                            <i class="bi bi-check-circle-fill text-accent me-3 mt-1 fs-5"></i>
                            <div>
                                <strong>{{ $outreach['place'] }}</strong>
                                <span class="d-block text-muted small">
                                    {{ $outreach['detail'] }}@if ($outreach['date']), {{ $outreach['date'] }}@endif
                                </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('gallery.index') }}" class="btn btn-brand mt-2">See outreach photos</a>
            </div>

            <div class="col-lg-7">
                <div class="row g-3">
                    @php
                        $outreachPhotos = [
                            ['src' => asset('images/home/outreach-bauchi.jpg'), 'alt' => 'Joy In Zoe food and missionary outreach in Badikko, Bauchi State'],
                            ['src' => asset('images/home/outreach-etche.jpg'), 'alt' => 'Medical and missionary outreach in Etche, Rivers State'],
                            ['src' => asset('images/home/outreach-gwagwalada.jpg'), 'alt' => 'Joy In Zoe outreach team in Gwagwalada, Abuja'],
                            ['src' => asset('images/home/outreach-christmas.jpg'), 'alt' => 'Joy In Zoe Christmas outreach serving a community'],
                            ['src' => asset('images/gallery/preview-5.jpg'), 'alt' => 'Missionary outreach in Ada-Irri, Delta State'],
                            ['src' => asset('images/gallery/preview-7.jpg'), 'alt' => 'Community outreach in Gwagwalada, Abuja'],
                        ];
                    @endphp
                    @foreach ($outreachPhotos as $photo)
                        <div class="col-6">
                            <a href="{{ $photo['src'] }}" class="d-block" data-lightbox="outreaches">
                                <img src="{{ $photo['src'] }}" alt="{{ $photo['alt'] }}" class="gallery-img"
                                     loading="lazy">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
