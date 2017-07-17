<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    public function getLogin()
    {
        // Check has auth
        if (Auth::viaRemember() || Auth::check()) {
            return redirect()->route('backoffice.dashboard.get');
        }

        return view('backoffice.pages.auth.login');
    }

    public function postLogin(Request $request)
    {
        // Validation
        $rules = [
            'email'     => 'required|email',
            'password'  => 'required'
        ];

        $this->validate($request, $rules);

        // Auth
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $request->get('remember'))) {
            return redirect()->route('backoffice.dashboard.get');
        }

        return redirect()->back()->withErrors(['globalError' => 'These credentials do not match our records.']);
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('backoffice.login.get');
    }

    public function getDashboard()
    {
        return view('backoffice.pages.dashboard.index');
    }
}