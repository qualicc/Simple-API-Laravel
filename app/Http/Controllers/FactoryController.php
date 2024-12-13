<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;


class FactoryController extends Controller
{
    public function factory()
    {
            Project::factory() -> 
                     count(5) -> 
                     hasTasks(4, function (array $attributes, Project $project) {
                         return ['projectid' => $project->id];
                     }) ->
                     hasTeamMembers(10, function (array $attributes, Project $project) {
                         return ['projectid' => $project->id];
                     }) ->
                    create();
            Task::all()->each(function ($task) {
            Comment::factory() ->
                     count(5) ->
                     create(['taskid' => $task->id]);
        });
        
        return response() -> json(['Data factoring successful']);  
    }
}
