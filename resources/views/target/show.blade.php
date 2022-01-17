<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol role="list" class="flex items-center space-x-4">
                <li>
                    <div>
                        <a href="{{ __('dashboard') }}" class="text-gray-400 hover:text-gray-500">
                            <x-heroicon-s-home class="flex-shrink-0 h-5 w-5"/>
                            <span class="sr-only">Home</span>
                        </a>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                        <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                        <a href="{{ route('project.index') }}"
                           class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                            {{ __('Project') }}
                        </a>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                        <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                        <a href="{{ route('project.show', ['project' => $project->routeKey]) }}"
                           class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                            {{ $project->name }}
                        </a>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                        <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                        <a href="{{ route('project.show', ['project' => $project->routeKey]) }}"
                           class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                            {{ __('Target') }}
                        </a>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                        <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                        <a href="{{ route('project.target.show', ['project' => $project->routeKey, 'target' => $target->routeKey]) }}"
                           class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                           aria-current="page">
                            {{ $target->name }}
                        </a>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">

        <div class="sm:flex">
            <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                <livewire:browsershot :model="$target->project" class="h-32 w-full sm:w-32 border border-gray-300 bg-white text-gray-300"/>
            </div>
            <div>
                <h4 class="text-lg font-bold">
                    {{ $target->project->name }} -> {{ $target->name }}
                </h4>
                <p class="mt-1">
                    {{ $target->description ?? $target->project->description }}
                </p>
            </div>
        </div>

        <div class="md:flex md:items-center md:justify-between">
{{--            <h3 class="text-lg leading-6 font-medium text-gray-900">--}}
{{--                {{ __('Environment Variables') }}--}}
{{--            </h3>--}}
        </div>
        <div class="mt-4" x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'target' }">
            <div class="lg:hidden sm:hidden">
                <label for="current-tab" class="sr-only">{{ __('Select Environment') }}</label>
                <select
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                    x-model="tab"
                    @change="window.location.hash = tab">
                    <option :value="'project'">{{ __('Project') }}</option>
                    <option :value="'target'">{{ __('Target') }}</option>
                    @foreach($target->environments as $environment)
                        <option :value="'{{ $environment->routeKey }}'">{{ $environment->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="hidden sm:block">
                <nav class="-mb-px flex space-x-8">
                    <a class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm"
                       :class="{ 'border-indigo-500 text-indigo-600': tab === 'project' }"
                       @click.prevent="tab = 'project'; window.location.hash = 'project'"
                       href="#project">
                        {{ __('Project') }}
                    </a>

                    <span
                        class="border-transparent text-gray-500 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                        <x-heroicon-s-chevron-right class="w-5 h-5"/>
                    </span>

                    <a class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm"
                       :class="{ 'border-indigo-500 text-indigo-600': tab === 'target' }"
                       @click.prevent="tab = 'target'; window.location.hash = 'target'"
                       href="#target">
                        {{ __('Target') }}
                    </a>

                    <span
                        class="border-transparent text-gray-500 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                        <x-heroicon-s-chevron-right class="w-5 h-5"/>
                    </span>

                    @foreach($target->environments as $environment)
                        <a class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm"
                           :class="{ 'border-indigo-500 text-indigo-600': tab === '{{ $environment->routeKey }}' }"
                           @click.prevent="tab = '{{ $environment->routeKey }}'; window.location.hash = '{{ $environment->routeKey }}'"
                           href="#{{ $environment->routeKey }}">
                            {{ $environment->name }}
                        </a>
                        @if(!$loop->last)
                            <span
                                class="border-transparent text-gray-500 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm"> / </span>
                        @endif
                    @endforeach

                    <span
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">  </span>
                    <a href="#"
                       @click.prevent='Livewire.emit("openModal", "environment.create", {!! json_encode(['target' => $target->id]) !!})'
                       class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                        Create New Environment
                    </a>

                </nav>
            </div>

            <div x-show="tab === 'project'" x-cloak>
                <livewire:environment.edit
                    :model="$project"
                    :title="$project->name"
                    :project="$project"
                />
            </div>
            <div x-show="tab === 'target'" x-cloak>
                <livewire:environment.edit
                    :model="$target"
                    :title="$target->name"
                    :project="$project"
                    :target="$target"
                />
            </div>
            @foreach($target->environments as $environment)
                <div x-show="tab === '{{ $environment->routeKey }}'" x-cloak>
                    <livewire:environment.edit
                        :model="$environment"
                        :title="$environment->name"
                        :project="$project"
                        :target="$target"
                        :environment="$environment"
                    />
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
