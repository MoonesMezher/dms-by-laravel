<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        $comment = $request->route('comment');

        if ($comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
