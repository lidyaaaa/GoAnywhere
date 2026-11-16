@props(['active'])

@php
$isActive = $active ?? false;
$classes = $isActive
            ? 'responsive-link active'
            : 'responsive-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} @if($isActive) aria-current="page" @endif>
    {{ $slot }}
</a>
