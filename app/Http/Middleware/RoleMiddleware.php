<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check() || !$request->user()->hasRole($roles)) {
            if (in_array('api', $request->route()->middleware())) {
                // This is an API request, return a JSON response
                return response()->json(['code' => 403, 'error' => 'Unauthorized'], 403);
            } else {
                // This is a web request, return a view response
                abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}
