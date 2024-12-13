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
            'projectid' => ['required', 'integer'],
            'name' => ['required'],
            'piority' => ['required', 'integer', 'between:1,5'],
            'deadline' => ['required', 'date', 'after:today']
        ]);
        if (Project::where('id', '=', $request -> projectid) -> exists()) 
        {
            return $next($request);
        }
        
        return redirect() -> json(['error' => 'Project not found'], 404);
    }
}