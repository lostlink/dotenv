<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{currentTheme: localStorage.getItem('theme') || localStorage.setItem('theme', 'system')}"
    x-init="$watch('currentTheme', val => localStorage.setItem('theme', val))"
    x-bind:class="{'dark': currentTheme === 'dark' || (currentTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)}">

<head>
    {!! Meta::toHtml() !!}

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles

    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html>
