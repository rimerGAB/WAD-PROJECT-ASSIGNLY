@extends('layouts.app')

@section('content')
@php
    $totalEmployees = $employees->count();
    $totalAdmins = $employees->where('is_admin', 1)->count();
    $departmentCount = $employees->pluck('department.name')->filter()->unique()->count();
@endphp

<div class="page-panel">
    <div class="panel-header">
        <div>
            <div class="page-title">Employees</div>
            <p class="page-subtitle">A modern roster view with polished row styling so your team list looks clean, clear, and easy to scan.</p>
        </div>
        <div class="action-pill">
            @if(auth()->user()->is_admin)
                <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm rounded-pill">
                    <i class="fas fa-plus me-1"></i> Add Employee
                </a>
            @endif
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-icon"><i class="fas fa-users"></i></span>
            </div>
            <div class="stat-number">{{ $totalEmployees }}</div>
            <div class="stat-label">Total employees</div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-icon"><i class="fas fa-user-shield"></i></span>
            </div>
            <div class="stat-number">{{ $totalAdmins }}</div>
            <div class="stat-label">Admin accounts</div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-icon"><i class="fas fa-building"></i></span>
            </div>
            <div class="stat-number">{{ $departmentCount }}</div>
            <div class="stat-label">Departments represented</div>
        </div>
    </div>

    <div class="panel-card table-rounded">
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>{{ $employee->emp_id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-primary"><i class="fas fa-user-circle"></i></span>
                                    <span>{{ $employee->name }}</span>
                                </div>
                            </td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->department->name ?? 'N/A' }}</td>
                            <td>
                                @if($employee->is_admin)
                                    <span class="status-pill admin">Admin</span>
                                @else
                                    <span class="status-pill employee">Employee</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('employees.show', $employee->emp_id) }}" class="btn btn-sm btn-outline-info rounded-pill me-1 mb-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(auth()->user()->is_admin || auth()->id() == $employee->emp_id)
                                    <a href="{{ route('employees.edit', $employee->emp_id) }}" class="btn btn-sm btn-outline-warning rounded-pill me-1 mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if(auth()->user()->is_admin && auth()->id() != $employee->emp_id)
                                    <form action="{{ route('employees.destroy', $employee->emp_id) }}" method="POST" class="d-inline mb-1 delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill delete-button" data-confirm-message="Are you sure you want to delete {{ $employee->name }}?">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection