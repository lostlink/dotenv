<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'projectsCount' => currentTeam()->projects()->count(),
            'targetsCount' => currentTeam()->targets()->count(),
            'environmentsCount' => currentTeam()->environments()->count(),
            'activities' => Activity::where('team_id', currentTeam('id'))->latest()->take(10)->get()
                ->map(function ($activity) {
                    $causerType = $activity->getAttribute('causer_type');
                    $subjectType = $activity->getAttribute('subject_type');

                    return collect([
                        'description' => $activity->getAttribute('description'),
                        'causer' => (new $causerType())->find($activity->getAttribute('causer_id')),
                        'subject' => (new $subjectType())->find($activity->getAttribute('subject_id')),
                        'properties' => $activity->getAttribute('properties'),
                        'succeeded' => $activity->getAttribute('succeeded'),
                        'created_at' => $activity->getAttribute('created_at'),
                    ]);
                }),
        ]);
    }
}
