@extends('layouts.app')

@section('content')
<div class="page-panel">
    <div class="panel-header">
        <div>
            <div class="page-title">Employee Details</div>
            <p class="page-subtitle">A clean employee profile page with contact details and assignment visibility in one elegant view.</p>
        </div>
        <div class="action-pill">
            <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>

    <div class="detail-grid mb-4">
        <div class="detail-card">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4>{{ $employee->name }}</h4>
                    <p class="text-secondary mb-0">Employee ID: {{ $employee->emp_id }}</p>
                </div>
                <div class="card-badge">
                    @if($employee->is_admin)
                        Administrator
                    @else
                        Regular employee
                    @endif
                </div>
            </div>

            <dl>
                <dt>Email</dt>
                <dd>{{ $employee->email }}</dd>

                <dt>Department</dt>
                <dd>{{ $employee->department->name ?? 'N/A' }}</dd>

                <dt>Joined</dt>
                <dd>{{ $employee->created_at->format('F d, Y') }}</dd>

                <dt>Last updated</dt>
                <dd>{{ $employee->updated_at->format('F d, Y H:i') }}</dd>
            </dl>
        </div>

        <div class="detail-card">
            <div class="d-flex align-items-center gap-3 mb-4">
                <span class="stat-icon"><i class="fas fa-user-circle"></i></span>
                <div>
                    <h4 class="mb-1">Profile summary</h4>
                    <p class="text-secondary mb-0">Quick glance at role and membership details.</p>
                </div>
            </div>

            <dl>
                <dt>Projects assigned</dt>
                <dd>{{ $employee->assignments->count() }}</dd>

                <dt>Current role</dt>
                <dd>@if($employee->is_admin) Administrator @else Team member @endif</dd>

                <dt>Status</dt>
                <dd><span class="status-pill {{ $employee->is_admin ? 'admin' : 'employee' }}">{{ $employee->is_admin ? 'Admin' : 'Employee' }}</span></dd>
            </dl>
        </div>
    </div>

    <div class="panel-card table-rounded">
        <div class="p-4 border-bottom">
            <h4 class="mb-0">Project Assignments</h4>
        </div>
        <div class="table-responsive p-4">
            @if($employee->assignments->count() > 0)
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Role</th>
                            <th>Hours/Week</th>
                            <th>Assigned</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee->assignments as $assignment)
                            <tr>
                                <td>{{ $assignment->project->title ?? 'N/A' }}</td>
                                <td><span class="status-pill info">{{ $assignment->role }}</span></td>
                                <td>{{ $assignment->hours }} hrs</td>
                                <td>{{ $assignment->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('assignments.show', $assignment->assign_id) }}" class="btn btn-sm btn-outline-info rounded-pill">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-5 text-secondary">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <p class="mb-0">No project assignments yet.</p>
                </div>
            @endif
        </div>
    </div>

    @if(auth()->user()->is_admin || auth()->id() == $employee->emp_id)
        <div class="mt-4 d-flex flex-wrap gap-2">
            <a href="{{ route('employees.edit', $employee->emp_id) }}" class="btn btn-warning btn-sm rounded-pill">
                <i class="fas fa-edit me-1"></i> Edit Profile
            </a>
            @if(auth()->user()->is_admin && auth()->id() != $employee->emp_id)
                <form action="{{ route('employees.destroy', $employee->emp_id) }}" method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm rounded-pill delete-button" data-confirm-message="Are you sure you want to delete {{ $employee->name }}?">
                        <i class="fas fa-trash me-1"></i> Delete Employee
                    </button>
                </form>
            @endif
        </div>
    @endif
</div>
@endsection`