<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validation = $request -> validate([
            'name' => ['required'],
            'piority' => ['required', 'integer', 'between:1,5'],
            'deadline' => ['required', 'date', 'after:today']
        ]);

        return $next($request);
    }
}
