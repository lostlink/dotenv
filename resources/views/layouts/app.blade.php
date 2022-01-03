<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @livewireStyles
    @powerGridStyles

    {{-- Scripts --}}
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased h-full">
<x-jet-banner/>

<div x-data="{ mobileMenuOpen: false, open: false }" @keydown.window.escape="mobileMenuOpen = false">

    <x-sidebar-menu />

    <div class="md:pl-64 flex flex-col flex-1">
        <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
            {{-- Hamburger Menu --}}
            <button type="button"
                    class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
                    @click="mobileMenuOpen = true">
                <span class="sr-only">Open sidebar</span>
                <x-heroicon-o-menu-alt-2 class="h-6 w-6"/>
            </button>

            <div class="flex-1 px-4 flex justify-between">
                <div class="flex-1 flex">
                    {{-- Search Bar --}}
                    @livewire('search-bar')
                </div>

                <div class="ml-4 flex items-center md:ml-6">
                    {{-- Notification Bell --}}
                    {{--<button type="button" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">--}}
                    {{--    <span class="sr-only">View notifications</span>--}}
                    {{--    <x-heroicon-o-bell class="h-6 w-6"/>--}}
                    {{--</button>--}}

                    {{-- Profile dropdown --}}
                    @livewire('profile-menu')
                </div>
            </div>
        </div>

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
@powerGridScripts
<x-livewire-alert::scripts/>
</body>
</html>
