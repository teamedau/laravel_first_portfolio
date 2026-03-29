<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'tagline'      => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'tech'         => 'nullable|string|max:255',
            'link'         => 'nullable|url|max:255',
            'status'       => 'required|in:concept,mvp,live',
            'progress'     => 'required|integer|min:0|max:100',
            'category'     => 'nullable|string|max:100',
            'launch_date'  => 'nullable|date',
            'featured'     => 'boolean',
            'image'        => 'nullable|image|max:2048',
        ]);

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

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'tagline'      => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'tech'         => 'nullable|string|max:255',
            'link'         => 'nullable|url|max:255',
            'status'       => 'required|in:concept,mvp,live',
            'progress'     => 'required|integer|min:0|max:100',
            'category'     => 'nullable|string|max:100',
            'launch_date'  => 'nullable|date',
            'featured'     => 'boolean',
            'image'        => 'nullable|image|max:2048',
        ]);

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
