<header x-data="{ menuOpen: false }" class="relative">
    <div class="bg-gray-900 pt-6">
        <nav class="relative max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6" aria-label="Global">
            <div class="flex items-center flex-1">
                <div class="flex items-center justify-between w-full md:w-auto">
                    <a href="{{ route('home') }}">
                        <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                        <x-logo class="h-8 w-auto sm:h-10" color="#0891b2"/>
                    </a>
                    <div class="-mr-2 flex items-center md:hidden">
                        <button @click="menuOpen = ! menuOpen" type="button" aria-expanded="false"
                                class="bg-gray-900 rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:bg-gray-800 focus:outline-none focus:ring-2 focus-ring-inset focus:ring-white">
                            <span class="sr-only">{{ __('Open main menu') }}</span>
                            <x-heroicon-o-menu class="h-6 w-6"/>
                        </button>
                    </div>
                </div>
{{--                <div class="hidden space-x-8 md:flex md:ml-10">--}}
{{--                    <a href="#" class="text-base font-medium text-white hover:text-gray-300">Product</a>--}}

{{--                    <a href="#" class="text-base font-medium text-white hover:text-gray-300">Features</a>--}}

{{--                    <a href="#" class="text-base font-medium text-white hover:text-gray-300">Marketplace</a>--}}

{{--                    <a href="#" class="text-base font-medium text-white hover:text-gray-300">Company</a>--}}
{{--                </div>--}}
            </div>
            <div class="hidden md:flex md:items-center md:space-x-6">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700">
                        {{ __('Dashboard') }}
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-base font-medium text-white hover:text-gray-300">
                        {{ __('Log in') }}
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700">
                        {{ __('Start free trial') }}
                    </a>
                @endauth
            </div>
        </nav>
    </div>

    <div
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        :class="{'block': menuOpen, 'hidden': ! menuOpen}"
        class="absolute top-0 inset-x-0 p-2 transition transform origin-top md:hidden" x-cloak>
        <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="px-5 pt-4 flex items-center justify-between">
                <div>
                    <x-logo class="h-8 w-auto" color="#0891b2"/>
                </div>
                <div class="-mr-2">
                    <button @click="menuOpen = ! menuOpen" type="button"
                            class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-600">
                        <span class="sr-only">{{ __('Close menu') }}</span>
                        <x-heroicon-o-x class="h-6 w-6"/>
                    </button>
                </div>
            </div>
            <div class="pt-5 pb-6">
{{--                <div class="px-2 space-y-1">--}}
{{--                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">Product</a>--}}

{{--                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">Features</a>--}}

{{--                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">Marketplace</a>--}}

{{--                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">Company</a>--}}
{{--                </div>--}}
                <div class="mt-6 px-5">
                    <a href="{{ route('register') }}"
                       class="block text-center w-full py-3 px-4 rounded-md shadow bg-gradient-to-r from-teal-500 to-cyan-600 text-white font-medium hover:from-teal-600 hover:to-cyan-700">
                        {{ __('Start free trial') }}
                    </a>
                </div>
                <div class="mt-6 px-5">
                    <p class="text-center text-base font-medium text-gray-500">
                        {{ __('Existing customer?') }}
                        <a href="{{ route('login') }}" class="text-gray-900 hover:underline">{{ __('Log in') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>
