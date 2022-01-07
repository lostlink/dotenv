<div>
    <form wire:submit.prevent="save" class="relative">
        <div
            class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
            <label for="title" class="sr-only">Title</label>
            <div class="relative">
                <input value="{{ $title }}" type="text" name="title" id="title" disabled
                       class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:ring-0">
                @error('variables')
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <x-heroicon-s-exclamation-circle class="h-5 w-5 text-red-500"/>
                    <p class="text-sm text-red-600" id="email-error">{{ $message }}</p>
                </div>
                @enderror
            </div>


            <label for="description" class="sr-only">Variables</label>
            <textarea wire:model="variables" rows="7" name="variables" id="variables" placeholder="ENV=VALUE"
                      class="block w-full border-0 py-0 resize-none placeholder-gray-500 focus:ring-0 sm:text-sm"></textarea>

            <!-- Spacer element to match the height of the toolbar -->
            <div aria-hidden="true">
                <div class="py-2">
                    <div class="h-1"></div>
                </div>
                <div x-data="{ input: '' }" class="flex h-px justify-end">
                    <div class="flex-1">
                        @if($project && $target && $environment)
                            <button type="button" @click="$clipboard(input)"
                                    class="ml-4 -my-2 rounded-full px-3 py-2 inline-flex items-center text-left text-gray-400 group">
                                <x-heroicon-o-clipboard-copy class="-ml-1 h-5 w-5 mr-2 group-hover:text-gray-500"/>
                                <span x-model="input" class="text-sm text-gray-500 group-hover:text-gray-600 italic">
                                {{ config('app.url') }}/api/{{ $project->slug }}/{{ $target->slug }}/{{ $environment->slug }}
                            </span>
                            </button>
                        @endif
                    </div>

                    <div class="flex">
                        <button type="button"
                                wire:click="encrypt"
                                class="inline-flex items-center px-2.5 py-1.5 shadow-sm text-xs font-medium rounded text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <x-heroicon-o-lock-closed class="-ml-1 h-5 w-5 mr-2 group-hover:text-gray-500"/>
                            Encrypt
                        </button>

                        <button type="button"
                                wire:click="decrypt"
                                class="inline-flex items-center px-2.5 py-1.5 shadow-sm text-xs font-medium rounded text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <x-heroicon-o-lock-open class="-ml-1 h-5 w-5 mr-2 group-hover:text-gray-500"/>
                            Decrypt
                        </button>
                    </div>

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
                        @click.prevent='Livewire.emit("openModal", "environment.delete", {!! json_encode(['environment' => $environment->id]) !!})'
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



