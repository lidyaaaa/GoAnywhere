@props(['active'])

@php
$isActive = $active ?? false;
$classes = $isActive
            ? 'nav-link active'
            : 'nav-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} @if($isActive) aria-current="page" @endif>
    {{ $slot }}
</a>
