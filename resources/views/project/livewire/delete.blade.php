<div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Delete Project: {{ $project->name }}
            </h3>
            <div class="mt-2 max-w-xl text-sm text-gray-500">
                <p>
                    Once you delete this project, you <span class="underline"><span class="font-bold">WILL</span> <span class="italic">LOSE</span> <span class="font-bold">ALL</span></span> data associated with it.
                </p>
            </div>
            <div class="mt-5">
                <button type="button"
                        wire:click.prevent="delete"
                        class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                    Delete Project
                </button>
            </div>
        </div>
    </div>

</div>
