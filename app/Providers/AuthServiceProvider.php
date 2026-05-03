<?php

namespace App\Providers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Assignment;
use App\Models\Department;
use App\Policies\EmployeePolicy;
use App\Policies\ProjectPolicy;
use App\Policies\AssignmentPolicy;
use App\Policies\DepartmentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Employee::class => EmployeePolicy::class,
        Project::class => ProjectPolicy::class,
        Assignment::class => AssignmentPolicy::class,
        Department::class => DepartmentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin-only', fn (Employee $user) => $user->is_admin);
    }
}
