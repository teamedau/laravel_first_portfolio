<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Project::where('featured', true)->latest()->take(4)->get();
        $topVoted = Project::where('votes', '>', 0)->orderByDesc('votes')->take(4)->get();
        $newest   = Project::latest()->take(4)->get();

        // If no featured projects exist, fall back to top voted
        if ($featured->isEmpty()) {
            $featured = $topVoted;
        }

        return view('home', compact('featured', 'topVoted', 'newest'));
    }
}
