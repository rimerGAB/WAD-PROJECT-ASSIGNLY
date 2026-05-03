<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $user): bool
    {
        return true;
    }

    public function view(Employee $user, Project $project): bool
    {
        return true;
    }

    public function create(Employee $user): bool
    {
        return $user->is_admin;
    }

    public function update(Employee $user, Project $project): bool
    {
        return $user->is_admin;
    }

    public function delete(Employee $user, Project $project): bool
    {
        return $user->is_admin;
    }
}
