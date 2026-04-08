<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'votes'    => $query->orderByDesc('votes'),
            'progress' => $query->orderByDesc('progress'),
            default    => $query->latest(),
        };

        $projects   = $query->withCount('collaborators')->paginate(12)->withQueryString();
        $categories = Project::whereNotNull('category')->distinct()->pluck('category');

        return view('projects.index', compact('projects', 'categories'));
    }

    public function show(Request $request, Project $project)
    {
        $project->load(['updates', 'followers', 'collaborators']);
        $userFollow = auth()->check()
            ? $project->followRoleFor(auth()->user())
            : null;

        if (auth()->check()) {
            $userVoted = $project->hasVotedBy(auth()->user());
        } else {
            $userVoted = in_array($project->id, $request->session()->get('voted_projects', []));
        }

        return view('projects.show', compact('project', 'userFollow', 'userVoted'));
    }
}
