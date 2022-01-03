<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarMenu extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view(
            'components.app.sidebar-menu',
            [
                'projects' => request()->user()->currentTeam->projects()->get(),
            ]
        );
    }
}
