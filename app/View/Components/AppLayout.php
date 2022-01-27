<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('layouts.app');
    }
}
