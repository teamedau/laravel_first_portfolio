<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Project::withCount('collaborators')->where('featured', true)->latest()->take(4)->get();
        $topVoted = Project::withCount('collaborators')->where('votes', '>', 0)->orderByDesc('votes')->take(4)->get();
        $newest   = Project::withCount('collaborators')->latest()->take(4)->get();

        // If no featured projects exist, fall back to top voted
        if ($featured->isEmpty()) {
            $featured = $topVoted;
        }

        // Unified collection for the portfolio grid: featured first, then newest, deduped, up to 8
        $allProjects = Project::withCount('collaborators')
            ->orderByDesc('featured')
            ->orderByDesc('votes')
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('featured', 'topVoted', 'newest', 'allProjects'));
    }
}
