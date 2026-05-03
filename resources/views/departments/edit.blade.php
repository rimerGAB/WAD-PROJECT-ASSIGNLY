@extends('layouts.app')

@section('content')
<div class="page-panel">
    <div class="panel-header">
        <div>
            <div class="page-title">Edit Department</div>
            <p class="page-subtitle">Update department details with a consistent admin form and simplified actions.</p>
        </div>
        <div class="action-pill">
            <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Back to Departments
            </a>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-body">
            <form method="POST" action="{{ route('departments.update', $department->dept_id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="form-label">Department Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $department->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill">Update Department</button>
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary rounded-pill">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection