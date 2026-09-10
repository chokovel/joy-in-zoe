@props(['title' => null, 'subtitle' => null, 'class' => null])

<div {{ $attributes->merge(['class' => 'card shadow-sm'.($class ? ' '.$class : '')]) }}>
    @if ($title)
        <div class="card-body pb-0">
            <h5 class="card-title mb-1">{{ $title }}</h5>
            @if ($subtitle)
                <h6 class="card-subtitle text-muted mb-0">{{ $subtitle }}</h6>
            @endif
        </div>
    @endif
    {{ $slot }}
</div>
