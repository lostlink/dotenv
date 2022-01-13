<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'read') ||
            $user->tokenCan('project:list');
    }

    public function view(User $user, Project $project)
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'project:view') ||
            $user->hasTeamPermission($user->currentTeam, 'read');
    }

    public function create(User $user)
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'project:create') ||
            $user->hasTeamPermission($user->currentTeam, 'create');
    }

    public function update(User $user, Project $project)
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'project:update') ||
            $user->hasTeamPermission($user->currentTeam, 'update');
    }

    public function delete(User $user, Project $project)
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'project:delete') ||
            $user->hasTeamPermission($user->currentTeam, 'delete');
    }

    public function restore(User $user, Project $project)
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'project:restore') ||
            $user->hasTeamPermission($user->currentTeam, 'update');
    }

    public function forceDelete(User $user, Project $project)
    {
        return
            $user->hasTeamPermission($user->currentTeam, 'project:force-delete') ||
            $user->hasTeamPermission($user->currentTeam, 'delete');
    }
}
