@php
    $slides = [
        [
            'image' => asset('images/home/hero-1.jpg'),
            'alt' => 'Joy In Zoe intercessors gathered in prayer and worship',
            'eyebrow' => 'Joy In Zoe Intercessory Ministries',
            'heading' => 'Reaching the Unreached Through Prayer and Outreach',
            'text' => 'Joy In Zoe Intercessory Ministries is committed to restoring lives, families, and destinies through fervent prayer, intercession, and the teaching of God\'s Word.',
            'buttons' => [
                ['label' => 'About us', 'href' => route('about'), 'class' => 'btn btn-brand btn-lg'],
                ['label' => 'Missions', 'href' => route('missions'), 'class' => 'btn btn-white btn-lg'],
            ],
        ],
        [
            'image' => asset('images/home/hero-2.jpg'),
            'alt' => 'Joy In Zoe missionaries sharing the gospel during outreach',
            'eyebrow' => 'Reaching the Unreached',
            'heading' => 'Raising an Altar of Prayer, Intercession, and Spiritual Awakening',
            'text' => 'We are watchmen on the wall, a prophetic family of intercessors contending for souls, birthing revival, and raising voices in prayer across the nations.',
            'buttons' => [
                ['label' => 'Become an Intercessor', 'href' => route('home').'#join', 'class' => 'btn btn-brand btn-lg'],
                ['label' => 'Our outreaches', 'href' => route('gallery.index'), 'class' => 'btn btn-white btn-lg'],
            ],
        ],
        [
            'image' => asset('images/home/hero-3.jpg'),
            'alt' => 'Joy In Zoe women praying together in the midnight watch',
            'eyebrow' => 'Women & Families',
            'heading' => 'Restoring Lives, Families, and Destinies',
            'text' => 'From the midnight watch to city-wide outreaches, we stand in the gap for marriages, children, widows, single mothers, and orphans across the nations.',
            'buttons' => [
                ['label' => 'Partner with us', 'href' => route('home').'#support', 'class' => 'btn btn-brand btn-lg'],
                // ['label' => 'Women\'s prayer group', 'href' => route('home').'#join', 'class' => 'btn btn-white btn-lg'],
            ],
        ],
        // [
        //     'image' => asset('images/home/hero-4.jpg'),
        //     'alt' => 'Joy In Zoe outreach team serving a community',
        //     'eyebrow' => 'Prayer & Compassion',
        //     'heading' => 'An Altar That Never Goes Cold',
        //     'text' => 'A ministry raised by God to restore prayer altars, align destinies, and enforce Heaven\'s agenda on Earth.',
        //     'buttons' => [
        //         ['label' => 'About us', 'href' => route('about'), 'class' => 'btn btn-brand btn-lg'],
        //         ['label' => 'Missions', 'href' => route('missions'), 'class' => 'btn btn-white btn-lg'],
        //     ],
        // ],
    ];
@endphp

<h1 class="visually-hidden">Joy In Zoe Intercessory Ministries — Reaching the Unreached Through Prayer and Outreach</h1>

<section class="hero-carousel position-relative" aria-label="Featured ministry highlights">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="7000">

        <div class="carousel-inner">
            @foreach ($slides as $index => $slide)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ $slide['image'] }}" class="d-block w-100" alt="{{ $slide['alt'] }}">
                    <div class="hero-overlay position-absolute top-0 start-0 end-0 bottom-0"></div>
                    <div class="carousel-caption">
                        <div class="container">
                            <p class="section-eyebrow-light mb-2">{{ $slide['eyebrow'] }}</p>
                            <h2 class="display-5 fw-bold text-white text-shadow mx-auto" style="max-width:900px;">
                                {{ $slide['heading'] }}
                            </h2>
                            {{-- <p class="lead mx-auto mt-3" style="max-width:760px;color:#fff;">
                                {{ $slide['text'] }}
                            </p> --}}
                            <div class="mt-4 d-flex gap-2 justify-content-center flex-wrap">
                                @foreach ($slide['buttons'] as $button)
                                    <a href="{{ $button['href'] }}" class="{{ $button['class'] }}">{{ $button['label'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous slide</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next slide</span>
        </button>
    </div>
</section>
