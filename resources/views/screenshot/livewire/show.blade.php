<div class="inline-block relative">
    <img class="h-16 w-16 rounded-md" src="{{ $imageUrl }}"
         alt="{{ $imageName }}">

    <div
        class="absolute bottom-0 right-0 transform translate-y-1/2 translate-x-1/2 block border-2 border-white rounded-full">
        <button type="button"
                onclick='Livewire.emit("openModal", "screenshot.update", @json(['class'=> $model::class, 'model' => $model]))'
                class="cursor-pointer block h-5 w-5 rounded-full bg-gray-300 justify-center">
            <x-heroicon-s-camera
                class="h-4 w-4 text-indigo-500 ml-0.5 hover:text-indigo-700"/>
        </button>

    </div>


</div>
