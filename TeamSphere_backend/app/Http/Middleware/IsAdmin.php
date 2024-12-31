<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        if (Auth::user() &&  Auth::user()->role == 1) {
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unauthorized access. Admin privileges are required to perform this action.',
            'error' => 'ACCESS_DENIED',
            'data' => null
        ], 403);

    }
}
