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
                'description' => $task -> description,
                'deadline' => $task -> deadline,
                'links' => [
                    'self' => route('task.show', $task -> id),
                    'update' => route('task.update', $task -> id),
                    'delete' => route('task.destroy', $task -> id),
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
        $newTask
    }
     /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
