<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()?->hasRole('Officer')) {
            return redirect()->route('officer.dashboard');
        }

        return view('home');
    }
}
