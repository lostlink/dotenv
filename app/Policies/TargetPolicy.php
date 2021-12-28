<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Target;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TargetPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->tokenCan('target:list');
    }

    public function view(User $user, Target $target, Project $project): bool
    {
        return $user->currentTeam->id === $project->team->id && $project->id === $target->project_id;
    }

    public function create(User $user): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'target:create');
    }

    public function update(User $user, Target $target, Project $project): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'target:update');
    }

    public function delete(User $user, Target $target, Project $project): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'target:delete');
    }

    public function restore(User $user, Target $target, Project $project): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'target:restore');
    }

    public function forceDelete(User $user, Target $target, Project $project): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'target:force-delete');
    }
}
