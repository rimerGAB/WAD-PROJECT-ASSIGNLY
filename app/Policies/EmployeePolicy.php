<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function viewAny(Employee $user): bool
    {
        return true;
    }

    public function view(Employee $user, Employee $employee): bool
    {
        return $user->is_admin || $user->emp_id === $employee->emp_id;
    }

    public function create(Employee $user): bool
    {
        return $user->is_admin;
    }

    public function update(Employee $user, Employee $employee): bool
    {
        return $user->is_admin || $user->emp_id === $employee->emp_id;
    }

    public function delete(Employee $user, Employee $employee): bool
    {
        return $user->is_admin && $user->emp_id !== $employee->emp_id;
    }
}
