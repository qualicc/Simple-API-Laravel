<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::get();

        $tasksArray = $tasks -> map(function ($task) {
            return [
                'id' => $task -> id,
                'name' => $task -> name,
                'piority' => $task -> piority,
                'deadline' => $task -> deadline,
                'links' => [
                    'self' => route('tasks.show', $task -> id),
                    'update' => route('tasks.update', $task -> id),
                    'delete' => route('tasks.destroy', $task -> id),
                ]
            ];
        });

        return response() -> json($tasksArray, 200, [], JSON_UNESCAPED_SLASHES);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newTask = Task::create([
            'projectid' => $request -> projectid,
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
                'self' => route('tasks.show', $newTask -> id),
                'update' => route('tasks.update', $newTask -> id),
                'delete' => route('tasks.destroy', $newTask -> id),
            ]
        ], 201, [], JSON_UNESCAPED_SLASHES);  
    }
    
     /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);
        
        return response() -> json([
            'data' => [
                'projectid' => $task -> projectid,
                'name' => $task -> name,
                'piority' => $task -> piority,
                'deadline' => $task -> deadline,
            ],
            'links' => [
                'self' => route('tasks.show', $task -> id),
                'update' => route('tasks.update', $task -> id),
                'delete' => route('tasks.destroy', $task -> id),
            ]
        ], 201, [], JSON_UNESCAPED_SLASHES);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $task = Task::find($id);

        $task -> projectid = $request -> projectid;
        $task -> name = $request -> name;
        $task -> piority = $request -> piority;
        $task -> deadline = $request -> deadline;

        $task -> save();

        return response()->json([
            'message' => 'Task edited successful',
            'links' => [
                'self' => route('tasks.show', $task->id),
                'update' => route('tasks.update', $task->id),
                'delete' => route('tasks.destroy', $task->id),
            ]
        ], 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Task::where('id', '=', $id) -> delete();

        return response()->json([
            'message' => 'Task deleted successful',
            'links' => [
                'create' => route('tasks.store'),
                'list' => route('tasks.index'),
            ]
        ], 200, [], JSON_UNESCAPED_SLASHES); 

    }
}
