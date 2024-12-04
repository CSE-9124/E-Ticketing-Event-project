<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Ticket::where('user_id', Auth::id())
            ->with('event')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('user.bookings.index', compact('bookings'));
    }

    public function store(Request $request, Event $event)
    {
        // Check if event hasn't passed
        if (Carbon::now()->isAfter($event->date_time)) {
            return back()->with('error', 'This event has already passed.');
        }

        // Check available tickets
        if ($event->ticket_quota <= $event->tickets_count) {
            return back()->with('error', 'Sorry, no tickets available.');
        }

        DB::beginTransaction();
        try {
            // Create ticket
            $ticket = Ticket::create([
                'user_id' => Auth::id(),
                'event_id' => $event->id,
                'booking_date' => Carbon::now(),
                'status' => 'pending'
            ]);

            DB::commit();
            return redirect()->route('user.bookings.show', $ticket)
                ->with('success', 'Ticket booked successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Booking failed. Please try again.');
        }
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.bookings.show', compact('ticket'));
    }

    public function cancel(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if event hasn't started yet (24 hours before)
        if (Carbon::now()->addHours(24)->isAfter($ticket->event->date_time)) {
            return back()->with('error', 'Cannot cancel ticket within 24 hours of event.');
        }

        DB::beginTransaction();
        try {
            $ticket->update([
                'status' => 'cancelled',
                'cancel_by' => Carbon::now()
            ]);

            DB::commit();
            return redirect()->route('user.bookings.index')
                ->with('success', 'Booking cancelled successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Cancellation failed. Please try again.');
        }
    }
}
