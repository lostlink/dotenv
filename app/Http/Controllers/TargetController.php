<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTargetRequest;
use App\Http\Requests\UpdateTargetRequest;
use App\Models\Project;
use App\Models\Target;

class TargetController extends Controller
{
    public function show(Project $project, Target $target): \Illuminate\Contracts\View\View
    {
        return view('target.show', [
            'project' => $project,
            'target' => $target
        ]);
    }
}
