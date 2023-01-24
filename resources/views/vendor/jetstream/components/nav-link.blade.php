@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-base font-medium leading-5 text-gray-900 dark:text-gray-300  dark:hover:text-white dark:hover:border-indigo-700 focus:outline-none hover:border-gray-300  focus:border-indigo-700 transition'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-base font-medium leading-5 text-gray-500 dark:text-gray-300 dark:hover:text-white dark:hover:border-indigo-700 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-indigo-700 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
