<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return view('admin.dashboard');
            }

            if (Auth::user()->role === 'user') {
                return view('user.home');
            }

            if (Auth::user()->role === 'event_organizer') {
                return view('organizer.home');
            }
        } else {
            return redirect('login');
        }
    }
}
