<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = TeamMember::get();

        $teamsArray = $teams -> map(function ($team) {
            return [
                'id' => $team -> id,
                'projectid' => $team -> projectid,
                'name' => $team -> name,
                'created_at' => $team -> created_at,
                'updated_at' => $team -> updated_at,
                'links' => [
                    'delete' => route('team.destroy', $team -> id),
                ]
            ];
        });

        return response() -> json($teamsArray, 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newTeamMember= TeamMember::create([
            'projectid' => $request -> projectid,
            'name' => $request -> name,
        ]);
        return response()->json([
            'message' => 'Task created successfully',
            'data' => [
                'id' => $newTeamMember -> id,
                'projectid' => $newTeamMember -> projectid,
                'name' => $newTeamMember -> name,
                'created_at' => $newTeamMember -> created_at,
                'updated_at' => $newTeamMember -> updated_at,
            ],
            'links' => [
                'self' => route('team.index'),
                'delete' => route('team.destroy', $newTeamMember -> id),
            ]
        ], 201, [], JSON_UNESCAPED_SLASHES);    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user)
    {
        TeamMember::where('id', '=', $user) -> delete();

        return response() -> json([
            'message' => 'Task deleted successfully',
            'links' => [
                'self' => route('team.index'),
            ]
        ], 200, [], JSON_UNESCAPED_SLASHES);  
    }
}
