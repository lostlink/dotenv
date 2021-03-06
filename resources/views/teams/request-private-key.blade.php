<div>

    <div class="space-y-6">
        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Private Key</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Please provide your Private Key or generate a new one in
                        order to encrypt/decrypt the Variables.
                    </p>
                </div>
                <div x-data="{ isShowing: false }"
                    class="mt-5 md:mt-0 md:col-span-2">
                    <form class="space-y-6" wire:submit.prevent="submit"
                        method="POST">
                        <div>
                            <div class="flex justify-between">
                                <label for="notes"
                                    class="block text-sm font-medium text-gray-700">
                                    Private Key
                                </label>
                            </div>
                            <div class="mt-1">
                                <textarea wire:model="privateKey"
                                    id="privateKey" name="privateKey" rows="3"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                            </div>
                            <p class="mt-2 text-sm text-red-600"
                                id="notes-error">
                                @error('privateKey') {{ $message }}
                                @enderror
                            </p>
                        </div>


                        <div x-show="isShowing" x-cloak class="flex">
                            <div>
                                <x-heroicon-o-exclamation
                                    class="h-12 w-12 text-red-400" />
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-500 flex">
                                    Copy and keep this Key safe.
                                </p>
                                <p class="text-sm text-gray-500 flex">
                                    It won't be shown again and can't be
                                    recovered!
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button wire:click.prevent="generateKey"
                                @click.prevent="isShowing = true" type="button"
                                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Generate New Key
                            </button>
                            <button wire:click.prevent="$emit('closeModal')"
                                type="button"
                                class="ml-3  bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </button>
                            <button type="submit"
                                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
