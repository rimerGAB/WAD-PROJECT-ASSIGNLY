<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Project::class, 'project');
    }
    /**
     * Display a listing of projects.
     */
    public function index()
    {
        // Everyone can view projects, with eager loading
        $projects = Project::withCount('employees')->get();
        return view('projects.index', compact('projects'));
    }
    
    /**
     * Show form to create new project.
     */
    public function create()
    {
        return view('projects.create');
    }
    
    /**
     * Store new project.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'budget' => 'required|numeric|min:0'
        ]);
        
        Project::create($request->all());
        
        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }
    
    /**
     * Display specific project.
     */
    public function show(Project $project)
    {
        // Eager loading to avoid N+1 query
        $project->load('employees', 'assignments.employee');
        return view('projects.show', compact('project'));
    }
    
    /**
     * Show form to edit project.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }
    
    /**
     * Update project.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'budget' => 'required|numeric|min:0'
        ]);
        
        $project->update($request->all());
        
        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }
    
    /**
     * Delete project.
     */
    public function destroy(Project $project)
    {
        // Check if project has assignments
        $assignmentCount = $project->assignments()->count();
        if ($assignmentCount > 0) {
            return redirect()->route('projects.index')
                ->with('error', "Cannot delete project with {$assignmentCount} active assignment(s). Please delete all assignments first.");
        }
        
        $project->delete();
        
        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}