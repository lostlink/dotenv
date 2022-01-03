<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol role="list" class="flex items-center space-x-4">
                <li>
                    <div>
                        <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-gray-500">
                            <x-heroicon-s-home class="flex-shrink-0 h-5 w-5"/>
                            <span class="sr-only">Home</span>
                        </a>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                        <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                        <a href="{{ route('project.index') }}"
                           class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Projects') }}</a>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul role="list" class="divide-y divide-gray-200">

                @foreach($projects as $project)
                    <li>
                        <a href="{{ route('project.show', ['project' => $project->routeKey]) }}"
                           class="block hover:bg-gray-50">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-indigo-600 truncate">
                                        {{ $project->name }}
                                    </p>
                                    {{--                                    <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">--}}
                                    {{--                                        <x-heroicon-s-calendar class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"/>--}}
                                    {{--                                        <p>--}}
                                    {{--                                            Created--}}
                                    {{--                                            <time datetime="{{ $project->created_at->format('Y-M-D') }}">--}}
                                    {{--                                                {{ $project->created_at->format('M d, Y') }}--}}
                                    {{--                                            </time>--}}
                                    {{--                                        </p>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <div class="sm:flex">
                                        <p class="flex items-center text-sm text-gray-500">
                                            <x-heroicon-s-location-marker
                                                class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"/>
                                            Targets:
                                        </p>
                                        @foreach($project->targets as $target)
                                            <div class="ml-2 flex-shrink-0 flex">
                                                <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ \App\Helpers\BadgeColor::get($target->color) ?? \App\Helpers\BadgeColor::guess($target->name) }}">
                                                    {{ $target->name }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{--                                    <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">--}}
                                    {{--                                        <x-heroicon-s-calendar class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"/>--}}
                                    {{--                                        <p>--}}
                                    {{--                                            Updated--}}
                                    {{--                                            <time datetime="{{ $project->updated_at->format('Y-M-D') }}">--}}
                                    {{--                                                {{ $project->updated_at->format('M d, Y') }}--}}
                                    {{--                                            </time>--}}
                                    {{--                                        </p>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="text-center">

        @if($projects->isEmpty())
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                 aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No projects</h3>
            <p class="mt-1 text-sm text-gray-500">
                Get started by creating a new project.
            </p>
        @endif
        <div class="mt-6">
            <button type="button" onclick='Livewire.emit("openModal", "project.create")'
                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <x-heroicon-s-plus class="-ml-1 mr-2 h-5 w-5"/>
                New Project
            </button>
        </div>
    </div>


</x-app-layout>
