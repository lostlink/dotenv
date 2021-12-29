<div>
    <form wire:submit.prevent="save" class="relative">
        <div
            class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
            <label for="title" class="sr-only">Title</label>
            <input disabled
                   type="text"
                   name="title"
                   id="title"
                   class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:ring-0"
                   value="{{ $title }}">

            <label for="description" class="sr-only">Variables</label>
            <textarea wire:model="variables"
                      rows="7"
                      name="variables"
                      id="variables"
                      class="block w-full border-0 py-0 resize-none placeholder-gray-500 focus:ring-0 sm:text-sm"
                      placeholder="ENV=VALUE"></textarea>

            <!-- Spacer element to match the height of the toolbar -->
            <div aria-hidden="true">
                <div class="py-2">
                    <div class="h-1"></div>
                </div>
                <div x-data="{ input: '' }" class="h-px">
                    @if($project && $target && $environment)
                        <button type="button" @click="$clipboard(input)"
                                class="ml-4 -my-2 rounded-full px-3 py-2 inline-flex items-center text-left text-gray-400 group">
                            <x-heroicon-o-clipboard-copy class="-ml-1 h-5 w-5 mr-2 group-hover:text-gray-500"/>
                            <span x-model="input" class="text-sm text-gray-500 group-hover:text-gray-600 italic">
                                {{ config('app.url') }}/api/{{ $project->slug }}/{{ $target->slug }}/{{ $environment->slug }}/env
                            </span>
                        </button>
                    @endif
                </div>
                <div class="py-2">
                    <div class="py-px">
                        <div class="h-7"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2 flex @if($project && $target && $environment) justify-between @else justify-end @endif">
            @if($project && $target && $environment)
            <button type="button"
                    @click.prevent='Livewire.emit("openModal", "delete-environment", {!! json_encode(['environment_id' => $environment->id]) !!})'
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Delete
            </button>
            @endif
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update
            </button>
        </div>

    </form>

</div>



