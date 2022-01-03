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
