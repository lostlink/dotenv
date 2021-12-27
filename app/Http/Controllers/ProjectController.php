<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(): \Illuminate\Http\Response
    {
        //
    }

    public function create(): \Illuminate\Http\Response
    {
        //
    }

    public function store(StoreProjectRequest $request): \Illuminate\Http\Response
    {
        //
    }

    public function show(Project $project): \Illuminate\Contracts\View\View
    {
        return view('project.show', [
            'project' => $project
        ]);
    }

    public function edit(Project $project): \Illuminate\Http\Response
    {
        //
    }

    public function update(UpdateProjectRequest $request, Project $project): \Illuminate\Http\Response
    {
        //
    }

    public function destroy(Project $project): \Illuminate\Http\Response
    {
        //
    }
}
