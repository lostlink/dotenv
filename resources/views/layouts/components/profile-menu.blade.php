<div x-data="Components.menu({ open: false })"
     x-init="init()"
     @keydown.escape.stop="open = false; focusButton()"
     @click.away="onClickAway($event)"
     class="ml-3 relative">
    <div>
        <button type="button"
                class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                id="user-menu-button"
                x-ref="button"
                @click="onButtonClick()"
                @keyup.space.prevent="onButtonEnter()"
                @keydown.enter.prevent="onButtonEnter()"
                aria-expanded="false"
                aria-haspopup="true"
                x-bind:aria-expanded="open.toString()"
                @keydown.arrow-up.prevent="onArrowUp()"
                @keydown.arrow-down.prevent="onArrowDown()">
            <span class="sr-only">Open user menu</span>
                <img class="h-8 w-8 rounded-full"
                     src="{{ Auth::user()->profile_photo_url }}"
                     alt="{{ Auth::user()->name }}"
                />
        </button>
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         x-bind:aria-activedescendant="activeDescendant"
         class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
         x-ref="menu-items"
         role="menu" aria-orientation="vertical"
         aria-labelledby="user-menu-button"
         tabindex="-1"
         @keydown.arrow-up.prevent="onArrowUp()"
         @keydown.arrow-down.prevent="onArrowDown()"
         @keydown.tab="open = false"
         @keydown.enter.prevent="open = false; focusButton()"
         @keyup.space.prevent="open = false; focusButton()"
         style="display: none;"
    >

        <div>
            <div class="px-4 text-sm text-gray-800">{{ Auth::user()->name }}</div>
            <div class="px-4 py-2 text-sm text-gray-500">{{ Auth::user()->email }}</div>
        </div>

        <div class="border-t border-gray-200"></div>

        <!-- Account Management -->
        <x-dropdown-menu-link
            href="{{ route('profile.show') }}"
            :active="request()->routeIs('profile.show')"
            :index="0"
        >
            {{ __('Profile') }}
        </x-dropdown-menu-link>

        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
            <x-dropdown-menu-link
                href="{{ route('api-tokens.index') }}"
                :active="request()->routeIs('api-tokens.index')"
                :index="1"
            >
                {{ __('API Tokens') }}
            </x-dropdown-menu-link>
        @endif

    <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-menu-link
                href="{{ route('logout') }}"
                onclick="e.preventDefault(); this.closest('form').submit();"
                :active="request()->routeIs('logout')"
                :index="2"
            >
                {{ __('Log Out') }}
            </x-dropdown-menu-link>
        </form>

        <!-- Team Management -->
        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <div class="border-t border-gray-200"></div>

            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Manage Team') }}
            </div>

            <!-- Team Settings -->
            <x-dropdown-menu-link
                href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                :active="request()->routeIs('teams.show')"
                :index="3"
            >
                {{ __('Team Settings') }}
            </x-dropdown-menu-link>

            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <x-dropdown-menu-link
                    href="{{ route('teams.create') }}"
                    :active="request()->routeIs('teams.create')"
                    :index="4"
                >
                    {{ __('Create New Team') }}
                </x-dropdown-menu-link>
            @endcan

            <div class="border-t border-gray-200"></div>

            <!-- Team Switcher -->
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Switch Teams') }}
            </div>

            @foreach (Auth::user()->allTeams() as $team)
                <x-jet-switchable-team :team="$team" component="dropdown-menu-link"/>
            @endforeach
        @endif
    </div>

</div>
