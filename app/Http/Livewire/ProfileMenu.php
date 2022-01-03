<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProfileMenu extends Component
{
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('layouts.livewire.profile-menu');
    }
}
