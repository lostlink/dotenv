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

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Targets
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($projects as $project)

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('project.show', ['project' => $project->routeKey]) }}"
                                           class="block hover:bg-gray-50">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="{{ asset('images/profile/project.webp') }}" alt="{{ $project->name }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $project->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $project->notes }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach($project->targets as $target)
                                            <a href="{{ route('project.target.show', ['project' => $project->slug, 'target' => $target->slug]) }}">
                                            <div class="text-sm text-gray-500">{{ $target->name }}</div>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if(empty($project->disabled_at))
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                              Active
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                              Disabled
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('project.show', ['project' => $project->routeKey]) }}"
                                           class="text-indigo-600 hover:text-indigo-900">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <x-heroicon-s-eye class="-ml-0.5 mr-2 h-4 w-4"/>
                                                View
                                            </button>
                                        </a>

                                        <a onclick='Livewire.emit("openModal", "project.edit", {!! json_encode(['project' => $project->id]) !!})'
                                           class="cursor-pointer text-green-600 hover:text-green-900">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <x-heroicon-s-pencil class="-ml-0.5 mr-2 h-4 w-4"/>
                                                Edit
                                            </button>
                                        </a>

                                        <a onclick='Livewire.emit("openModal", "project.delete", {!! json_encode(['project' => $project->id]) !!})'
                                           class="cursor-pointer text-red-600 hover:text-red-900">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                <x-heroicon-s-trash class="-ml-0.5 mr-2 h-4 w-4"/>
                                                Delete
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
