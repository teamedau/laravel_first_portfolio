<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectFollower;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'role' => 'required|in:follower,tester,early_adopter',
        ]);

        ProjectFollower::updateOrCreate(
            ['user_id' => auth()->id(), 'project_id' => $project->id],
            ['role' => $request->role]
        );

        return back()->with('success', 'You\'ve joined the project!');
    }

    public function destroy(Project $project)
    {
        ProjectFollower::where('user_id', auth()->id())
            ->where('project_id', $project->id)
            ->delete();

        return back()->with('success', 'You\'ve unfollowed this project.');
    }

    public function vote(Project $project)
    {
        // Evitar doble voto con tabla project_votes (se crea en siguiente fase)
        $alreadyVoted = \DB::table('project_votes')
            ->where('user_id', auth()->id())
            ->where('project_id', $project->id)
            ->exists();

        if ($alreadyVoted) {
            // Quitar voto (toggle)
            \DB::table('project_votes')
                ->where('user_id', auth()->id())
                ->where('project_id', $project->id)
                ->delete();
            $project->decrement('votes');
            return back()->with('info', 'Vote removed.');
        }

        \DB::table('project_votes')->insert([
            'user_id'    => auth()->id(),
            'project_id' => $project->id,
            'created_at' => now(),
        ]);
        $project->increment('votes');

        return back()->with('success', 'Vote recorded!');
    }
}
