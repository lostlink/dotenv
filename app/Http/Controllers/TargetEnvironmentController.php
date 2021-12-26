<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTargetEnvironmentRequest;
use App\Http\Requests\UpdateTargetEnvironmentRequest;
use App\Models\TargetEnvironment;

class TargetEnvironmentController extends Controller
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
     * @param  \App\Http\Requests\StoreTargetEnvironmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTargetEnvironmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TargetEnvironment  $targetEnvironment
     * @return \Illuminate\Http\Response
     */
    public function show(TargetEnvironment $targetEnvironment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TargetEnvironment  $targetEnvironment
     * @return \Illuminate\Http\Response
     */
    public function edit(TargetEnvironment $targetEnvironment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTargetEnvironmentRequest  $request
     * @param  \App\Models\TargetEnvironment  $targetEnvironment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTargetEnvironmentRequest $request, TargetEnvironment $targetEnvironment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TargetEnvironment  $targetEnvironment
     * @return \Illuminate\Http\Response
     */
    public function destroy(TargetEnvironment $targetEnvironment)
    {
        //
    }
}
