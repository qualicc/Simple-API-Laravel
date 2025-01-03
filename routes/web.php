<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamMemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/factory', [FactoryController::class, 'factory']);

Route::middleware(['api.access'])->group(function () {
    // Projects
    // Create
    Route::post('/projects', [ProjectController::class, 'store']) -> name('projects.store') -> middleware('project.store');
    // Get All
    Route::get('/projects', [ProjectController::class, 'index']) -> name('projects.index');
    // Get details
    Route::get('/projects/{id}', [ProjectController::class, 'show']) -> name('projects.show');
    // Update
    Route::put('/projects/{id}', [ProjectController::class, 'update']) -> name('projects.update') -> middleware('project.update');
    // Delete
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']) -> name('projects.destroy');


    // Tasks
    // Create
    Route::post('/projects/{project}/tasks', [TaskController::class, 'store']) -> name('task.store') -> middleware('task.store');
    // Get All
    Route::get('/projects/{project}/tasks', [TaskController::class, 'index']) -> name('task.index');
    // Get details
    Route::get('/projects/{project}/tasks/{task}', [TaskController::class, 'show']) -> name('task.show');
    // Update
    Route::put('/projects/{project}/tasks/{task}', [TaskController::class, 'update']) -> name('task.update') -> middleware('task.update');
    // Delete
    Route::delete('/projects/{project}/tasks/{task}', [TaskController::class, 'destroy']) -> name('task.destroy');


    // Team
    // Create
    Route::post('/projects/{project}/team', [TeamMemberController::class, 'store']) -> name('team.store') -> middleware('team.store');
    // Get All
    Route::get('/projects/{project}/team', [TeamMemberController::class, 'index']) -> name('team.index');
    // Delete
    Route::delete('/projects/{project}/team/{user}', [TeamMemberController::class, 'destroy']) -> name('team.destroy');


    // Comments
    // Create
    Route::post('/projects/tasks/{tasks}/comments', [CommentController::class, 'store']) -> name('comment.store') -> middleware('comment.store');
    // Get All
    Route::get('/projects/tasks/{tasks}/comments', [CommentController::class, 'index']) -> name('comment.index');
    // Delete
    Route::delete('/projects/tasks/{tasks}/comments/{id}', [CommentController::class, 'destroy']) -> name('comment.destroy');
});