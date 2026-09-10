@extends('layouts.app')

@section('title', 'About | Joy In Zoe Intercessory Ministries')
@section('meta_description', 'Learn about Joy In Zoe Intercessory Ministries — our story, mandate, vision, mission, aims and objectives, future home, outreaches, and prayer life.')
@section('og_title', 'About Joy In Zoe Intercessory Ministries')
@section('og_description', 'A Spirit-breathed intercessory movement raised to restore prayer altars, align destinies, and enforce Heaven\'s agenda on Earth.')

@section('content')
    <section class="py-5 bg-brand-dark">
        <div class="container">
            <div class="text-center">
                <p class="section-eyebrow-light mb-2">Who We Are</p>
                <h1 class="h2 fw-bold text-white mb-3">A Spirit-breathed Intercessory Movement</h1>
                <p class="text-white-50 mx-auto mb-0" style="max-width:680px;">
                    JIZIM (Joy In Zoe Intercessory Ministries) is a Spirit-breathed intercessory movement raised by
                    God to restore prayer altars, align destinies, and enforce Heaven's agenda on Earth.
                </p>
            </div>
        </div>
    </section>

    <section id="story" class="py-5 py-lg-6">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <p class="section-eyebrow mb-2">Our Story</p>
                    <h2 class="h3 fw-bold mb-3">Watchmen on the Wall</h2>
                    <p>
                        We are watchmen on the wall (Isaiah 62:6–7) — a prophetic family of intercessors contending
                        for souls, birthing revival, and raising voices in prayer across the nations.
                    </p>
                    <p>
                        JIZIM began not out of ambition but out of a deep burden to pray for God's work — not just for
                        ourselves but for nations, institutions, marriages, ministries, and people. What started with
                        two sisters waking up every night to pray for one hour turned into a divine movement.
                    </p>
                    <p>
                        The "Midnight Watch" and the call to build something bigger came from this obedience. As the
                        prayers grew, God clearly said: <em>"This is not a local movement. It is international."</em>
                    </p>
                    <p class="mb-0">
                        JIZIM was registered as Joy In Zoe Intercessory Ministries — not a church, but a ministry with
                        a global mandate.
                    </p>
                </div>
                <div class="col-lg-6">
                    {{-- <div class="row g-3">
                    <div class="col-6"> --}}
                        <img src="{{ asset('images/home/watchmen.png') }}" alt="Medical and missionary outreach in Etche, Rivers State"
                             class="img-fluid rounded-4 shadow" loading="lazy">
                    {{-- </div>
                    <div class="col-6 mt-4">
                        <img src="{{ asset('images/home/outreach-gwagwalada.jpg') }}" alt="Joy In Zoe outreach team in Gwagwalada, Abuja"
                             class="img-fluid rounded-4 shadow" loading="lazy">
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
    </section>

    <section id="mandate" class="py-5 py-lg-6 bg-soft">
        <div class="container">
            <div class="text-center mb-5">
                <p class="section-eyebrow mb-2">What Sets Us Apart</p>
                <h2 class="h3 fw-bold">Our Mandate, Vision &amp; Mission</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-hover h-100">
                        <div class="card-body p-4">
                            <div class="display-6 text-accent mb-3"><i class="bi bi-bullseye"></i></div>
                            <h3 class="h5">Our Mandate</h3>
                            <p class="mb-0 text-muted">
                                To raise female intercessors, revive prayer altars, and stand in the gap for the
                                unreached, unsaved, nations, institutions, marriages, ministries, and people —
                                including Youths, Children, Widows, Single mothers and Orphans — across the nations
                                of the earth.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-hover h-100">
                        <div class="card-body p-4">
                            <div class="display-6 text-accent mb-3"><i class="bi bi-eye"></i></div>
                            <h3 class="h5">Vision</h3>
                            <p class="mb-0 text-muted">
                                To birth, build, and sustain intercessory fire across homes, cities, and nations,
                                preparing the way for God's revival.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-hover h-100">
                        <div class="card-body p-4">
                            <div class="display-6 text-accent mb-3"><i class="bi bi-stars"></i></div>
                            <h3 class="h5">Mission</h3>
                            <ul class="text-muted mb-0 ps-3">
                                <li>To raise and equip a generation of women to become prophetic intercessors.</li>
                                <li>To ignite fire on altars that have grown cold.</li>
                                <li>To war for destinies and stand in the gap for nations.</li>
                                <li>To reach the unreached with the Gospel through prayer and outreach.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="aims" class="py-5 py-lg-6">
        <div class="container">
            <div class="text-center mb-5">
                <p class="section-eyebrow mb-2">Our Aims and Objectives</p>
                <h2 class="h3 fw-bold">Why We Exist</h2>
            </div>

            <div class="row g-4">
                @php
                    $aims = [
                        ['icon' => 'life-preserver', 'title' => 'Intercession & Revival', 'text' => 'To labor in intercession for the release of God\'s power to win the lost, reach the unreached, revive the Church, and impact society, while also engaging in works of justice and compassion.'],
                        ['icon' => 'basket', 'title' => 'Community Outreach', 'text' => 'To provide community outreach with on-site food distribution, discipleship programs, medical check-ups, and provision of food and clothing for the poor and marginalized.'],
                        ['icon' => 'moon-stars', 'title' => 'Prayer Rooms', 'text' => 'To set up prayer rooms operating night-and-day prayer in the remote and hard-to-reach communities.'],
                        ['icon' => 'heart', 'title' => 'Orphans & Widows', 'text' => 'To support orphans, children at risk, widows, and widowers both spiritually and materially.'],
                        ['icon' => 'life-preserver', 'title' => 'Restoration', 'text' => 'To support women who refuse abortion and choose life, and provide homes and restoration programs for victims of human trafficking, domestic violence, and those who respond to the gospel.'],
                    ];
                @endphp
                @foreach ($aims as $aim)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-hover h-100">
                            <div class="card-body p-4">
                                <div class="display-6 text-accent mb-3"><i class="bi bi-{{ $aim['icon'] }}"></i></div>
                                <h3 class="h6 fw-bold">{{ $aim['title'] }}</h3>
                                <p class="small text-muted mb-0">{{ $aim['text'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="future-home" class="py-5 py-lg-6 bg-brand-dark">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <p class="section-eyebrow-light mb-2">Our Future Home</p>
                    <h2 class="h3 fw-bold text-white mb-3">The JIZIM Prayer Mountain &amp; Secretariat</h2>
                    <p class="text-white-50">
                        The vision God gave for JIZIM includes a place — a Prayer Ground — where people can come and
                        wait on the Lord, encounter Him, and be refreshed. This will also house a Secretariat for
                        ministry operations, training, and spiritual birthing.
                    </p>
                    <blockquote class="border-start border-4 ps-3 mb-0" style="border-color: #ffff00;">
                        <p class="lead text-white mb-0 fst-italic">"A place where revival is hosted."</p>
                    </blockquote>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/ada-Irri 9.jpeg') }}" alt="Joy In Zoe outreach team serving a community"
                         class="img-fluid rounded-4 shadow" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <section id="outreaches" class="py-5 py-lg-6 bg-soft">
        <div class="container">
            <div class="text-center mb-5">
                <p class="section-eyebrow mb-2">Not Just Praying for the Lost — Reaching Them</p>
                <h2 class="h3 fw-bold">Outreaches</h2>
                <p class="text-muted mx-auto" style="max-width:680px;">
                    We believe in not just praying for the lost but reaching them. JIZIM has carried out life-changing
                    medical, food, and gospel outreaches across Nigeria.
                </p>
            </div>

            <div class="row g-4 justify-content-center mb-5">
                @php
                    $outreaches = [
                        ['place' => 'Etche, Rivers State', 'detail' => 'Medical & Missionary Outreach', 'date' => 'May 2023'],
                        ['place' => 'Igberi Owode Town, Kwara State', 'detail' => 'Food, Medical & Missionary Outreach', 'date' => 'August 2023'],
                        ['place' => 'Badikko, Bauchi State', 'detail' => 'Food & Missionary Outreach'],
                        ['place' => 'Ada-Irri, Isoko, Delta State', 'detail' => 'Food & Missionary Outreach'],
                        ['place' => 'Gwagwalada, Abuja', 'detail' => 'Medical, Food & Missionary Outreach'],
                        ['place' => 'Miya and Burku, Bauchi State', 'detail' => 'Medical, Food & Missionary Outreach'],
                    ];
                @endphp
                @foreach ($outreaches as $outreach)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-hover h-100">
                            <div class="card-body d-flex align-items-start">
                                <i class="bi bi-geo-alt-fill text-accent me-3 mt-1 fs-5"></i>
                                <div>
                                    <h3 class="h6 mb-1">{{ $outreach['place'] }}</h3>
                                    <p class="small text-muted mb-0">
                                        {{ $outreach['detail'] }}@if ($outreach['date'] ?? null), {{ $outreach['date'] }}@endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('gallery.index') }}" class="btn btn-brand btn-lg">See outreach photos</a>
            </div>
        </div>
    </section>

    <section id="how-we-pray" class="py-5 py-lg-6">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <img src="{{ asset('images/home/prayerr.jpg') }}" alt="Joy In Zoe intercessors gathered for prayer during outreach in Ada-Irri, Delta State"
                         class="img-fluid rounded-4 shadow" loading="lazy">
                </div>

                <div class="col-lg-7">
                    <p class="section-eyebrow mb-2">How We Pray</p>
                    <h2 class="h3 fw-bold mb-3">JIZIM Weekly Prayer Schedule</h2>
                    <p class="text-muted">
                        JIZIM runs a consistent weekly rhythm of prayer that is open to all — and a women-only
                        midnight watch on Telegram. There is a place for every believer at this altar.
                    </p>

                    <div class="row g-3">
                        @php
                            $schedule = [
                                ['icon' => 'broadcast', 'title' => 'Prayer for the Unreached', 'when' => 'Monday–Friday · 9:00 PM', 'where' => 'Facebook Live · Open to all'],
                                ['icon' => 'moon-stars', 'title' => 'Midnight Watch for the Unreached', 'when' => 'Monday–Friday · 12:00 AM', 'where' => 'Telegram · Women only'],
                                ['icon' => 'people', 'title' => 'Physical Fellowship', 'when' => '1st & last Saturday · 9:00 AM', 'where' => 'Open to all'],
                                ['icon' => 'book', 'title' => 'Bible Study', 'when' => '3rd Saturday · 9:00 AM', 'where' => 'WhatsApp · Open to all'],
                            ];
                        @endphp
                        @foreach ($schedule as $item)
                            <div class="col-md-6">
                                <div class="card card-hover h-100">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-{{ $item['icon'] }} fs-4 text-accent me-2"></i>
                                            <h3 class="h6 mb-0">{{ $item['title'] }}</h3>
                                        </div>
                                        <p class="small text-muted mb-0">
                                            {{ $item['when'] }}
                                            <span class="d-block">{{ $item['where'] }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="women-prayer-group" class="py-5 py-lg-6 bg-brand-dark">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <p class="section-eyebrow-light mb-2">Women's Prayer Group</p>
                    <h2 class="h3 fw-bold text-white mb-3">Join the Joy In Zoe Women's Prayer Community</h2>
                    <p class="text-white-50">
                        The Joy In Zoe Telegram prayer group is a women-only prayer community. If you are a woman with
                        the heart of an intercessor — willing to stand in the gap at midnight for the unreached, your
                        family, and the nations — this community is for you.
                    </p>

                    <ul class="list-unstyled text-white-50 mb-4">
                        <li class="d-flex mb-2">
                            <i class="bi bi-check-circle-fill text-highlight me-2 mt-1"></i>
                            A female of any age with the heart of an intercessor.
                        </li>
                        <li class="d-flex mb-2">
                            <i class="bi bi-check-circle-fill text-highlight me-2 mt-1"></i>
                            Willing and available to join midnight prayers three times a week.
                        </li>
                        <li class="d-flex mb-2">
                            <i class="bi bi-check-circle-fill text-highlight me-2 mt-1"></i>
                            Receive the group invitation to join after approval and signing a commitment form.
                        </li>
                    </ul>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('contact') }}" class="btn btn-highlight btn-lg">Join us</a>
                        {{-- <a href="{{ route('contact') }}" class="btn btn-white btn-lg">Get in touch</a> --}}
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card bg-white shadow">
                        <div class="card-body p-4">
                            <h3 class="h5 mb-3">How it works</h3>
                            <ol class="mb-0">
                                <li class="mb-2">Send an email indicating your interest in joining.</li>
                                <li class="mb-2">A commitment form will be sent to you for signing.</li>
                                <li class="mb-2">Send back the signed form to receive the private group invitation.</li>
                                <li>Join the midnight watch and grow as an intercessor.</li>
                            </ol>
                            <hr>
                            <p class="small text-muted mb-0">
                                The private Telegram invitation is extended only after approval.
                                No invitation link is displayed publicly.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
