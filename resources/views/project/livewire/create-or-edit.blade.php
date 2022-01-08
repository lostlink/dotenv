<div>
    <div class="space-y-6">
        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Project Details</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        This information will be displayed publicly so be careful what you share.
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
                                    <input type="text" wire:model="name" name="name" id="name" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="My Awesome Project">

                                </div>
                                <p class="mt-2 text-sm text-red-600" id="name-error">
                                    @error('name') {{ $message }} @enderror
                                </p>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between">
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Description
                                </label>
                                <span class="text-sm text-gray-500" id="description-optional">Optional</span>
                            </div>
                            <div class="mt-1">
                                <textarea wire:model="description" id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="description-error">
                                @error('description') {{ $message }} @enderror
                            </p>
                            <p class="mt-2 text-sm text-gray-500">
                                Brief description of your project.
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
{{--                                These ENV Vars will be common to all Targets/Enviroments, you can add them later.--}}
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
