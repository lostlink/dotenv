<x-app-layout>
    <x-slot name="header">
        <nav class="flex" aria-label="Breadcrumb">
            <ol role="list" class="flex items-center space-x-4">
                <li>
                    <div>
                        <a href="{{ route('dashboard') }}"
                           class="text-gray-400 hover:text-gray-500">
                            <x-heroicon-s-home class="flex-shrink-0 h-5 w-5"/>
                            <span class="sr-only">Home</span>
                        </a>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                        <x-heroicon-s-chevron-right
                            class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                        <a href="{{ route('project.index') }}"
                           class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Project') }}</a>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                        <x-heroicon-s-chevron-right
                            class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                        <a href="{{ route('project.show', ['project' => $project->routeKey]) }}"
                           class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                           aria-current="page">{{ $project->name }}</a>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                        <x-heroicon-s-chevron-right
                            class="flex-shrink-0 h-5 w-5 text-gray-400"/>
                        <a href="{{ route('project.show', ['project' => $project->routeKey]) }}"
                           class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Targets') }}</a>
                    </div>
                </li>
            </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <ul role="list"
            class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($project->targets as $target)
                <li
                    class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                    <a href="{{ route('project.target.show', ['project' => $project->routeKey, 'target' => $target->routeKey]) }}"
                       type="button">
                        <div class="flex-1 flex flex-col p-8">
                            <img class="w-32 h-32 flex-shrink-0 mx-auto rounded-full text-gray-400"
                                 src="{{ $target->getFirstMediaUrl('browsershot') }}"
                                 alt="{{ $target->name }}"
                            >
                            <h3 class="mt-6 text-gray-900 text-sm font-medium">
                                {{ $target->name }}
                            </h3>
                            <dl
                                class="mt-1 flex-grow flex flex-col justify-between">
                                <dt class="sr-only">{{ __('Notes') }}
                                </dt>
                                <dd class="text-gray-500 text-sm">
                                    {{ $target->notes }}</dd>
                            </dl>
                            @foreach ($target->environments as $environment)
                                <div class="ml-2 flex-shrink-0 flex">
                                    <p
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ \App\Helpers\BadgeColor::get($environment->color) ?? \App\Helpers\BadgeColor::guess($environment->name) }}">
                                        {{ $environment->name }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </a>
                    <div>
                        <div class="-mt-px flex divide-x divide-gray-200">
                            <div class="w-0 flex-1 flex">
                                <a onclick='Livewire.emit("openModal", "target.delete", @json(['target'=> $target->id]))'
                                   class="cursor-pointer relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-red-700 font-medium border border-transparent rounded-bl-lg hover:red-gray-500">
                                    <x-heroicon-s-trash
                                        class="w-5 h-5 text-red-400"/>
                                    <span
                                        class="ml-3">{{ __('Delete') }}</span>
                                </a>
                            </div>
                            <div class="-ml-px w-0 flex-1 flex">
                                <a onclick='Livewire.emit("openModal", "target.update", @json(['target'=> $target->id]))'
                                   class="cursor-pointer relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-green-700 font-medium border border-transparent rounded-br-lg hover:text-green-500">
                                    <x-heroicon-s-pencil
                                        class="w-5 h-5 text-green-400"/>
                                    <span
                                        class="ml-3">{{ __('Edit') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach

            <li
                class="col-span-1 flex flex-col text-center rounded-lg divide-y divide-gray-200">
                <button type="button"
                        onclick='Livewire.emit("openModal", "target.create", @json(['project'=> $project->id]))'
                        class="relative block w-full h-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <x-heroicon-o-folder-add
                        class="mx-auto h-12 w-12 text-gray-400"/>
                    <span
                        class="mt-2 block text-sm font-medium text-gray-900">{{ __('Create a new Target') }}</span>
                </button>
            </li>
        </ul>

        <div class="py-10">
            <label for="comment"
                   class="block text-sm font-medium text-gray-700">Common ENV for
                ALL Targets</label>
            <div class="mt-1">
                <livewire:environment.edit :model="$project" :title="$project->name" :project="$project"/>
            </div>
        </div>
    </div>
</x-app-layout>
