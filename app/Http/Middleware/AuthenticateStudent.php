<?php
/**
 * Created by PhpStorm.
 * User: aong_
 * Date: 4/25/2017
 * Time: 12:07 PM
 */

namespace App\Http\Middleware;

use App\Http\Controllers\Frontend\UserController;
use App\Models\NavBarTemplate;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuthenticateStudent
{
    public function handle($request, Closure $next, $guard = null)
    {
        $currentName  = Route::currentRouteName();
        $isStudent    = Auth::user()->role == 'Student';
        $user         = User::find(Auth::user()->getAuthIdentifier());
        $hasHspApp    = UserController::hasHspApplication(Auth::user()->getAuthIdentifier());
        $isRouteApply = $currentName == 'frontend.dashboard.apply_application' || $currentName == 'frontend.dashboard.apply_application.post';

        request()->session()->put('hspApp' , $user->getHspAppInfo);

        if ( ( !$isStudent || !$hasHspApp ) && !$isRouteApply ) {
            return redirect()->route('frontend.dashboard');
        }elseif( $hasHspApp && $isRouteApply ) {
            return redirect()->route('frontend.dashboard.info');
        }

        //check state in nav bar
        $navBarRedirects = NavBarTemplate::all();
        foreach($navBarRedirects as $navBarRedirect){
            if(
                in_array($currentName,explode(',',$navBarRedirect->route_name_to_active)) &&
                $user->getHspAppInfo->state < $navBarRedirect->show_in_state
            )
            {
                return redirect()->route('frontend.dashboard.info');
            }
        }

        return $next($request);
    }
}