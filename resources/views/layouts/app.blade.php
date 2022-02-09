<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{currentTheme: localStorage.getItem('theme') || localStorage.setItem('theme', 'system')}"
    x-init="$watch('currentTheme', val => localStorage.setItem('theme', val))"
    x-bind:class="{'dark': currentTheme === 'dark' || (currentTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)}"
    class="h-full bg-gray-100">

<head>
    {!! Meta::toHtml() !!}

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @livewireStyles
    @powerGridStyles

    {{-- Scripts --}}
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased h-full">
    <x-jet-banner />

    <div x-data="{ mobileMenuOpen: false, open: false }"
        @keydown.window.escape="mobileMenuOpen = false">

        <x-sidebar-menu />

        <div class="md:pl-64 flex flex-col flex-1">

            <x-app.header />

            <main>
                <div class="py-6">
                    @if (isset($header))
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <h1 class="text-2xl font-semibold text-gray-900">
                                {{ $header }}
                            </h1>
                        </div>
                    @endif
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>


    @stack('modals')
    @livewireScripts
    @livewire('livewire-ui-modal') {{-- http://arslantariq.com/livewireui-modal/ --}}
    @livewireChartsScripts
    @powerGridScripts
    <x-livewire-alert::scripts />
</body>

</html>
