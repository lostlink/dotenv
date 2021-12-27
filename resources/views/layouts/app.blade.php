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

    <div x-show="mobileMenuOpen" class="fixed inset-0 flex z-40 md:hidden"
         x-ref="dialog"
         aria-modal="true"
         style="display: none;">

        <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-600 bg-opacity-75"
             @click="open = false"
             aria-hidden="true"
             style="display: none;">
        </div>

        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-indigo-700"
             style="display: none;">

            <div x-show="mobileMenuOpen"
                 x-transition:enter="ease-in-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in-out duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute top-0 right-0 -mr-12 pt-2"
                 style="display: none;">
                <button type="button"
                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        @click="mobileMenuOpen = false">
                    <span class="sr-only">Close sidebar</span>
                    <x-heroicon-o-x class="h-6 w-6 text-white"/>
                </button>
            </div>

            {{-- Mobile Logo --}}
            <div class="flex-shrink-0 flex items-center px-4">
                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-300-mark-white-text.svg" alt="Workflow">
            </div>

            <div class="mt-5 flex-1 h-0 overflow-y-auto">
                <nav class="px-2 space-y-1">

                    <x-sidebar-menu-link :active="request()->routeIs('dashboard')" href="{{ route('dashboard') }}" class="text-base font-medium">
                        <x-heroicon-o-home class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300"/>
                        {{ __('Dashboard') }}
                    </x-sidebar-menu-link>

{{--                    <x-sidebar-menu-link :active="request()->routeIs('reports')" href="{{ route('reports') }}" class="text-base font-medium">--}}
{{--                        <x-heroicon-o-chart-bar class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300"/>--}}
{{--                        {{ __('Reports') }}--}}
{{--                    </x-sidebar-menu-link>--}}

                </nav>
            </div>
        </div>

        <div class="flex-shrink-0 w-14" aria-hidden="true">
            <!-- Dummy element to force sidebar to shrink to fit close icon -->
        </div>
    </div>


    {{-- Static Sidebar for Desktop --}}
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">

        {{-- Sidebar --}}
        <div class="flex flex-col flex-grow pt-5 bg-indigo-700 overflow-y-auto">

            {{-- Desktop Logo --}}
            <div class="flex items-center flex-shrink-0 px-4">
                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-300-mark-white-text.svg" alt="Workflow">
            </div>

            <div class="mt-5 flex-1 flex flex-col">
                <nav class="flex-1 px-2 pb-4 space-y-1">

                    <x-sidebar-menu-link :active="request()->routeIs('dashboard')" href="{{ route('dashboard') }}">
                        <x-heroicon-o-home class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300"/>
                        {{ __('Dashboard') }}
                    </x-sidebar-menu-link>

                    {{--                    <x-sidebar-menu-link :active="request()->routeIs('reports')" href="{{ route('reports') }}" >--}}
                    {{--                        <x-heroicon-o-home class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300"/>--}}
                    {{--                        {{ __('Reports') }}--}}
                    {{--                    </x-sidebar-menu-link>--}}
                </nav>
            </div>
        </div>
    </div>

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
@livewireUIScripts
@powerGridScripts
<x-livewire-alert::scripts/>
</body>
</html>
