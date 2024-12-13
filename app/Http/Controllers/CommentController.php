<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $comments = Comment::get();

        $commentsArray = $comments -> map(function ($comment) {
            return [
                'id' => $comment -> id,
                'taskid' => $comment -> taskid,
                'text' => $comment -> text,
                'created_at' => $comment -> created_at,
                'updated_at' => $comment -> updated_at,
                'links' => [
                    'delete' => route('comment.destroy', $comment -> id),
                ]
            ];
        });

        return response() -> json($commentsArray, 200, [], JSON_UNESCAPED_SLASHES);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $newComment= Comment::create([
            'taskid' => $request -> taskid,
            'text' => $request -> text,
        ]);

        return response()->json([
            'message' => 'Comment created successfully',
            'data' => [
                'id' => $newComment -> id,
                'taskid' => $newComment -> taskid,
                'text' => $newComment -> text,
                'created_at' => $newComment -> created_at,
                'updated_at' => $newComment -> updated_at,
            ],
            'links' => [
                'self' => route('comment.index'),
                'delete' => route('comment.destroy', $newComment -> id),
            ]
        ], 201, [], JSON_UNESCAPED_SLASHES);    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($project)
    {
        Comment::where('id', '=', $project) -> delete();

        return response() -> json([
            'message' => 'Comment deleted successfully',
            'links' => [
                'self' => route('comment.index'),
            ]
        ], 200, [], JSON_UNESCAPED_SLASHES);  
    }
}
