<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $user): bool
    {
        return $user->is_admin;
    }

    public function view(Employee $user, Department $department): bool
    {
        return $user->is_admin;
    }

    public function create(Employee $user): bool
    {
        return $user->is_admin;
    }

    public function update(Employee $user, Department $department): bool
    {
        return $user->is_admin;
    }

    public function delete(Employee $user, Department $department): bool
    {
        return $user->is_admin;
    }
}
