@extends('layouts.app')

@section('content')
<div class="page-panel">
    <div class="panel-header">
        <div>
            <div class="page-title">Project Details</div>
            <p class="page-subtitle">A polished project page with financial clarity and team assignment context in one place.</p>
        </div>
        <div class="action-pill">
            <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>

    <div class="detail-grid mb-4">
        <div class="detail-card">
            <h4>{{ $project->title }}</h4>
            <dl>
                <dt>Project ID</dt>
                <dd>{{ $project->proj_id }}</dd>

                <dt>Budget</dt>
                <dd>${{ number_format($project->budget, 2) }}</dd>

                <dt>Created</dt>
                <dd>{{ $project->created_at->format('F d, Y H:i') }}</dd>
            </dl>
        </div>

        <div class="detail-card">
            <h4>Team summary</h4>
            <dl>
                <dt>Assigned employees</dt>
                <dd>{{ $project->assignments->count() }}</dd>

                <dt>Average hours</dt>
                <dd>{{ $project->assignments->count() ? number_format($project->assignments->avg('hours'), 1) : '0.0' }} hrs/week</dd>

                <dt>Status</dt>
                <dd><span class="status-pill info">Active</span></dd>
            </dl>
        </div>
    </div>

    <div class="panel-card table-rounded">
        <div class="p-4 border-bottom">
            <h4 class="mb-0">Assigned Employees</h4>
        </div>
        <div class="table-responsive p-4">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Hours</th>
                        <th>Assigned</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($project->assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->employee->name ?? 'N/A' }}</td>
                            <td>{{ $assignment->employee->department->name ?? 'N/A' }}</td>
                            <td><span class="status-pill info">{{ $assignment->role }}</span></td>
                            <td>{{ $assignment->hours }} hrs</td>
                            <td>{{ $assignment->created_at->format('F d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No employees assigned to this project yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if(auth()->user()->is_admin)
        <div class="mt-4">
            <a href="{{ route('projects.edit', $project->proj_id) }}" class="btn btn-warning btn-sm rounded-pill">
                <i class="fas fa-edit me-1"></i> Edit Project
            </a>
        </div>
    @endif
</div>
@endsection