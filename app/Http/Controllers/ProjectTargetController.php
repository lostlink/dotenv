<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectTargetRequest;
use App\Http\Requests\UpdateProjectTargetRequest;
use App\Models\ProjectTarget;

class ProjectTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectTargetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectTargetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectTarget  $projectTarget
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectTarget $projectTarget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectTarget  $projectTarget
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectTarget $projectTarget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectTargetRequest  $request
     * @param  \App\Models\ProjectTarget  $projectTarget
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectTargetRequest $request, ProjectTarget $projectTarget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectTarget  $projectTarget
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectTarget $projectTarget)
    {
        //
    }
}
