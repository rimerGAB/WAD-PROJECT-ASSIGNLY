@extends('layouts.app')

@section('content')
<div class="page-panel">
    <div class="panel-header">
        <div>
            <div class="page-title">Assignment Details</div>
            <p class="page-subtitle">A modern assignment detail screen for fast review of employee, project, and hours information.</p>
        </div>
        <div class="action-pill">
            <a href="{{ route('assignments.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>

    <div class="detail-grid mb-4">
        <div class="detail-card">
            <h4>Employee</h4>
            <dl>
                <dt>Name</dt>
                <dd>{{ $assignment->employee->name }}</dd>

                <dt>Department</dt>
                <dd>{{ $assignment->employee->department->name ?? 'No Department' }}</dd>
            </dl>
        </div>

        <div class="detail-card">
            <h4>Project</h4>
            <dl>
                <dt>Title</dt>
                <dd>{{ $assignment->project->title }}</dd>

                <dt>Budget</dt>
                <dd>${{ number_format($assignment->project->budget, 2) }}</dd>
            </dl>
        </div>
    </div>

    <div class="detail-card mb-4">
        <h4>Assignment overview</h4>
        <dl>
            <dt>ID</dt>
            <dd>{{ $assignment->assign_id }}</dd>

            <dt>Role</dt>
            <dd><span class="status-pill info">{{ $assignment->role }}</span></dd>

            <dt>Hours per week</dt>
            <dd>{{ $assignment->hours }} hours</dd>

            <dt>Created</dt>
            <dd>{{ $assignment->created_at->format('F d, Y H:i') }}</dd>

            <dt>Last updated</dt>
            <dd>{{ $assignment->updated_at->format('F d, Y H:i') }}</dd>
        </dl>
    </div>

    @if(auth()->user()->is_admin)
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('assignments.edit', $assignment->assign_id) }}" class="btn btn-warning btn-sm rounded-pill">
                <i class="fas fa-edit me-1"></i> Edit Assignment
            </a>
        </div>
    @endif
</div>
@endsection