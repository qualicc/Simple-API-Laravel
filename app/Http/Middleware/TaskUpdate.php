<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $taskId = $request -> route('task');  

        if (Task::where('id', '=', $taskId) -> 
                  exists()) 
        {
            $validation = $request -> validate([
                'name' => ['required'],
                'piority' => ['required', 'integer', 'between:1,5'],
                'deadline' => ['required', 'date', 'after:today']
            ]);
            return $next($request);
        }
        return response() -> json(['error' => 'Task not found'], 404);

    }
}
