@props(['active'])

@php
    $classes = $active ?? false ? 'bg-blue-de w-full flex items-center gap-2 nav-a-link-r nav-a-link-r-active' : 'bg-blue-de flex items-center gap-2 block nav-a-link-r';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
