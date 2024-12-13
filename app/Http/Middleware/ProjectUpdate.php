<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $projectId = $request -> route('id');        

        if (Project::where('id', '=', $projectId) -> exists()) {
            $validation = $request -> validate([
                'name' => ['required'],
                'description' => ['required'],
                'deadline' => ['required', 'date', 'after:today']
            ]);
            return $next($request);
        }
        return response() -> json(['error' => 'Project not found'], 404);
    }
}
