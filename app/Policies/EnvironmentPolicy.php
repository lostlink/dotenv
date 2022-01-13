<?php

namespace App\Policies;

use App\Models\Environment;
use App\Models\Project;
use App\Models\Target;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnvironmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'read') ||
            $user->tokenCan('environment:list');
    }

    public function view(User $user, Environment $environment, Target $target, Project $project): bool
    {
        return
            (
                $user->hasTeamPermission($user->currentTeam, 'environment:view') ||
                $user->hasTeamPermission($user->currentTeam, 'read')
            ) &&
            $project->id === $target->project_id &&
            $target->id === $environment->target_id;
    }

    public function create(User $user)
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'environment:create') ||
            $user->hasTeamPermission($user->currentTeam, 'create');
    }

    public function update(User $user, Environment $environment)
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'environment:update') ||
            $user->hasTeamPermission($user->currentTeam, 'update');
    }

    public function delete(User $user, Environment $environment)
    {
        return
            (
                $user->hasTeamPermission($user->currentTeam, 'environment:delete') ||
                $user->hasTeamPermission($user->currentTeam, 'delete')
            ) &&
            $user->currentTeam->getAttribute('id') === $environment->target->project->team->id;
    }

    public function restore(User $user, Environment $environment)
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'environment:restore') ||
            $user->hasTeamPermission($user->currentTeam, 'update');
    }

    public function forceDelete(User $user, Environment $environment)
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'environment:force-delete') ||
            $user->hasTeamPermission($user->currentTeam, 'delete');
    }
}
