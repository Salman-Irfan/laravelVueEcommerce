<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AdminCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {   
        // Check if the user is authenticated and is an admin (has is_admin = 1)
        if(Auth::user() && Auth::user()->is_admin===1) {
            return $next($request);
        }else {
            // unauthorized
            return response([
                'message' => 'Unauthorized',
            ], 403);
        }
    }
}
