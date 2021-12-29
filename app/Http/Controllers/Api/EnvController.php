<?php

namespace App\Http\Controllers\Api;

use App\Helpers\EnvParser;
use App\Http\Controllers\Controller;
use App\Jobs\RecordActivity;
use App\Models\Environment;
use App\Models\Project;
use App\Models\Target;

class EnvController extends Controller
{
    public function __invoke(Project $project, Target $target, Environment $environment): string
    {
        $env = EnvParser::toEnv(
            collect()
                ->merge(EnvParser::toArray($project->variables))
                ->merge(EnvParser::toArray($target->variables))
                ->merge(EnvParser::toArray($environment->variables))
                ->toArray()
        );

        RecordActivity::dispatch(
            request()->user()->currentTeam,
            request()->user(),
            $project,
            $target,
            $environment,
            'API Call - ENV',
            'success',
            'ENV Variables successfully retrieved',
            $env
        );

        return $env;
    }
}
