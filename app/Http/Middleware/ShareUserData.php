<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ShareUserData
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Share the logged-in user with all views
            view()->share('loggedInUser', Auth::user());
        }

        return $next($request);
    }
}
