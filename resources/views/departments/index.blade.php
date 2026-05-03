@extends('layouts.app')

@section('content')
@php
    $departmentCount = $departments->count();
    $employeeCount = $departments->sum('employees_count');
@endphp

<div class="page-panel">
    <div class="panel-header">
        <div>
            <div class="page-title">Departments</div>
            <p class="page-subtitle">A structured admin view for managing departments and team distribution with clean row flow and polished controls.</p>
        </div>
        <div class="action-pill">
            @if(auth()->user()->is_admin)
                <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm rounded-pill">
                    <i class="fas fa-plus me-1"></i> Add Department
                </a>
            @endif
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-icon"><i class="fas fa-building"></i></span>
            </div>
            <div class="stat-number">{{ $departmentCount }}</div>
            <div class="stat-label">Departments</div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-icon"><i class="fas fa-users"></i></span>
            </div>
            <div class="stat-number">{{ $employeeCount }}</div>
            <div class="stat-label">Total employees</div>
        </div>
    </div>

    <div class="panel-card table-rounded">
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Employees</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departments as $department)
                        <tr>
                            <td>{{ $department->dept_id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-primary"><i class="fas fa-building"></i></span>
                                    <span>{{ $department->name }}</span>
                                </div>
                            </td>
                            <td>{{ $department->employees_count }}</td>
                            <td>
                                <a href="{{ route('departments.show', $department->dept_id) }}" class="btn btn-sm btn-outline-info rounded-pill me-1 mb-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('departments.edit', $department->dept_id) }}" class="btn btn-sm btn-outline-warning rounded-pill me-1 mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('departments.destroy', $department->dept_id) }}" method="POST" class="d-inline mb-1 delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill delete-button" data-confirm-message="Are you sure you want to delete department {{ $department->name }}?">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No departments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection