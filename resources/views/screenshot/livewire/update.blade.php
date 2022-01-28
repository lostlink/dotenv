<div>
    <div class="space-y-6">
        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <img class="h-32 w-32 rounded-md" src="http://dotenv.test/images/profile/project.webp" alt="Balh">
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form class="space-y-6" wire:submit.prevent="submit" method="POST">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <x-media-library-attachment name="myUpload" />
                                </div>
                                <p class="mt-2 text-sm text-red-600" id="name-error">
                                    @error('name') {{ $message }} @enderror
                                </p>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between">
                                <label for="notes" class="block text-sm font-medium text-gray-700">
                                    Notes
                                </label>
                                <span class="text-sm text-gray-500" id="notes-optional">Optional</span>
                            </div>
                            <div class="mt-1">
                                <textarea wire:model="notes" id="notes" name="notes" rows="3"
                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="notes-error">
                                @error('notes') {{ $message }} @enderror
                            </p>
                            <p class="mt-2 text-sm text-gray-500">
                                Brief description/notes of your target if needed. (Optional)
                            </p>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" wire:click.prevent="$emit('closeModal')"
                                    class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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

</div>
