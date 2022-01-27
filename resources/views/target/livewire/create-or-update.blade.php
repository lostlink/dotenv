<div>

    <div class="space-y-6">
        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Target Details</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        For which Target do you need to manage Environments.
                    </p>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form class="space-y-6" wire:submit.prevent="submit" method="POST">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <div class="flex justify-between">
                                    <label for="name" class="block text-sm font-medium text-gray-700">
                                        Name
                                    </label>
                                </div>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" wire:model="name" name="name" id="name" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="ServerX, EC2, Vapor, Lambda, etc">

                                </div>
                                <p class="mt-2 text-sm text-red-600" id="name-error">
                                    @error('name') {{ $message }} @enderror
                                </p>
                            </div>
                        </div>

                        <div class="col-span-3 sm:col-span-2">
                            <div class="flex justify-between">
                                <label for="url" class="block text-sm font-medium text-gray-700">
                                    URL
                                </label>
                                <span class="text-sm text-gray-500" id="url-optional">Optional</span>
                            </div>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                    <span
                                        class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                      http(s)://
                                    </span>
                                <input type="text" wire:model="url" name="url" id="url"
                                       class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                       placeholder="www.example.com">
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="name-error">
                                @error('url') {{ $message }} @enderror
                            </p>
                        </div>

                        <div>
                            <div class="flex justify-between">
                                <label for="notes" class="block text-sm font-medium text-gray-700">
                                    Notes
                                </label>
                                <span class="text-sm text-gray-500" id="notes-optional">Optional</span>
                            </div>
                            <div class="mt-1">
                                <textarea wire:model="notes" id="notes" name="notes" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="notes-error">
                                @error('notes') {{ $message }} @enderror
                            </p>
                            <p class="mt-2 text-sm text-gray-500">
                                Brief description/notes of your target if needed. (Optional)
                            </p>
                        </div>

{{--                        <div>--}}
{{--                            <div class="flex justify-between">--}}
{{--                                <label for="variables" class="block text-sm font-medium text-gray-700">--}}
{{--                                    Environment Variables--}}
{{--                                </label>--}}
{{--                                <span class="text-sm text-gray-500" id="variables-optional">Optional</span>--}}
{{--                            </div>--}}
{{--                            <div class="mt-1">--}}
{{--                                <textarea wire:model="variables" id="variables" name="variables" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="APP_NAME=MyAwesomeProject"></textarea>--}}
{{--                            </div>--}}
{{--                            <p class="mt-2 text-sm text-red-600" id="variables-error">--}}
{{--                                @error('variables') {{ $message }} @enderror--}}
{{--                            </p>--}}
{{--                            <p class="mt-2 text-sm text-gray-500">--}}
{{--                                These ENV Vars will be common to all Enviroments in this Target's scope, you can add them later if you wish.--}}
{{--                            </p>--}}
{{--                        </div>--}}

                        <div class="flex justify-end">
                            <button type="button" wire:click.prevent="$emit('closeModal')" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </button>
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
