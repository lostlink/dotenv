<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
//        $this->authorize('viewAny', Project::class);

        return view('project.index', [
            'projects' => Project::where('team_id', currentTeam('id'))->get(),
        ]);
    }

    public function show(Project $project): \Illuminate\Contracts\View\View
    {
        $this->authorize('view', $project);

        return view('project.show', [
            'project' => $project,
        ]);
    }
}
