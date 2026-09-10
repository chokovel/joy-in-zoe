<footer class="bg-brand-dark py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Joy In Zoe Intercessory Ministries logo" class="rounded-circle me-2" style="width:48px;height:48px;object-fit:cover">
                    <div>
                        <h5 class="text-white mb-0">Joy In Zoe</h5>
                        <small class="text-white-50">Intercessory Ministries</small>
                    </div>
                </div>
                <p class="mb-3 text-white-50">
                    Raising an altar of prayer, intercession, and spiritual awakening.
                    Reaching the unreached through prayer and outreach.
                </p>
            </div>

            <div class="col-6 col-lg-2">
                <h6 class="text-white mb-3">Explore</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="{{ route('about') }}">Who We Are</a></li>
                    <li class="mb-2"><a href="{{ route('missions') }}">Missions Education</a></li>
                    <li class="mb-2"><a href="{{ route('gallery.index') }}">Gallery</a></li>
                    <li class="mb-2"><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-3">
                <h6 class="text-white mb-3">Connect</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="mailto:joyinzoee@gmail.com">joyinzoee@gmail.com</a></li>
                    <li class="mb-2"><a href="tel:+2348022805755">+234 802 280 5755</a></li>
                    <li class="mb-2"><a href="{{ route('home') }}#contact">Tony Close, Akwaka Phase 2, Rumuodomaya, Port Harcourt.</a></li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h6 class="text-white mb-3">Follow Us</h6>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ config('ministry.socials.facebook') }}" target="_blank" rel="noopener"
                       class="btn btn-outline-white btn-sm text-start" aria-label="Facebook — Joy In Zoe">
                        <i class="bi bi-facebook me-2"></i>JOYINZOE
                    </a>
                    <a href="{{ config('ministry.socials.instagram') }}" target="_blank" rel="noopener"
                       class="btn btn-outline-white btn-sm text-start" aria-label="Instagram — Joy_In_Zoe">
                        <i class="bi bi-instagram me-2"></i>JOY_IN_ZOE
                    </a>
                    <a href="{{ config('ministry.socials.telegram') }}" target="_blank" rel="noopener"
                       class="btn btn-outline-white btn-sm text-start" aria-label="Youtube — Joy In Zoe">
                        <i class="bi bi-youtube me-2"></i>Pray with us on Youtube
                    </a>
                </div>
            </div>
        </div>

        <hr class="border-secondary my-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small text-white-50">
            <p class="mb-2 mb-md-0">&copy; {{ date('Y') }} Joy In Zoe Intercessory Ministries. All rights reserved.</p>
            <p class="mb-0">We are Watchmen. We are Burden Bearers. We are Intercessors.</p>
        </div>
    </div>
</footer>
