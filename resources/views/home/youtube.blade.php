<section id="youtube" class="py-5 py-lg-6 bg-brand-dark">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <p class="section-eyebrow-light mb-2">Watch &amp; Pray</p>
                <h2 class="h3 fw-bold text-white mb-3">Join Our Prayer Sessions on YouTube</h2>
                <p class="text-white-50 mb-4">
                    Join us online to pray for the unreached, our families, and the nations.
                    Watch our prayer sessions, teachings, and testimonies and be encouraged as we contend together.
                </p>



                <a href="{{ config('ministry.socials.youtube') }}" target="_blank" rel="noopener"
                   class="btn btn-highlight btn-lg mt-2">
                    <i class="bi bi-youtube me-2"></i>Visit our channel
                </a>
            </div>

            <div class="col-lg-6">
                {{-- <img src="{{ asset('images/gallery/preview-2.jpg') }}" alt="Joy In Zoe intercessors gathered in prayer"
                     class="img-fluid rounded-4 shadow" loading="lazy"> --}}

                @if (!empty($youtubeVideos))
                    @php $primaryVideoId = $youtubeVideos[0]; @endphp
                    <div class="video-frame mb-4">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/{{ $primaryVideoId }}"
                                    title="Latest Joy In Zoe Intercessory Ministries YouTube video"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
                        </div>
                    </div>

                    @if (count($youtubeVideos) > 1)
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @foreach (array_slice($youtubeVideos, 1) as $videoId)
                                <a href="https://www.youtube.com/watch?v={{ $videoId }}" target="_blank" rel="noopener"
                                   class="btn btn-outline-white btn-sm">
                                    <i class="bi bi-play-circle me-1"></i>Watch another recent video
                                </a>
                            @endforeach
                        </div>
                    @endif
                @else
                <img src="{{ asset('images/gallery/preview-2.jpg') }}" alt="Joy In Zoe intercessors gathered in prayer"
                     class="img-fluid rounded-4 shadow" loading="lazy">
                    {{-- <div class="card bg-white shadow">
                        <div class="card-body p-4 d-flex align-items-center gap-3">
                            <div class="display-5 text-accent"><i class="bi bi-youtube"></i></div>
                            <div>
                                <h3 class="h6 mb-1">Follow our YouTube channel</h3>
                                <p class="small text-muted mb-0">
                                    Subscribe to catch our latest prayer sessions and ministry updates.
                                </p>
                            </div>
                        </div>
                    </div> --}}
                @endif
            </div>
        </div>
    </div>
</section>
