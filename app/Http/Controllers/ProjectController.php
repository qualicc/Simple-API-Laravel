<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::get();

        $projectsArray = $projects -> map(function ($project) {
            return [
                'id' => $project -> id,
                'name' => $project -> name,
                'description' => $project -> description,
                'deadline' => $project -> deadline,
                'links' => [
                    'self' => route('projects.show', $project -> id),
                    'update' => route('projects.update', $project -> id),
                    'delete' => route('projects.destroy', $project -> id),
                ]
            ];
        });

        return response() -> json($projectsArray, 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newProject = Project::create([
            'name' => $request -> name,
            'description' => $request -> description,
            'deadline' => $request -> deadline
        ]);

        return response() -> json([
            'message' => 'Project creating successful',
            'data' => [
                'id' => $newProject -> id,
                'name' => $newProject -> name,
                'description' => $newProject -> description,
                'deadline' => $newProject -> deadline,
            ],
            'links' => [
                'self' => route('projects.show', $newProject -> id),
                'update' => route('projects.update', $newProject -> id),
                'delete' => route('projects.destroy', $newProject -> id),
            ]
        ], 201, [], JSON_UNESCAPED_SLASHES);  
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::find($id);

        return response() -> json([
            'id' => $project -> id,
            'name' => $project -> name,
            'description' => $project -> description,
            'deadline' => $project -> deadline,
            'links' => [
                'self' => route('projects.show', $project -> id),
                'update' => route('projects.update', $project -> id),
                'delete' => route('projects.destroy', $project -> id),
            ]
        ], 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $project = Project::find($id);

        $project -> name = $request -> name;
        $project -> description = $request -> description;
        $project -> deadline = $request -> deadline;

        $project -> save();

        return response()->json([
            'message' => 'Project edited successful',
            'links' => [
                'self' => route('projects.show', $project->id),
                'update' => route('projects.update', $project->id),
                'delete' => route('projects.destroy', $project->id),
            ]
        ], 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tasks = Task::where('projectid', '=', $id) -> pluck('id');
        Comment::whereIn('taskid', $tasks) -> delete();
        Task::where('projectid', '=', $id) -> delete();
        TeamMember::where('projectid', '=', $id) -> delete();
        Project::where('id', '=', $id) -> delete();

        return response()->json([
            'message' => 'Project deleted successful',
            'links' => [
                'create' => route('projects.store'),
                'list' => route('projects.index'),
            ]
        ], 200, [], JSON_UNESCAPED_SLASHES); 
    }
}
