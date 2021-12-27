<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project') . ' => ' . $project->name }}
        </h2>
    </x-slot>


    <div class="flex-1 relative z-0 flex overflow-hidden">
        <div class="flex-1 relative z-0 overflow-y-auto focus:outline-none">
            <!-- Start main area-->
            <div class="absolute inset-0 py-6 px-4 sm:px-6 lg:px-8">
                <div class="h-full border-2 border-gray-200 border-dashed rounded-lg"></div>
            </div>
            <!-- End main area -->
        </div>
        <div class="hidden relative xl:flex xl:flex-col flex-shrink-0 w-96 border-l border-gray-200 overflow-y-auto">
            <!-- Start secondary column (hidden on smaller screens) -->
            <div class="absolute inset-0 py-6 px-4 sm:px-6 lg:px-8">
                <div class="h-full border-2 border-gray-200 border-dashed rounded-lg"></div>
            </div>
            <!-- End secondary column -->
        </div>
    </div>


    <div class="py-12">

            <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach($project->targets as $target)
                    <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                        <button type="button">
                            <div class="flex-1 flex flex-col p-8">
                                <h3 class="mt-6 text-gray-900 text-sm font-medium">{{ $target->name }}</h3>
                                <dl class="mt-1 flex-grow flex flex-col justify-between">
                                    <dt class="sr-only">{{ __('Description') }}</dt>
                                    <dd class="text-gray-500 text-sm">{{ $target->description }}</dd>
                                </dl>
                            </div>
                            <div>
                                <div class="-mt-px flex divide-x divide-gray-200">
                                    <div class="w-0 flex-1 flex">
                                        <div
                                            class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                            <span class="ml-3">Environments:</span>
                                        </div>
                                    </div>
                                    <div class="-ml-px w-0 flex-1 flex">
                                        <div
                                            class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                            <span class="ml-3">{{ $target->environments->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </button>

                    </li>
                @endforeach

                <li class="col-span-1 flex flex-col text-center rounded-lg shadow divide-y divide-gray-200">
                    <button type="button"
                            class="relative block w-full h-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <x-heroicon-o-folder-add class="mx-auto h-12 w-12 text-gray-400"/>
                        <span
                            class="mt-2 block text-sm font-medium text-gray-900">{{ __('Create a new Target') }}</span>
                    </button>
                </li>
            </ul>

        <div class="py-10">
            <label for="comment" class="block text-sm font-medium text-gray-700">Common ENV for ALL Targets</label>
            <div class="mt-1">
                <livewire:components.edit-field :model="'\App\Models\Project'" :entity="$project" :field="'variables'" :key="'id'.$project->id"/>

{{--                <textarea rows="4" name="variables" id="variables" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full h-full sm:text-sm border-gray-300 rounded-md">{{--}}
{{--                        collect($project->variables)--}}
{{--                            ->map(fn($content, $variable) => implode('=', [$variable, $content]))--}}
{{--                            ->implode(PHP_EOL)--}}
{{--                }}</textarea>--}}
            </div>
        </div>


        {{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
        {{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
        {{--                {{ $project }}--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
</x-app-layout>


{{--<button type="button" class="relative block w-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">--}}
{{--    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">--}}
{{--        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.721-.087 4-.252M8 14c0 4.418 7.163 8 16 8s16-3.582 16-8M8 14c0-4.418 7.163-8 16-8s16 3.582 16 8m0 0v14m0-4c0 4.418-7.163 8-16 8S8 28.418 8 24m32 10v6m0 0v6m0-6h6m-6 0h-6" />--}}
{{--    </svg>--}}
{{--    <span class="mt-2 block text-sm font-medium text-gray-900">--}}
{{--    Create a new Environment--}}
{{--  </span>--}}
{{--</button>--}}
