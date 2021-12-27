<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProfileMenu extends Component
{
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    public function render(): \Illuminate\View\View
    {
        return view('layouts.components.profile-menu');
    }
}
