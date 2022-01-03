<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarMenu extends Component
{
    public function render()
    {
        return view(
            'components.app.sidebar-menu',
            [
                'projects' => currentTeam()->projects()->get(),
            ]
        );
    }
}
