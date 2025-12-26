<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        // Traemos todos los proyectos
        $projects = Project::all()->map(function($p){
            // Convertimos tech de string a array si existe
            $p->tech = $p->tech ? explode(',', $p->tech) : [];
            return $p;
        });

        // Enviamos los proyectos a la vista
        return view('home', compact('projects'));
    }
}
