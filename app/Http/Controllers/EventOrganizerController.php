<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventOrganizerController extends Controller
{
    public function dashboard()
    {
        return view('organizer.dashboard');
    }
}
