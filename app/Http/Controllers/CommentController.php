<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Cache::remember('comments', 60, function() {
            return Comment::get();
        });

        return response()->json([
            'state' => 'success',
            'comments' => $comments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function userStore(StoreCommentRequest $request, $id) {
        $user = User::with('comments')->find($id);

        Cache::forget('comments');

        if($user) {
            $user->comments()->insert([
                'user_id' => $request->user()->id,
                'commentable_type' => 'user',
                'commentable_id' => time(),
                'comment' => $request->comment,
                "created_at" => now(),
                "updated_at" => now()
            ]);

            return response()->json([
                'state' => 'success',
                'user' => $user->with('comments'),
            ]);
        } else {
            return response()->json([
                'state' => 'error',
                'error' => 'user not found',
            ]);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function documentStore(StoreCommentRequest $request, $id)
    {
        $document = Document::with('comments')->find($id);

        Cache::forget('comments');

        if($document) {
            $document->comments()->insert([
                'user_id' => $request->user()->id,
                'commentable_type' => 'document',
                'commentable_id' => time(),
                'comment' => $request->comment,
                "created_at" => now(),
                "updated_at" => now()
            ]);

            return response()->json([
                'state' => 'success',
                'document' => $document
            ]);
        } else {
            return response()->json([
                'state' => 'error',
                'error' => 'document not found'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment, $id)
    {
        $comment = Comment::find($id);

        return response()->json([
            'state' => 'success',
            'comment' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment, $id)
    {
        $comment = Comment::find($id);

        Cache::forget('comments');

        $comment->update([
            'comment' => $request->comment
        ]);

        return response()->json([
            'state' => 'success',
            'document' => $comment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment, $id)
    {
        $comment = Comment::find($id);

        Cache::forget('comments');

        $comment->delete();

        return response()->json([
            'state' => 'success',
            'comment' => $comment
        ]);
    }
}
