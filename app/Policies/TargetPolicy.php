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
        return
            $user->hasTeamPermission($user->currentTeam, 'read') ||
            $user->tokenCan('target:list');
    }

    public function view(User $user, Target $target, Project $project): bool
    {
        return
            (
                $user->hasTeamPermission($user->currentTeam, 'target:view') ||
                $user->hasTeamPermission($user->currentTeam, 'read')
            ) &&
            $project->id === $target->project_id;
    }

    public function create(User $user): bool
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'target:create') ||
            $user->hasTeamPermission($user->currentTeam, 'create');
    }

    public function update(User $user, Target $target): bool
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'target:update') ||
            $user->hasTeamPermission($user->currentTeam, 'update');
    }

    public function delete(User $user, Target $target): bool
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'target:delete') ||
            $user->hasTeamPermission($user->currentTeam, 'delete');
    }

    public function restore(User $user, Target $target): bool
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'target:restore') ||
            $user->hasTeamPermission($user->currentTeam, 'update');
    }

    public function forceDelete(User $user, Target $target): bool
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'target:force-delete') ||
            $user->hasTeamPermission($user->currentTeam, 'delete');
    }
}
