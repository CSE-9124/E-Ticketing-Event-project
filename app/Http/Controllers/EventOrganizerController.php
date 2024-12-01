<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventOrganizerController extends Controller
{
    // Menampilkan dashboard organizer
    public function dashboard()
    {
        return view('organizer.dashboard');
    }

    // Menampilkan daftar acara yang dikelola oleh organizer
    public function manageEvents()
    {
        $events = Event::where('organizer_id', Auth::user()->id)->paginate(9);
        return view('organizer.events.index', compact('events'));
    }

    // Menampilkan form untuk membuat acara baru
    public function createEvent()
    {
        return view('organizer.events.create');
    }

    // Menyimpan acara baru
    public function storeEvent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'date_time' => 'required|date',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'ticket_quota' => 'required|integer|min:1',
            'event_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('event_images', 'public');
        } else {
            $imagePath = null;
        }

        Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'date_time' => $request->date_time,
            'location' => $request->location,
            'ticket_price' => $request->ticket_price,
            'ticket_quota' => $request->ticket_quota,
            'event_image' => $imagePath,
            'organizer_id' => Auth::id(),
        ]);

        session()->flash('sukses', 'Event successfully created!');

        return redirect()->route('organizer.events')->with('success', 'Acara berhasil dibuat.');
    }

    // Menampilkan form untuk mengedit acara
    public function editEvent($id)
    {
        $event = Event::where('id', $id)
            ->where('organizer_id', Auth::user()->id)
            ->firstOrFail();

        return view('organizer.events.edit', compact('event'));
    }

    // Memperbarui acara
    public function updateEvent(Request $request, $id)
    {
        $event = Event::where('id', $id)
            ->where('organizer_id', Auth::user()->id)
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'date_time' => 'required|date',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'ticket_quota' => 'required|integer|min:1',
            'event_image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('event_image')
            ? $request->file('event_image')->store('event_images', 'public')
            : $event->event_image;

        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'date_time' => $request->date_time,
            'location' => $request->location,
            'ticket_price' => $request->ticket_price,
            'ticket_quota' => $request->ticket_quota,
            'event_image' => $imagePath,
        ]);

        session()->flash('update', 'Event successfully updated!');

        return redirect()->route('organizer.events')->with('success', 'Acara berhasil diperbarui.');
    }

    // Menghapus acara
    public function deleteEvent($id)
    {
        $event = Event::where('id', $id)
            ->where('organizer_id', Auth::user()->id)
            ->firstOrFail();

        $event->delete();

        session()->flash('delete', 'Event successfully deleted!');

        return redirect()->route('organizer.events')->with('success', 'Acara berhasil dihapus.');
    }


    // Ticket Management
    // public function manageTickets($eventId)
    // {
    //     $event = Event::where('id', $eventId)
    //         ->where('organizer_id', Auth::user()->id)
    //         ->firstOrFail();

    //     $bookings = Ticket::where('event_id', $eventId)->get();

    //     return view('organizer.tickets.index', compact('event'));
    // }
    public function manageTickets()
    {
        // Fetch events managed by the organizer with ticket counts
        $events = Event::where('organizer_id', Auth::id())
            ->withCount('tickets')
            ->paginate(10);

        return view('organizer.tickets.index', compact('events'));
    }

    public function viewEventTickets($eventId)
    {
        $event = Event::where('id', $eventId)
            ->where('organizer_id', Auth::user()->id)
            ->with('tickets')
            ->firstOrFail();

        return view('organizer.tickets.show', compact('event'));
    }

    public function approveTicket($ticketId)
    {
        $ticket = Ticket::where('id', $ticketId)
            ->whereHas('event', function ($query) {
                $query->where('organizer_id', Auth::user()->id);
            })
            ->firstOrFail();

        $ticket->update(['status' => 'active']);

        session()->flash('success', 'Ticket successfully approved!');

        return redirect()->route('organizer.tickets', $ticket->event_id);
    }

    public function cancelTicket($ticketId)
    {
        $ticket = Ticket::where('id', $ticketId)
            ->whereHas('event', function ($query) {
                $query->where('organizer_id', Auth::user()->id);
            })
            ->firstOrFail();

        $ticket->update(['status' => 'cancelled']);

        session()->flash('success', 'Ticket successfully cancelled!');

        return redirect()->route('organizer.tickets', $ticket->event_id);
    }

    // public function downloadTicket($ticketId)
    // {
    //     $ticket = Ticket::where('id', $ticketId)
    //         ->whereHas('event', function ($query) {
    //             $query->where('organizer_id', Auth::user()->id);
    //         })
    //         ->firstOrFail();

    //     $pdf = PDF::loadView('organizer.tickets.pdf', compact('ticket'));
    //     return $pdf->download('ticket-' . $ticket->id . '.pdf');
    // }
}
