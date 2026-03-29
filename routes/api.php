<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/projects', [ProjectController::class, 'index'])->name('api.projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('api.projects.show');

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/projects', [ProjectController::class, 'store'])->name('api.projects.store');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('api.projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('api.projects.destroy');
});
