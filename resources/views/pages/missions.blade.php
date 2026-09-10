@extends('layouts.app')

@section('title', 'Missions | Joy In Zoe Intercessory Ministries')
@section('meta_description', 'Learn about people groups, unreached people groups (UPGs), and the 10/40 Window — and explore comprehensive data on the world\'s people groups.')
@section('og_title', 'Missions | Joy In Zoe Intercessory Ministries')
@section('og_description', 'Understanding the unreached before we pray faithfully for the nations.')

@section('content')
    <section class="py-5 bg-brand-dark">
        <div class="container">
            <div class="text-center">
                <p class="section-eyebrow-light mb-2">Missions Education</p>
                <h1 class="h2 fw-bold text-white mb-3">Praying for the Unreached</h1>
                <p class="text-white-50 mx-auto mb-0" style="max-width:680px;">
                    Our mandate reaches beyond our borders. Before we can pray faithfully for the nations,
                    we must understand who the unreached are and where they live.
                </p>
            </div>
        </div>
    </section>

    <section id="people-groups" class="py-5 py-lg-6">
        <div class="container">
            <div class="text-center mb-5">
                <p class="section-eyebrow mb-2">People Groups &amp; Missions Education</p>
                <h2 class="h3 fw-bold">Who Are the Unreached?</h2>
                <p class="text-muted mx-auto" style="max-width:680px;">
                    Over three billion people around the world have yet to hear the Gospel in a meaningful way.
                    Here is what that means — and how we can pray.
                </p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <div class="card card-hover h-100">
                        <div class="card-body p-4">
                            <div class="display-6 text-accent mb-3"><i class="bi bi-people"></i></div>
                            <h2 class="h5">What is a people group?</h2>
                            <p class="text-muted small">
                                In the missions context, a people group is not merely a population figure. It is the
                                largest group within which the Gospel can spread as a church-planting movement without
                                encountering barriers of understanding or acceptance.
                            </p>
                            <p class="text-muted small mb-0">
                                A people group is commonly identified by a shared language, culture, ethnicity, or
                                identity — a community within which the message of Jesus can move freely, person to person.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-hover h-100">
                        <div class="card-body p-4">
                            <div class="display-6 text-accent mb-3"><i class="bi bi-life-preserver"></i></div>
                            <h2 class="h5">What is an unreached people group (UPG)?</h2>
                            <p class="text-muted small">
                                An unreached people group is one with no indigenous community of believing Christians
                                with adequate numbers and resources to evangelize the group without outside assistance.
                            </p>
                            <p class="text-muted small">
                                Missions researchers commonly define an unreached people group as one with no more than
                                <strong>5% Christian adherents</strong> and no more than <strong>2% Evangelicals</strong>.
                            </p>
                            <p class="text-muted small mb-0">
                                In practical terms: many have never had a meaningful conversation with a follower of Jesus,
                                and there is no local church able to reach them from within.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-hover h-100">
                        <div class="card-body p-4">
                            <div class="display-6 text-accent mb-3"><i class="bi bi-geo-alt"></i></div>
                            <h2 class="h5">Where do most UPGs live?</h2>
                            <p class="text-muted small">
                                The majority of the world's unreached peoples are concentrated across
                                <strong>North Africa, the Middle East, and Asia</strong> — a region commonly known as the
                                <strong>10/40 Window</strong>, the rectangular area between 10° and 40° north latitude.
                            </p>
                            <p class="text-muted small mb-0">
                                This region is home to most of the world's Muslims, Hindus, and Buddhists, and contains
                                the overwhelming majority of the world's least-evangelized nations, megacities, and
                                unreached people groups.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center bg-soft rounded-4 py-5 px-3" style="background-color: yellow">
                <p class="section-eyebrow mb-2">Explore the Nations</p>
                <h2 class="h4 fw-bold mb-2">Explore Comprehensive Data on the World's People Groups</h2>
                <p class="text-muted mx-auto mb-4" style="max-width:640px;">
                    Use the Joshua Project database to research people groups, their locations, populations,
                    languages, and status — and pray with greater understanding.
                </p>
                <a href="{{ config('ministry.joshuaproject_url') }}" target="_blank" rel="noopener"
                   class="btn btn-brand btn-lg">
                    <i class="bi bi-box-arrow-up-right me-2"></i>People Groups
                </a>
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

    <section id="prayer-schedule" class="py-5 py-lg-6">
        <div class="container">
            <div class="text-center mb-5">
                <p class="section-eyebrow mb-2">Weekly Prayer Schedule</p>
                <h2 class="h3 fw-bold">An Altar That Never Goes Cold</h2>
                <p class="text-muted mx-auto" style="max-width:680px;">
                    Join us throughout the week as we pray for the unreached and contend for the nations.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                @php
                    $schedule = [
                        ['icon' => 'broadcast', 'title' => 'Prayer for the Unreached', 'when' => 'Monday–Friday · 9:00 PM', 'where' => 'Facebook Live', 'note' => 'Open to all'],
                        ['icon' => 'moon-stars', 'title' => 'Midnight Watch for the Unreached', 'when' => 'Monday–Friday · 12:00 AM', 'where' => 'Telegram', 'note' => 'Women only'],
                        ['icon' => 'people', 'title' => 'Physical Fellowship', 'when' => '1st & last Saturday · 9:00 AM', 'where' => 'Rumuodomaya, Port Harcourt', 'note' => 'Open to all'],
                        ['icon' => 'book', 'title' => 'Bible Study', 'when' => '3rd Saturday · 9:00 AM', 'where' => 'WhatsApp', 'note' => 'Open to all'],
                    ];
                @endphp
                @foreach ($schedule as $item)
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-hover h-100">
                            <div class="card-body p-4 text-center">
                                <div class="display-6 text-accent mb-3"><i class="bi bi-{{ $item['icon'] }}"></i></div>
                                <h3 class="h6 fw-bold mb-2">{{ $item['title'] }}</h3>
                                <p class="small mb-1"><strong>{{ $item['when'] }}</strong></p>
                                <p class="small text-muted mb-0">
                                    {{ $item['where'] }}
                                    <span class="badge bg-brand text-white d-inline-block mt-2">{{ $item['note'] }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('contact') }}" class="btn btn-brand btn-lg">Join a prayer session</a>
            </div>
        </div>
    </section>
@endsection
