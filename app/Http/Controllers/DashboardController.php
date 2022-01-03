<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Team;

class DashboardController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('dashboard', [
            'projectsCount' => Project::where('team_id', currentTeam('id'))->count(),
            'targetsCount' => Project::where('team_id', currentTeam('id'))->count(),
            'environmentsCount' => Project::where('team_id', currentTeam('id'))->count(),
            'activities' => Team::with(['activities'])
                ->where('id', currentTeam('id'))
                ->first()
                ->activities,
        ]);
    }
}
