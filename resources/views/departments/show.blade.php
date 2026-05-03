@extends('layouts.app')

@section('content')
<div class="page-panel">
    <div class="panel-header">
        <div>
            <div class="page-title">Department Details</div>
            <p class="page-subtitle">A clean department summary with employee listings and clear request actions for admin management.</p>
        </div>
        <div class="action-pill">
            <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>

    <div class="detail-grid mb-4">
        <div class="detail-card">
            <h4>{{ $department->name }}</h4>
            <dl>
                <dt>Department ID</dt>
                <dd>{{ $department->dept_id }}</dd>

                <dt>Created</dt>
                <dd>{{ $department->created_at->format('F d, Y H:i') }}</dd>
            </dl>
        </div>

        <div class="detail-card">
            <h4>Team overview</h4>
            <dl>
                <dt>Total employees</dt>
                <dd>{{ $department->employees->count() }}</dd>

                <dt>Department status</dt>
                <dd><span class="status-pill info">Active</span></dd>
            </dl>
        </div>
    </div>

    <div class="panel-card table-rounded">
        <div class="p-4 border-bottom">
            <h4 class="mb-0">Employees in this Department</h4>
        </div>
        <div class="table-responsive p-4">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($department->employees as $employee)
                        <tr>
                            <td>{{ $employee->emp_id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>
                                @if($employee->is_admin)
                                    <span class="status-pill admin">Admin</span>
                                @else
                                    <span class="status-pill employee">Employee</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No employees in this department.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection