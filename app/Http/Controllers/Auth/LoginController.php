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
        return response()
            ->view('auth.login')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

    /**
     * Only active accounts may create an authenticated session.
     */
    protected function credentials(Request $request)
    {
        return array_merge(
            $request->only($this->username(), 'password'),
            ['status' => 'active']
        );
    }

    /**
     * Limit repeated password guesses per email address and IP address.
     */
    protected function maxAttempts()
    {
        return 5;
    }

    protected function decayMinutes()
    {
        return 15;
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
