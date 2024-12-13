<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validation = $request -> validate([
            'taskid' => ['required'],
            'text' => ['required']
        ]);

        if (Task::where('id', '=', $request -> taskid) -> exists()) 
        {
            return $next($request);
        }
        
        return redirect() -> json(['error' => 'Task not found'], 404);
    }
}
