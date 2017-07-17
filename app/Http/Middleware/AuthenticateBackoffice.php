<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateBackoffice
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check() || Auth::user()->role != 'Admin') {

            Auth::logout();
            return redirect()->route('backoffice.login.get');
        }

        return $next($request);
    }
}
