<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarMenuLink extends Component
{
    public string $active;

    public function __construct($active)
    {
        $this->active = $active;
    }

    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.sidebar-menu-link');
    }
}
