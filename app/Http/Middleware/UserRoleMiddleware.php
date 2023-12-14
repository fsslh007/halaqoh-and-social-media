<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next,)
    {
        if (auth::check() && auth::user()->isAdmin()) 
        {
            return $next($request);
        }
    
        // Redirect or handle non-admin users
        return redirect()->route('home')->with('error', 'Unauthorized');
    }
}
