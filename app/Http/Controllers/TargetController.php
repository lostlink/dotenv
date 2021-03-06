<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Target;

class TargetController extends Controller
{
    public function show(Project $project, Target $target): \Illuminate\Contracts\View\View
    {
        $this->authorize('view', [$target, $project]);

        return view('target.show', [
            'project' => $project,
            'target' => $target,
        ]);
    }
}
