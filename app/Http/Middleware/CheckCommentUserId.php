<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckCommentUserId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');

        // Log::error($id);

        $comment = Comment::find($id);

        // Log::error($comment);

        if ($comment->user_id != $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
