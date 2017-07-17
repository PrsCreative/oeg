<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Frontend\UserController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuthenticateFrontend
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $currentName  = Route::currentRouteName();

        if (!Auth::guard($guard)->check()|| Auth::user()->role != 'Student') {
            Auth::logout();
            return redirect()->route('frontend.user.login.get');
        }

        $hasHspApp          = UserController::hasHspApplication(Auth::user()->getAuthIdentifier());
        $isRouteDashboard   = $currentName == 'frontend.dashboard';
        $request->session()->put('hasHspApp' , $hasHspApp);

        //redirect to dashboard info
        if( $hasHspApp && $isRouteDashboard ){
            return redirect()->route('frontend.dashboard.info');
        }

        return $next($request);
    }
}
