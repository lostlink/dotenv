<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Team;
use App\Policies\ProjectPolicy;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Team::class => TeamPolicy::class,
        Project::class => ProjectPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
