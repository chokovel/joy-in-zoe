@extends('layouts.app')

@section('title', 'Contact | Joy In Zoe Intercessory Ministries')
@section('meta_description', 'Contact Joy In Zoe Intercessory Ministries — reach us by phone, email, or visit us in Abuja or Port Harcourt.')
@section('og_title', 'Contact | Joy In Zoe Intercessory Ministries')
@section('og_description', 'Reach Joy In Zoe Intercessory Ministries — we would love to hear from you.')

@section('content')
    <section class="py-5 bg-brand-dark">
        <div class="container">
            <div class="text-center">
                <p class="section-eyebrow-light mb-2">Contact Us</p>
                <h1 class="h2 fw-bold text-white mb-3">We Would Love to Hear From You</h1>
                <p class="text-white-50 mx-auto mb-0" style="max-width:640px;">
                    Have a question, want to join the prayer community, or partner with the ministry?
                    Reach out to us today.
                </p>
            </div>
        </div>
    </section>

    <section class="py-5 py-lg-6">
        <div class="container">
            <div class="row g-4 mb-5">
                @php
                    $channels = [
                        ['icon' => 'telephone', 'title' => 'Phone', 'href' => 'tel:'.config('ministry.contact.phone_href'), 'value' => config('ministry.contact.phone')],
                        ['icon' => 'envelope', 'title' => 'Email', 'href' => 'mailto:'.config('ministry.contact.email'), 'value' => config('ministry.contact.email')],
                        ['icon' => 'youtube', 'title' => 'YouTube', 'href' => config('ministry.socials.youtube'), 'value' => 'Watch our prayer sessions', 'external' => true],
                    ];
                @endphp
                @foreach ($channels as $channel)
                    <div class="col-md-4">
                        <div class="card card-hover h-100 text-center">
                            <div class="card-body p-4">
                                <div class="display-6 text-accent mb-3"><i class="bi bi-{{ $channel['icon'] }}"></i></div>
                                <h2 class="h6">{{ $channel['title'] }}</h2>
                                <a href="{{ $channel['href'] }}" class="text-decoration-none"
                                   @if (!empty($channel['external'])) target="_blank" rel="noopener" @endif>
                                    {{ $channel['value'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row g-5 align-items-stretch">
                <div class="col-lg-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="h5 fw-bold mb-4">Visit Us</h2>

                            <div class="d-flex mb-3">
                                <i class="bi bi-geo-alt-fill text-accent fs-4 me-3 mt-1"></i>
                                <div>
                                    <h3 class="h6 mb-1">Abuja</h3>
                                    <p class="text-muted small mb-0">{{ config('ministry.contact.abuja') }}</p>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <i class="bi bi-geo-alt-fill text-accent fs-4 me-3 mt-1"></i>
                                <div>
                                    <h3 class="h6 mb-1">Port Harcourt</h3>
                                    <p class="text-muted small mb-0">{{ config('ministry.contact.port_harcourt') }}</p>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h2 class="h6 mb-3">Follow Us</h2>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ config('ministry.socials.facebook') }}" target="_blank" rel="noopener"
                                   class="btn btn-outline-brand btn-sm">
                                    <i class="bi bi-facebook me-1"></i>JOYINZOE
                                </a>
                                <a href="{{ config('ministry.socials.instagram') }}" target="_blank" rel="noopener"
                                   class="btn btn-outline-brand btn-sm">
                                    <i class="bi bi-instagram me-1"></i>JOY_IN_ZOE
                                </a>
                                <a href="{{ config('ministry.socials.telegram') }}" target="_blank" rel="noopener"
                                   class="btn btn-outline-brand btn-sm">
                                    <i class="bi bi-youtube me-1"></i>Youtube
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body p-0">
                            {{-- <iframe
                                src="https://maps.google.com/maps?q=Gudu%20Abuja%20Nigeria&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                class="w-100 h-100 rounded-4" style="min-height:420px;border:0;"
                                allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                title="Map of Gudu, Abuja — Joy In Zoe Intercessory Ministries"></iframe> --}}

                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31802.538254265153!2d6.977348327636719!3d4.88643638186207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1069d18f3879fa8b%3A0x40f3319eda92ff69!2sAkwaka%20Road%2C%20500102%2C%20Rivers!5e0!3m2!1sen!2sng!4v1787692803284!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
