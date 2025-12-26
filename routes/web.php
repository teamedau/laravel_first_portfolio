<?php
use App\Http\Controllers\ProjectController;

Route::get('/', [ProjectController::class, 'index']);
Route::get('/admin/projects', [ProjectController::class, 'admin']);
Route::get('/admin/projects/create', [ProjectController::class, 'create']);
Route::post('/admin/projects', [ProjectController::class, 'store']);
Route::get('/', [ProjectController::class, 'index']);
Route::resource('projects', ProjectController::class)->only(['index','show']);


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

