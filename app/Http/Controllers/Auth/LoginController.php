<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasAnyRole(['Master Admin', 'Super Admin'])) {
            return redirect()->route('master.dashboard');
        }

        if ($user->hasRole('Officer')) {
            return redirect()->route('officer.dashboard');
        }

        return redirect()->intended($this->redirectPath());
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/');
    }
}
