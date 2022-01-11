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
            </ol>
        </nav>
    </x-slot>

    <div class="mt-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-lg leading-6 font-medium text-gray-900">Overview</h2>
            <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <x-heroicon-o-document-report class="h-6 w-6 text-gray-400"/>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Projects
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $projectsCount }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <x-heroicon-o-document-report class="h-6 w-6 text-gray-400"/>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Targets
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $targetsCount }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <x-heroicon-o-document-report class="h-6 w-6 text-gray-400"/>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Environments
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $environmentsCount }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
            Activity over the last 10 days
        </h2>

        <div class="mt-2 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:charts.dashboard/>
        </div>

        <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
            Recent activity
        </h2>

        {{-- Activity list (smallest breakpoint only) --}}
        <div class="shadow sm:hidden">
            <ul role="list" class="mt-2 divide-y divide-gray-200 overflow-hidden shadow sm:hidden">
                @foreach($activities as $activity)
                    <li>
                        <a class="block px-4 py-4 bg-white hover:bg-gray-50">
                            <span class="flex items-center space-x-4">
                                <span class="flex-1 flex space-x-2 truncate">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $activity->get('causer')->profile_photo_url }}"
                                             alt="{{ $activity->get('causer')->name }}"
                                             class="h-10 w-10 rounded-full">
                                    </div>
                                    <span class="flex flex-col text-gray-500 text-sm truncate">
                                        <span class="truncate">{{ $activity->get('description') }}</span>
{{--                                        <span><span class="text-gray-900 font-medium">{{ $activity->project->name }}</span> -> {{ $activity->target->name }} -> {{ $activity->environment->name }}</span>--}}
                                        <time datetime="{{ $activity->get('created_at')->format('Y-m-d') }}">
                                            {{ $activity->get('created_at')->format('M D, Y') }}
                                        </time>
                                    </span>
                                </span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>

            {{--            <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200"--}}
            {{--                 aria-label="Pagination">--}}
            {{--                <div class="flex-1 flex justify-between">--}}
            {{--                    <a href="#"--}}
            {{--                       class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500">--}}
            {{--                        Previous--}}
            {{--                    </a>--}}
            {{--                    <a href="#"--}}
            {{--                       class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500">--}}
            {{--                        Next--}}
            {{--                    </a>--}}
            {{--                </div>--}}
            {{--            </nav>--}}

        </div>

        {{-- Activity table (small breakpoint and up) --}}
        <div class="hidden sm:block">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                        <div class="hidden sm:block bg-white shadow overflow-hidden sm:rounded-md">
                            <ul role="list" class="divide-y divide-gray-200">
                                @foreach($activities as $activity)
                                    <li>
                                        <a class="block hover:bg-gray-50">
                                            <div class="flex items-center px-4 py-4 sm:px-6">
                                                <div class="min-w-0 flex-1 flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{ $activity->get('causer')->profile_photo_url }}"
                                                             alt="{{ $activity->get('causer')->name }}"
                                                             class="h-10 w-10 rounded-full">
                                                    </div>
                                                    <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                        <div>
                                                            <p class="text-sm font-medium text-indigo-600 truncate">
                                                                {{ $activity->get('causer')->name }}
                                                            </p>
                                                            <p class="mt-2 flex items-center text-sm text-gray-500">
                                                                <x-heroicon-s-mail
                                                                    class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"/>
                                                                <span class="truncate">
                                                                    {{ $activity->get('causer')->email }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div class="hidden md:block">
                                                            <div>
                                                                <p class="text-sm text-gray-900">
                                                                    Applied on
                                                                    <time
                                                                        datetime="{{ $activity->get('created_at')->format('Y-m-d') }}">
                                                                        {{ $activity->get('created_at')->format('M d, Y') }}
                                                                    </time>
                                                                </p>
                                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                                    @if($activity->get('succeeded'))
                                                                        <x-heroicon-s-check-circle
                                                                            class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400"/>
                                                                    @else
                                                                        <x-heroicon-s-x-circle
                                                                            class="flex-shrink-0 mr-1.5 h-5 w-5 text-red-400"/>
                                                                    @endif
                                                                    {{ $activity->get('description') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <x-heroicon-s-chevron-right class="h-5 w-5 text-gray-400"/>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach

                                <li>
                                    {{-- Pagination --}}
                                    {{--                                    <nav--}}
                                    {{--                                        class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"--}}
                                    {{--                                        aria-label="Pagination">--}}
                                    {{--                                        <div class="hidden sm:block">--}}
                                    {{--                                            <p class="text-sm text-gray-700">--}}
                                    {{--                                                Showing--}}
                                    {{--                                                <span class="font-medium">1</span>--}}
                                    {{--                                                to--}}
                                    {{--                                                <span class="font-medium">10</span>--}}
                                    {{--                                                of--}}
                                    {{--                                                <span class="font-medium">20</span>--}}
                                    {{--                                                results--}}
                                    {{--                                            </p>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="flex-1 flex justify-between sm:justify-end">--}}
                                    {{--                                            <a href="#"--}}
                                    {{--                                               class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">--}}
                                    {{--                                                Previous--}}
                                    {{--                                            </a>--}}
                                    {{--                                            <a href="#"--}}
                                    {{--                                               class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">--}}
                                    {{--                                                Next--}}
                                    {{--                                            </a>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </nav>--}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
