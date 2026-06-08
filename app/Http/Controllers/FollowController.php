<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectFollower;
use App\Models\User;
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

    public function unsubscribe(Project $project, User $user)
    {
        ProjectFollower::where('user_id', $user->id)
            ->where('project_id', $project->id)
            ->delete();

        return redirect()->route('home')
            ->with('success', 'You have been unsubscribed from ' . $project->title . '.');
    }

    public function vote(Request $request, Project $project)
    {
        if (auth()->check()) {
            // Authenticated user: track in DB
            $alreadyVoted = DB::table('project_votes')
                ->where('user_id', auth()->id())
                ->where('project_id', $project->id)
                ->exists();

            if ($alreadyVoted) {
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
        } else {
            // Guest: track in session
            $voted = $request->session()->get('voted_projects', []);

            if (in_array($project->id, $voted)) {
                $voted = array_values(array_filter($voted, fn($id) => $id !== $project->id));
                $request->session()->put('voted_projects', $voted);
                $project->decrement('votes');
                return back()->with('info', 'Vote removed.');
            }

            $voted[] = $project->id;
            $request->session()->put('voted_projects', $voted);
        }

        $project->increment('votes');
        return back()->with('success', 'Vote recorded!');
    }
}
