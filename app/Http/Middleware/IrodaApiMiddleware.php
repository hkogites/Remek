<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IrodaApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        // Check if user is authenticated and has Iroda or Admin privileges
        if (!$user || (!$user->is_iroda && !$user->is_admin)) {
            return response()->json([
                'message' => 'Access denied. Iroda privileges required.'
            ], 403);
        }

        return $next($request);
    }
}
