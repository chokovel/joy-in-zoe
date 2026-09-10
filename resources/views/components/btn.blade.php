@props(['href' => null, 'type' => 'button', 'variant' => 'brand', 'size' => null, 'class' => null])

@php
    $classes = 'btn btn-'.$variant.($size ? ' btn-'.$size : '').($class ? ' '.$class : '');
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
