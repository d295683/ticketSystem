<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        {
            if ($request->user() && now()->greaterThan($request->user()->currentAccessToken()->expires_at)) {
                // Token has expired, revoke the token
                $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
                return response()->json(['message' => 'Token expired'], 401);
            }

            return $next($request);
        }

        return $next($request);
    }
}
