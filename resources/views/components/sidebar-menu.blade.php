<div>
    {{-- Sidebar for Mobile --}}
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
                <img class="h-8 w-auto"
                     src="https://tailwindui.com/img/logos/workflow-logo-indigo-300-mark-white-text.svg" alt="Workflow">
            </div>

            <div class="mt-5 flex-1 h-0 overflow-y-auto">
                <nav class="px-2 space-y-1">

                    <x-sidebar-menu-link :active="request()->routeIs('dashboard')" href="{{ route('dashboard') }}"
                                         class="text-base font-medium">
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

    {{-- Sidebar for Desktop --}}
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">

        {{-- Sidebar --}}
        <div class="flex flex-col flex-grow pt-5 bg-indigo-700 overflow-y-auto">

            {{-- Desktop Logo --}}
            <div class="flex items-center flex-shrink-0 px-4">
                <img class="h-8 w-auto"
                     src="https://tailwindui.com/img/logos/workflow-logo-indigo-300-mark-white-text.svg" alt="Workflow">
            </div>

            <div class="mt-5 flex-1 flex flex-col">
                <nav class="flex-1 px-2 pb-4 space-y-1">

                    <x-sidebar-menu-link :active="request()->routeIs('dashboard')" href="{{ route('dashboard') }}">
                        <x-heroicon-o-home class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300"/>
                        {{ __('Dashboard') }}
                    </x-sidebar-menu-link>

                    <x-sidebar-menu-link :active="request()->routeIs('project.*')" href="{{ route('project.index') }}">
                        <x-heroicon-o-folder class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300"/>
                        {{ __('Projects') }}
                    </x-sidebar-menu-link>


                    {{--                    <x-sidebar-menu-link :active="request()->routeIs('reports')" href="{{ route('reports') }}" >--}}
                    {{--                        <x-heroicon-o-home class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300"/>--}}
                    {{--                        {{ __('Reports') }}--}}
                    {{--                    </x-sidebar-menu-link>--}}

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="px-3 bg-indigo-700 text-lg font-medium text-white">
                                <a href="{{ route('project.index') }}">Projects</a>
                            </span>
                        </div>
                    </div>

                    @if($projects)
                        @foreach($projects as $project)
                            <x-sidebar-menu-link :active="request()->is('project/'.$project->slug,'project/'.$project->slug.'/*')"
                                                 href="{{ route('project.show', ['project' => $project->slug]) }}">
                                <x-heroicon-o-code class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300"/>
                                {{ $project->name }}
                            </x-sidebar-menu-link>
                        @endforeach
                    @endif

                    @if($projects->isEmpty())
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-300">No projects</h3>
                            <p class="mt-1 text-sm text-gray-400">
                                Get started by creating a new project.
                            </p>
                            <div class="mt-6">
                                <button type="button" onclick='Livewire.emit("openModal", "create-project")'
                                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <x-heroicon-s-plus class="-ml-1 mr-2 h-5 w-5"/>
                                    New Project
                                </button>
                            </div>
                        </div>
                    @endif

                </nav>
            </div>
        </div>
    </div>
</div>
