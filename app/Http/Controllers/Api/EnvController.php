<?php

namespace App\Http\Controllers\Api;

use App\Helpers\EnvParser;
use App\Http\Controllers\Controller;
use App\Models\Environment;
use App\Models\Project;
use App\Models\Target;
use App\Rules\Env;
use Illuminate\Support\Facades\Validator;
use Spatie\Activitylog\Models\Activity;

class EnvController extends Controller
{
    public function __invoke(Project $project, Target $target, Environment $environment): string
    {
        Validator::make([
            'projectEnv' => $project->variables,
            'targetEnv' => $target->variables,
            'environmentEnv' => $environment->variables,
        ], [
            'projectEnv' => new Env(),
            'targetEnv' => new Env(),
            'environmentEnv' => new Env(),
        ])->validate();

        $env = EnvParser::toEnv(
            collect()
                ->merge(EnvParser::toArray($project->variables))
                ->merge(EnvParser::toArray($target->variables))
                ->merge(EnvParser::toArray($environment->variables))
                ->toArray()
        );

        activity()
            ->causedBy(request()->user())
            ->performedOn($project)
            ->tap(function (Activity $activity) {
                $activity->team_id = currentTeam('id');
            })
            ->withProperties([
                'project' => $project->id,
                'target' => $target->id,
                'environment' => $environment->id,
                'env' => $env,
            ])
            ->log('Environment Variables Retrieved');

        return $env;
    }
}
