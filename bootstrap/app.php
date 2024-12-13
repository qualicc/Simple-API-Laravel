<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'api.access' => \App\Http\Middleware\APIAccess::class,
            'project.store' => \App\Http\Middleware\ProjectStore::class,
            'project.update' => \App\Http\Middleware\ProjectUpdate::class,
            'task.store' => \App\Http\Middleware\TaskStore::class,
            'task.update' => \App\Http\Middleware\TaskUpdate::class,
            'team.store' => \App\Http\Middleware\TeamStore::class,
            'comment.store' => \App\Http\Middleware\CommentStore::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'projects',
            'projects/*',
            'tasks',
            'tasks/*',
            'team',
            'team/*',
            'comments',
            'comments/*'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
