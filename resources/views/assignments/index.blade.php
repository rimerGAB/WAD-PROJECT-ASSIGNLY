@extends('layouts.app')

@section('content')
@php
    $totalAssignments = $assignments->count();
    $averageHours = $assignments->count() ? number_format($assignments->avg('hours'), 1) : '0.0';
    $uniqueRoles = $assignments->pluck('role')->unique()->count();
@endphp

<div class="page-panel">
    <div class="panel-header">
        <div>
            <div class="page-title">Assignments</div>
            <p class="page-subtitle">A sleek assignment dashboard with faster decisions and clearer project role visibility.</p>
        </div>
        <div class="action-pill">
            @if(auth()->user()->is_admin)
                <a href="{{ route('assignments.create') }}" class="btn btn-primary btn-sm rounded-pill">
                    <i class="fas fa-plus me-1"></i> New Assignment
                </a>
            @endif
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-icon"><i class="fas fa-tasks"></i></span>
            </div>
            <div class="stat-number">{{ $totalAssignments }}</div>
            <div class="stat-label">Active assignments</div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-icon"><i class="fas fa-clock"></i></span>
            </div>
            <div class="stat-number">{{ $averageHours }}</div>
            <div class="stat-label">Avg. hours/week</div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-icon"><i class="fas fa-user-tag"></i></span>
            </div>
            <div class="stat-number">{{ $uniqueRoles }}</div>
            <div class="stat-label">Role types</div>
        </div>
    </div>

    <div class="panel-card table-rounded">
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee</th>
                        <th>Project</th>
                        <th>Role</th>
                        <th>Hours</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->assign_id }}</td>
                            <td>{{ $assignment->employee->name }}</td>
                            <td>{{ $assignment->project->title }}</td>
                            <td><span class="status-pill info">{{ $assignment->role }}</span></td>
                            <td>{{ $assignment->hours }} hrs</td>
                            <td>
                                <a href="{{ route('assignments.show', $assignment->assign_id) }}" class="btn btn-sm btn-outline-info rounded-pill me-1 mb-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('assignments.edit', $assignment->assign_id) }}" class="btn btn-sm btn-outline-warning rounded-pill me-1 mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('assignments.destroy', $assignment->assign_id) }}" method="POST" class="d-inline mb-1 delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill delete-button" data-confirm-message="Are you sure you want to delete this assignment?">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No assignments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection