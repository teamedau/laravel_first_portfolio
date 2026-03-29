<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectFollower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'role' => 'required|in:follower,tester',
        ]);

        ProjectFollower::updateOrCreate(
            ['user_id' => auth()->id(), 'project_id' => $project->id],
            ['role' => $request->role]
        );

        if ($request->role === 'tester' && $project->link) {
            return redirect($project->link);
        }

        return back()->with('success', 'You\'re now following this project and will receive updates by email.');
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
        $alreadyVoted = DB::table('project_votes')
            ->where('user_id', auth()->id())
            ->where('project_id', $project->id)
            ->exists();

        if ($alreadyVoted) {
            // Quitar voto (toggle)
            DB::table('project_votes')
                ->where('user_id', auth()->id())
                ->where('project_id', $project->id)
                ->delete();
            $project->decrement('votes');
            return back()->with('info', 'Vote removed.');
        }

        DB::table('project_votes')->insert([
            'user_id'    => auth()->id(),
            'project_id' => $project->id,
            'created_at' => now(),
        ]);
        $project->increment('votes');

        return back()->with('success', 'Vote recorded!');
    }
}
