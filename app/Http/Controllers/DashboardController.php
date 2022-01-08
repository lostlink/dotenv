<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('dashboard', [
            'projectsCount' => Project::where('team_id', currentTeam('id'))->count(),
            'targetsCount' => Project::where('team_id', currentTeam('id'))->count(),
            'environmentsCount' => Project::where('team_id', currentTeam('id'))->count(),
            'activities' => Activity::where('team_id', currentTeam('id'))->get()
                ->map(function ($activity) {
                    $causerType = $activity->getAttribute('causer_type');
                    $subjectType = $activity->getAttribute('subject_type');

                    return collect([
                        'description' => $activity->getAttribute('description'),
                        'causer' => (new $causerType())->find($activity->getAttribute('causer_id')),
                        'subject' => (new $subjectType())->find($activity->getAttribute('subject_id')),
                        'properties' => $activity->getAttribute('properties'),
                        'created_at' => $activity->getAttribute('created_at'),
                    ]);
                }),
        ]);
    }
}
