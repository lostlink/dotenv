<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DropdownMenuLink extends Component
{
    public function __construct(public $active = false, public ?string $index = null)
    {
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('components.app.dropdown-menu-link');
    }
}
