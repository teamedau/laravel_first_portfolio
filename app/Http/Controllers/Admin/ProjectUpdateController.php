<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectUpdate;
use Illuminate\Http\Request;

class ProjectUpdateController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'type'    => 'required|in:update,milestone,launch',
        ]);

        $project->updates()->create($request->only('title', 'content', 'type'));

        return back()->with('success', 'Update publicado.');
    }
}
