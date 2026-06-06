<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::withCount('collaborators')->latest()->paginate(20);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(ProjectStoreRequest $request, Project $project)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $data['featured'] = $request->boolean('featured');

        $project = Project::create($data);

        $names = $request->input('collaborator_names', []);
        $roles = $request->input('collaborator_roles', []);
        $urls  = $request->input('collaborator_urls', []);
        $request->validate([
            'collaborator_urls.*' => 'nullable|url',
        ]);
        foreach ($names as $i => $name) {
            if (!empty($name) && !empty($roles[$i])) {
                $project->collaborators()->create([
                    'name' => $name,
                    'role' => $roles[$i],
                    'url'  => $urls[$i] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created.');
    }

    public function edit(Project $project)
    {
        $project->load('collaborators');

        $testers = $project->followers()
            ->where('role', 'tester')
            ->with('user')
            ->get();

        return view('admin.projects.edit', compact('project', 'testers'));
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $data['featured'] = $request->boolean('featured');

        $project->update($data);

        $project->collaborators()->delete();
        $names = $request->input('collaborator_names', []);
        $roles = $request->input('collaborator_roles', []);
        $urls  = $request->input('collaborator_urls', []);
        $request->validate([
            'collaborator_urls.*' => 'nullable|url',
        ]);
        foreach ($names as $i => $name) {
            if (!empty($name) && !empty($roles[$i])) {
                $project->collaborators()->create([
                    'name' => $name,
                    'role' => $roles[$i],
                    'url'  => $urls[$i] ?? null,
                ]);
            }
        }

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
