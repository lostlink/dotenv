<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchBar extends Component
{
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.search-bar');
    }
}
