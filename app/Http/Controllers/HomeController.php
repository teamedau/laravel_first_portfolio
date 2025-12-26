<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::all(); // o paginate(6) si quieres paginación
        return view('home', compact('projects'));
    }
}
