<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return RedirectResponse
     */
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            return redirect()->route('dashboard');
        }
        elseif ($user->hasRole('user')) {
            return redirect()->route('main');
        }
        return redirect()->route('main');
    }
}
