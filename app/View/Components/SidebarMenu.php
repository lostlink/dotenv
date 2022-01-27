<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarMenu extends Component
{
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(
            'components.app.sidebar-menu',
            [
                'projects' => currentTeam()->projects()->get(),
            ]
        );
    }
}
