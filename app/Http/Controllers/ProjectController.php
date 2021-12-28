<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('project.index', [
            'projects' => Project::all()
        ]);
    }

    public function show(Project $project): \Illuminate\Contracts\View\View
    {
        return view('project.show', [
            'project' => $project
        ]);
    }
}
