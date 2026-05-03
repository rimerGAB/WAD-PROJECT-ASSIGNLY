@extends('layouts.app')

@section('content')
<div class="page-panel">
    <div class="panel-header">
        <div>
            <div class="page-title">Add New Department</div>
            <p class="page-subtitle">Create a new department with a clean form layout designed for fast admin entry.</p>
        </div>
        <div class="action-pill">
            <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Back to Departments
            </a>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-body">
            <form method="POST" action="{{ route('departments.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label">Department Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill">Create Department</button>
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary rounded-pill">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection