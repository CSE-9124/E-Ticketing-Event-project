<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Menampilkan dashboard admin
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalOrganizers = User::where('role', 'event_organizer')->count();
        $totalEvents = Event::count();
        $totalRevenue = Ticket::where('status', 'active')
            ->join('events', 'tickets.event_id', '=', 'events.id')
            ->sum('events.ticket_price');

        return view('admin.dashboard', compact('totalUsers', 'totalOrganizers', 'totalEvents', 'totalRevenue'));
    }

    // User Management
    // Menampilkan daftar pengguna
    public function manageUsers(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->has('role') && $request->role != 'all') {
            $query->where('role', $request->role);
        }

        // Sorting
        $sortField = $request->sort ?? 'created_at';
        $sortDirection = $request->direction ?? 'desc';
        $query->orderBy($sortField, $sortDirection);

        $users = $query->paginate(10);
        $users->appends(request()->query());

        return view('admin.users.index', compact('users'));
    }

    // Menampilkan form untuk membuat pengguna baru
    public function createUser()
    {
        return view('admin.users.create');
    }

    // Menyimpan pengguna baru
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,event_organizer,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        session()->flash('sukses', 'User successfully created!');

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dibuat.');
    }

    // Menampilkan form untuk mengedit pengguna
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Memperbarui data pengguna
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,event_organizer,user',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        session()->flash('update', 'User updated successfully!');

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Menghapus pengguna
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('delete', 'User successfully deleted!');

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    }


    // Event Management
    // Menampilkan daftar event
    public function manageEvents(Request $request)
    {
        $query = Event::with('organizer');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $events = $query->latest()->paginate(10);
        $events->appends(request()->query());

        return view('admin.events.index', compact('events'));
    }

    // Menampilkan form untuk membuat event baru
    public function createEvent()
    {
        return view('admin.events.create');
    }

    // Menyimpan event baru
    public function storeEvent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'date_time' => 'required|date',
            'location' => 'required|string|max:255',
            'category' => 'required|in:music,sport,conference,culiner,theater,festival,others',
            'ticket_price' => 'required|numeric|min:0',
            'ticket_quota' => 'required|integer|min:1',
            'event_image' => 'nullable|image|max:2048',
        ]);

        // Handle the file upload
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
            'category' => $request->category,
            'ticket_price' => $request->ticket_price,
            'ticket_quota' => $request->ticket_quota,
            'event_image' => $imagePath,
            'organizer_id' => Auth::id(), // Default untuk admin
        ]);

        session()->flash('sukses', 'Event successfully created!');

        return redirect()->route('admin.events')->with('success', 'Acara berhasil dibuat.');
    }

    // Menampilkan form untuk mengedit event
    public function editEvent($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    // Memperbarui event pengguna
    public function updateEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);

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

        return redirect()->route('admin.events')->with('success', 'Acara berhasil diperbarui.');
    }

    // Menghapus event
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        session()->flash('delete', 'Event successfully deleted!');

        return redirect()->route('admin.events')->with('success', 'Acara berhasil dihapus.');
    }

    // Ticket Management
    public function manageTickets()
    {
        $events = Event::withCount([
            'tickets',
            'tickets as active_tickets_count' => function ($query) {
                $query->where('status', 'active');
            },
            'tickets as cancelled_tickets_count' => function ($query) {
                $query->where('status', 'cancelled');
            }
        ])->paginate(10);

        return view('admin.tickets.index', compact('events'));
    }

    public function viewEventTickets($eventId)
    {
        $event = Event::with(['tickets' => function ($query) {
            $query->with('user')->orderBy('created_at', 'desc');
        }])->findOrFail($eventId);

        return view('admin.tickets.show', compact('event'));
    }

    public function approveTicket(Ticket $ticket)
    {
        if ($ticket->status !== 'active') {
            $ticket->update([
                'status' => 'active',
                'updated_at' => Carbon::now(),
                'cancel_by' => null
            ]);

            session()->flash('success', 'Ticket has been approved!');
        }

        return back();
    }

    public function cancelTicket(Ticket $ticket)
    {
        if ($ticket->status !== 'cancelled') {
            $ticket->update([
                'status' => 'cancelled',
                'cancel_by' => now()
            ]);

            session()->flash('success', 'Ticket has been cancelled!');
        }

        return back();
    }


    // Reports
    public function salesReport()
    {
        $salesData = DB::table('events')
            ->leftJoin('tickets', 'events.id', '=', 'tickets.event_id')
            ->select(
                'events.id',
                'events.name as event_name',
                'events.ticket_price',
                DB::raw('COUNT(CASE WHEN tickets.status = "active" THEN 1 END) as active_tickets'),
                DB::raw('COUNT(CASE WHEN tickets.status = "cancelled" THEN 1 END) as cancelled_tickets'),
                DB::raw('COUNT(tickets.id) as total_tickets'),
                DB::raw('SUM(CASE WHEN tickets.status = "active" THEN events.ticket_price ELSE 0 END) as total_sales'),
                'events.created_at'
            )
            ->groupBy('events.id', 'events.name', 'events.ticket_price', 'events.created_at')
            ->orderBy('total_sales', 'desc')
            ->get();

        $dailySales = DB::table('tickets')
            ->join('events', 'tickets.event_id', '=', 'events.id')
            ->where('tickets.status', 'active')
            ->where('tickets.created_at', '>=', now()->subDays(30))
            ->select(
                DB::raw('DATE(tickets.created_at) as date'),
                DB::raw('COUNT(*) as tickets_sold'),
                DB::raw('SUM(events.ticket_price) as daily_revenue')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.reports.sales', [
            'reports' => $salesData,
            'dailySales' => $dailySales,
            'totalRevenue' => $salesData->sum('total_sales'),
            'totalTickets' => $salesData->sum('active_tickets'),
            'totalEvents' => $salesData->count()
        ]);
    }

    // Aktivitas Pengguna
    public function userActivityReport()
    {
        $userActivities = DB::table('users')
            ->leftJoin('tickets', 'users.id', '=', 'tickets.user_id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                DB::raw('COUNT(tickets.id) as total_tickets'),
                DB::raw('SUM(tickets.status = "active") as active_tickets'),
                DB::raw('SUM(tickets.status = "cancelled") as cancelled_tickets')
            )
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderBy('total_tickets', 'desc')
            ->get();

        return view('admin.reports.user_activity', compact('userActivities'));
    }
}
