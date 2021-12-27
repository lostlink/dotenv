@props(['active','index'])

@php
    $classes = ($active ?? false)
                ? 'block px-4 py-2 border-l-4 border-indigo-400 text-sm text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition'
                : 'block px-4 py-2 border-l-4 border-transparent text-sm text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition';
@endphp

<a
   {{ $attributes->merge(['class' => $classes]) }}
   class=""
   x-state:on="Active"
   x-state:off="Not Active"
   :class="{ 'bg-gray-100': {{ is_null($index) ? '' : 'activeIndex === ' . $index }} }"
   role="menuitem"
   tabindex="-1"
   id="user-menu-item-{{ $index ?? 0 }}"
   @mouseenter="{{ is_null($index) ? '' : 'activeIndex = ' . $index }}"
   @mouseleave="activeIndex = -1"
   @click="open = false; focusButton()"
>
    {{ $slot }}
</a>
