<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_projects' => Project::count(),
            'by_status' => Project::selectRaw('status, count(*) as count')->groupBy('status')->pluck('count', 'status'),
            'total_users' => User::count(),
            'total_followers' => 0,
            'total_votes' => 0,
        ];

        $projects = Project::latest()->get();

        return view('admin.dashboard', compact('stats', 'projects'));
    }
}
