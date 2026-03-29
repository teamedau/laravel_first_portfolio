<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request\ProjectStoreRequest;
use Illuminate\Http\Request\ProjectUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(20);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(ProjectStoreRequest $request, Project $project)
    {
        $data = $request->validate();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $data['featured'] = $request->boolean('featured');

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project created.');
    }

    public function edit(Project $project)
    {
        $testers = $project->followers()
            ->where('role', 'tester')
            ->with('user')
            ->get();

        return view('admin.projects.edit', compact('project', 'testers'));
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $data = $request->validate();

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $data['featured'] = $request->boolean('featured');

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }

    public function show(Project $project)
    {
        return redirect()->route('admin.projects.edit', $project);
    }
}
