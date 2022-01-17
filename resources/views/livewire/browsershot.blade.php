<span class="inline-block relative">
  <img class="h-16 w-16 rounded-md" src="{{ $imageUrl }}"
       alt="{{ $imageName }}">
  <span
      class="absolute bottom-0 right-0 transform translate-y-1/2 translate-x-1/2 block border-2 border-white rounded-full">
    <button wire:click="refresh()" type="button" class="cursor-pointer block h-4 w-4 rounded-full bg-gray-300">
            <x-heroicon-o-refresh/>
    </button>
  </span>
</span>
