<?php

namespace App\Policies;

use App\Models\Assignment;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $user): bool
    {
        return true;
    }

    public function view(Employee $user, Assignment $assignment): bool
    {
        return $user->is_admin || $assignment->emp_id === $user->emp_id;
    }

    public function create(Employee $user): bool
    {
        return $user->is_admin;
    }

    public function update(Employee $user, Assignment $assignment): bool
    {
        return $user->is_admin;
    }

    public function delete(Employee $user, Assignment $assignment): bool
    {
        return $user->is_admin;
    }
}
