<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestEvents = Event::latest()->take(5)->get();
        $popularEvents = Event::withCount('tickets')
            ->orderByDesc('tickets_count')
            ->take(5)
            ->get();

        return view('content.homepage', compact('latestEvents', 'popularEvents'));
    }
}
