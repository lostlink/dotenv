<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Crypt;
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
        $project->setAttribute('variables', $this->decryptIfNecessary($project->getAttribute('variables')));
        $target->setAttribute('variables', $this->decryptIfNecessary($target->getAttribute('variables')));
        $environment->setAttribute('variables', $this->decryptIfNecessary($environment->getAttribute('variables')));

        Validator::make([
            'projectEnv' => $project->getAttribute('variables'),
            'targetEnv' => $target->getAttribute('variables'),
            'environmentEnv' => $environment->getAttribute('variables'),
        ], [
            'projectEnv' => ['nullable', new Env()],
            'targetEnv' => ['nullable', new Env()],
            'environmentEnv' => ['nullable', new Env()],
        ])->validate();

        $env = EnvParser::toEnv(
            collect()
                ->merge(EnvParser::toArray($project->getAttribute('variables')))
                ->merge(EnvParser::toArray($target->getAttribute('variables')))
                ->merge(EnvParser::toArray($environment->getAttribute('variables')))
                ->toArray()
        );

        activity()
            ->causedBy(request()->user())
            ->performedOn($project)
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
            })
            ->withProperties([
                'project' => $project->getAttribute('id'),
                'target' => $target->getAttribute('id'),
                'environment' => $environment->getAttribute('id'),
                'env' => $env,
            ])
            ->log('Environment Variables Retrieved');

        return $env;
    }

    private function decryptIfNecessary(?string $value): ?string
    {
        if (is_null(request()->header('PrivateKey'))) {
            return $value;
        }

        return Crypt::decrypt($value, request()->header('PrivateKey'));
    }
}
