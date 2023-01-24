@props(['active'])

@php
    $classes = $active ?? false ? 'bg-blue-de nav-a-link nav-a-link-active' : 'nav-a-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
