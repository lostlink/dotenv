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
                           class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Project') }}</a>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                        <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                        <a href="{{ route('project.show', ['project' => $project->routeKey]) }}"
                           class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                           aria-current="page">{{ $project->name }}</a>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                        <x-heroicon-s-chevron-right class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                        <a href="{{ route('project.show', ['project' => $project->routeKey]) }}"
                           class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Targets') }}</a>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">

        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($project->targets as $target)
                <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                    <a href="{{ route('project.target.show', ['project' => $project->routeKey, 'target' => $target->routeKey]) }}"
                       type="button">
                        <div class="flex-1 flex flex-col p-8">
                            <h3 class="mt-6 text-gray-900 text-sm font-medium">{{ $target->name }}</h3>
                            @foreach($target->environments as $environment)
                                <div class="ml-2 flex-shrink-0 flex">
                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ \App\Helpers\BadgeColor::get($environment->color) ?? \App\Helpers\BadgeColor::guess($environment->name) }}">
                                        {{ $environment->name }}
                                    </p>
                                </div>
                            @endforeach

{{--                            <dl class="mt-1 flex-grow flex flex-col justify-between">--}}
{{--                                <dt class="sr-only">{{ __('Notes') }}</dt>--}}
{{--                                <dd class="text-gray-500 text-sm">{{ $target->notes }}</dd>--}}
{{--                            </dl>--}}
                        </div>
                    </a>
                </li>
            @endforeach

            <li class="col-span-1 flex flex-col text-center rounded-lg divide-y divide-gray-200">
                <button type="button" onclick='Livewire.emit("openModal", "target.create", {!! json_encode(['project' => $project->id]) !!})' class="relative block w-full h-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <x-heroicon-o-folder-add class="mx-auto h-12 w-12 text-gray-400"/>
                    <span class="mt-2 block text-sm font-medium text-gray-900">{{ __('Create a new Target') }}</span>
                </button>
            </li>
        </ul>

        <div class="py-10">
            <label for="comment" class="block text-sm font-medium text-gray-700">Common ENV for ALL Targets</label>
            <div class="mt-1">
                <livewire:environment.edit
                    :model="$project"
                    :title="$project->name"
                    :project="$project"
                />
            </div>
        </div>
    </div>
</x-app-layout>
