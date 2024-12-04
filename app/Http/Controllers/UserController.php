<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function favoriteEvents()
    {
        $user = User::find(Auth::id());

        $favoriteEvents = $user
            ->favoriteEvents()
            ->with('organizer')
            ->orderBy('date_time')
            ->paginate(9);

        return view('user.favorites.index', compact('favoriteEvents'));
    }
}
