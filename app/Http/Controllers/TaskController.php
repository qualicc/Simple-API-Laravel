<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($project)
    {
        $tasks = Task::where('projectid', '=', $project) -> get();

        $tasksArray = $tasks -> map(function ($task) {
            return [
                'id' => $task -> id,
                'name' => $task -> name,
                'piority' => $task -> piority,
                'deadline' => $task -> deadline,
                'links' => [
                    'self' => route('task.show', ['project' => $task -> projectid, 'task' => $task -> id]),
                    'update' => route('task.update', ['project' => $task -> projectid, 'task' => $task -> id]),
                    'delete' => route('task.destroy', ['project' => $task -> projectid, 'task' => $task -> id]),
                ]
            ];
        });

        return response() -> json($tasksArray, 200, [], JSON_UNESCAPED_SLASHES);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $project)
    {
        $newTask = Task::create([
            'projectid' => $project,
            'name' => $request -> name,
            'piority' => $request -> piority,
            'deadline' => $request -> deadline,
        ]);

        return response() -> json([
            'message' => 'Task creating successful',
            'data' => [
                'projectid' => $newTask -> projectid,
                'name' => $newTask -> name,
                'piority' => $newTask -> piority,
                'deadline' => $newTask -> deadline,
            ],
            'links' => [
                'self' => route('task.show', ['project' => $newTask -> projectid, 'task' => $newTask -> id]),
                'update' => route('task.update', ['project' => $newTask -> projectid, 'task' => $newTask -> id]),
                'delete' => route('task.destroy', ['project' => $newTask -> projectid, 'task' => $newTask -> id]),
            ]
        ], 201, [], JSON_UNESCAPED_SLASHES);  
    }
    
     /**
     * Display the specified resource.
     */
    public function show($project, $task)
    {
        $task = Task::find($project, $task);
        
        return response() -> json([
            'data' => [
                'projectid' => $task -> projectid,
                'name' => $task -> name,
                'piority' => $task -> piority,
                'deadline' => $task -> deadline,
            ],
            'links' => [
                'self' => route('task.show', ['project' => $task -> projectid, 'task' => $task -> id]),
                'update' => route('task.update', ['project' => $task -> projectid, 'task' => $task -> id]),
                'delete' => route('task.destroy', ['project' => $task -> projectid, 'task' => $task -> id]),
            ]
        ], 201, [], JSON_UNESCAPED_SLASHES);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $project, $task)
    {
        dd(array($task,$project));
        $task = Task::find($task);

        $task -> name = $request -> name;
        $task -> piority = $request -> piority;
        $task -> deadline = $request -> deadline;

        $task -> save();

        return response()->json([
            'message' => 'Task edited successful',
            'links' => [
                'self' => route('task.show', ['project' => $task -> projectid, 'task' => $task -> id]),
                'update' => route('task.update', ['project' => $task -> projectid, 'task' => $task -> id]),
                'delete' => route('task.destroy', ['project' => $task -> projectid, 'task' => $task -> id]),
            ]
        ], 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($project, $task)
    {
        Task::where('id', '=', $task) -> delete();

        return response()->json([
            'message' => 'Task deleted successful',
            'links' => [
                'create' => route('task.store', $project),
                'list' => route('task.index', $project),
            ]
        ], 200, [], JSON_UNESCAPED_SLASHES); 

    }
}
