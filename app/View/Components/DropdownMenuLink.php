<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DropdownMenuLink extends Component
{
    public string $active;
    public ?string $index;

    public function __construct($active = false, $index = null)
    {
        $this->active = $active;
        $this->index = $index;
    }

    public function render()
    {
        return view('components.dropdown-menu-link');
    }
}
