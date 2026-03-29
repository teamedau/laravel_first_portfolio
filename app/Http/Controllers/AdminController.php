<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $byStatus = Project::selectRaw('status, count(*) as count')->groupBy('status')->pluck('count', 'status');

        $stats = [
            'total_projects'  => Project::count(),
            'by_status'       => $byStatus,
            'total_users'     => User::count(),
            'total_followers' => DB::table('project_followers')->where('role', 'follower')->count(),
            'total_testers'   => DB::table('project_followers')->where('role', 'tester')->count(),
            'total_votes'     => Project::sum('votes'),
        ];

        $projects = Project::latest()->get();

        $chartStatus = [
            'labels' => ['Concept', 'MVP', 'Live'],
            'data'   => [$byStatus['concept'] ?? 0, $byStatus['mvp'] ?? 0, $byStatus['live'] ?? 0],
        ];

        $topVotedProjects = Project::where('votes', '>', 0)->orderByDesc('votes')->take(6)->get();
        $chartVotes = [
            'labels' => $topVotedProjects->pluck('title')->toArray(),
            'data'   => $topVotedProjects->pluck('votes')->toArray(),
        ];

        $chartEngagement = [
            'labels' => ['Followers', 'Testers'],
            'data'   => [$stats['total_followers'], $stats['total_testers']],
        ];

        return view('admin.dashboard', compact('stats', 'projects', 'chartStatus', 'chartVotes', 'chartEngagement'));
    }
}
