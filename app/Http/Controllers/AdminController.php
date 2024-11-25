<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Menampilkan dashboard admin
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalOrganizers = User::where('role', 'event_organizer')->count();
        $totalEvents = Event::count();
        // Anda bisa menambahkan data lain seperti laporan penjualan di sini

        return view('admin.dashboard', compact('totalUsers', 'totalOrganizers', 'totalEvents'));
    }

    // User Management
    // Menampilkan daftar pengguna
    public function manageUsers()
    {
        $users = User::paginate(10); // Paginate with 10 users per page
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
    public function manageEvents()
    {
        $events = Event::paginate(10); // Paginate with 10 events per page
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
}
