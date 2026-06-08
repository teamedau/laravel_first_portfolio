<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProjectUpdateController;

// Dashboard (Breeze requires this route for post-login redirects)
Route::get('/dashboard', function () {
    return auth()->user()->is_admin
        ? redirect()->route('admin.dashboard')
        : redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/about', function () { return view('about'); })->name('about');

// Vote is public (session-based for guests)
Route::post('/projects/{project}/vote', [FollowController::class, 'vote'])->name('projects.vote')->middleware('throttle:10,1');

// Email unsubscribe — signed URL, no login required
Route::get('/projects/{project}/unsubscribe/{user}', [FollowController::class, 'unsubscribe'])->name('projects.unsubscribe')->middleware('signed');

// Routes that require login
Route::middleware(['auth'])->group(function () {
    Route::post('/projects/{project}/follow', [FollowController::class, 'store'])->name('projects.follow');
    Route::delete('/projects/{project}/follow', [FollowController::class, 'destroy'])->name('projects.unfollow');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin panel (admin only)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('projects', AdminProjectController::class);
    Route::post('/projects/{project}/updates', [ProjectUpdateController::class, 'store'])->name('projects.updates.store');
});

require __DIR__.'/auth.php';
