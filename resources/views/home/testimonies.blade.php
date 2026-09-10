<section id="testimonies" class="py-5 py-lg-6">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-eyebrow mb-2">Testimonies</p>
            <h2 class="h3 fw-bold">The Lord Confirms His Word</h2>
            <p class="text-muted mx-auto" style="max-width:680px;">
                The Lord continues to confirm His Word through signs, wonders, and miracles.
                JIZIM is a fertile ground where destinies are unlocked.
            </p>
        </div>

        <div class="row g-4">
            @php
                $testimonies = [
                    ['icon' => 'heart', 'title' => 'Miracle Marriages', 'text' => 'Sisters who were long delayed in marriage have received divine connections and marriages after prayer interventions.'],
                    ['icon' => 'balloon-heart', 'title' => 'Miracle Babies', 'text' => 'Women who were waiting for the fruit of the womb have conceived and given birth to healthy children.'],
                    ['icon' => 'briefcase', 'title' => 'Career Breakthroughs', 'text' => 'Doors of new jobs, promotions, international scholarships, and supernatural career shifts have opened for members.'],
                    ['icon' => 'shield-check', 'title' => 'Deliverances & Healings', 'text' => 'Chains of oppression, nightmares, addictions, and spiritual stagnation have been broken through midnight prayers and altar sessions.'],
                ];
            @endphp
            @foreach ($testimonies as $testimony)
                <div class="col-md-6 col-lg-3">
                    <div class="card card-hover h-100">
                        <div class="card-body p-4 text-center">
                            <div class="display-6 text-accent mb-3"><i class="bi bi-{{ $testimony['icon'] }}"></i></div>
                            <h3 class="h6 fw-bold">{{ $testimony['title'] }}</h3>
                            <p class="small text-muted mb-0">{{ $testimony['text'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
