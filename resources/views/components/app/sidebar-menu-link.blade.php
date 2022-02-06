@props(['active'])

@php
$baseClass = 'group flex items-center px-2 py-2 text-sm font-medium rounded-md';
$classes = $active ?? false ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-600';
@endphp

<a {{ $attributes->merge(['class' => $classes . ' ' . $baseClass]) }}>
    {{ $slot }}
</a>
