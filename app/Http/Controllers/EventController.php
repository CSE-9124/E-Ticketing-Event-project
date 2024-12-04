<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        // Apply search filter
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        // Apply category filter
        if ($request->category) {
            $query->where('category', $request->category);
        }

        // Apply date filter
        if ($request->date) {
            $query->whereDate('date_time', $request->date);
        }

        // Apply sorting
        switch ($request->sort) {
            case 'oldest':
                $query->orderBy('date_time', 'asc');
                break;
            case 'price_low':
                $query->orderBy('ticket_price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('ticket_price', 'desc');
                break;
            default:
                $query->orderBy('date_time', 'desc');
        }

        $events = $query->paginate(9);

        return view('content.events', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load(['organizer', 'tickets']);
        return view('events.show', compact('event'));
    }

    public function toggleFavorite(Event $event)
    {
        $user = User::find(Auth::id());

        // Debug the class of $user
        Log::info('User class: ' . get_class($user));

        if ($user->favoriteEvents()->where('event_id', $event->id)->exists()) {
            $user->favoriteEvents()->detach($event->id);
            return response()->json(['status' => 'removed']);
        }

        $user->favoriteEvents()->attach($event->id);
        return response()->json(['status' => 'added']);
    }
}
