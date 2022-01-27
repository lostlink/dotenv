<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarMenuLink extends Component
{
    public function __construct(public $active)
    {
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('components.app.sidebar-menu-link');
    }
}
