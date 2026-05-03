@extends('layouts.app')

@section('content')
@php
    $totalProjects = $projects->count();
    $totalBudget = $projects->sum('budget');
    $assignedEmployees = $projects->sum('employees_count');
@endphp

<div class="page-panel">
    <div class="panel-header">
        <div>
            <div class="page-title">Projects</div>
            <p class="page-subtitle">A modern project workspace built for quick oversight of budgets, assignments, and active initiatives.</p>
        </div>
        <div class="action-pill">
            @if(auth()->user()->is_admin)
                <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm rounded-pill">
                    <i class="fas fa-plus me-1"></i> Add Project
                </a>
            @endif
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-icon"><i class="fas fa-project-diagram"></i></span>
            </div>
            <div class="stat-number">{{ $totalProjects }}</div>
            <div class="stat-label">Active projects</div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-icon"><i class="fas fa-dollar-sign"></i></span>
            </div>
            <div class="stat-number">${{ number_format($totalBudget, 2) }}</div>
            <div class="stat-label">Total budget</div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-icon"><i class="fas fa-users"></i></span>
            </div>
            <div class="stat-number">{{ $assignedEmployees }}</div>
            <div class="stat-label">Employees assigned</div>
        </div>
    </div>

    <div class="panel-card table-rounded">
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project</th>
                        <th>Budget</th>
                        <th>Employees</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>{{ $project->proj_id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-purple"><i class="fas fa-project-diagram"></i></span>
                                    <span>{{ $project->title }}</span>
                                </div>
                            </td>
                            <td>${{ number_format($project->budget, 2) }}</td>
                            <td>{{ $project->employees_count }}</td>
                            <td>
                                <a href="{{ route('projects.show', $project->proj_id) }}" class="btn btn-sm btn-outline-info rounded-pill me-1 mb-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('projects.edit', $project->proj_id) }}" class="btn btn-sm btn-outline-warning rounded-pill me-1 mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('projects.destroy', $project->proj_id) }}" method="POST" class="d-inline mb-1 delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill delete-button" data-confirm-message="Are you sure you want to delete project {{ $project->title }}?">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No projects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection