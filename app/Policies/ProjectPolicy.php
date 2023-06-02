<?php

namespace App\Policies;

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any projects.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the project.
     */
    public function view(User $user, Project $project): Response
    {
        return optional($user)->id === $project->user_id
            ? Response::allow()
            : Response::deny('You do not own this Project.');
    }

    /**
     * Determine whether the user can create projects.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the project.
     */
    public function update(User $user, Project $project): Response
    {
        return optional($user)->id === $project->user_id
            ? Response::allow()
            : Response::deny('You do not own this Project.');
    }

    /**
     * Determine whether the user can delete the project.
     */
    public function delete(User $user, Project $project): Response
    {
        return optional($user)->id === $project->user_id
            ? Response::allow()
            : Response::deny('You do not own this Project.');
    }

    /**
     * Determine whether the user can restore the project.
     */
    public function restore(User $user, Project $project): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the project.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        return false;
    }
}
