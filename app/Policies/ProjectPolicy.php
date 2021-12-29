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
        return $user->tokenCan('project:list');
    }

    public function view(User $user, Project $project)
    {
        return $user->hasTeamPermission($user->currentTeam, 'project:view');
    }

    public function create(User $user)
    {
        return $user->hasTeamPermission($user->currentTeam, 'project:create');
    }

    public function update(User $user, Project $project)
    {
        return $user->hasTeamPermission($user->currentTeam, 'project:update');
    }

    public function delete(User $user, Project $project)
    {
        return $user->hasTeamPermission($user->currentTeam, 'project:delete');
    }

    public function restore(User $user, Project $project)
    {
        return $user->hasTeamPermission($user->currentTeam, 'project:restore');
    }

    public function forceDelete(User $user, Project $project)
    {
        return $user->hasTeamPermission($user->currentTeam, 'project:force-delete');
    }
}
