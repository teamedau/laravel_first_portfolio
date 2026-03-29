<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ProjectUpdateMail;
use App\Models\Project;
use App\Models\ProjectUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProjectUpdateController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'type'    => 'required|in:update,milestone,launch',
        ]);

        $update = $project->updates()->create($request->only('title', 'content', 'type'));

        // Email all followers (role=follower) about the new update
        $followerIds = $project->followers()
            ->where('role', 'follower')
            ->pluck('user_id');

        $followers = User::whereIn('id', $followerIds)->get();

        foreach ($followers as $recipient) {
            Mail::to($recipient->email)->queue(new ProjectUpdateMail($project, $update, $recipient));
        }

        return back()->with('success', 'Update published and followers notified.');
    }
}
