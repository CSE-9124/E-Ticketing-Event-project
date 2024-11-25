<nav class="bg-blue-950 w-[14rem] h-auto flex flex-col gap-10 z-40 shadow-md">
    <!-- Logo -->
    <div class="logo text-xl font-bold text-center h-16 flex items-center justify-center sm:text-2xl whitespace-nowrap dark:text-white">TixFest</div>

    <!-- Sidebar Navigation -->
    <ul class="px-6 space-y-2 fixed py-20">
        @auth
            @if (auth()->user()->role === 'admin')
                <!-- Admin Menu -->
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}"
                        class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        Manage Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.events') }}"
                        class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        Manage Events
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        Reports
                    </a>
                </li>
            @elseif (auth()->user()->role === 'event_organizer')
                <!-- Event_Organizer Menu -->
                <li>
                    <a href="#"
                        class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        Manage Events
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        View Bookings
                    </a>
                </li>
            @elseif (auth()->user()->role === 'user')
                <!-- Pasien Menu -->
                <li>
                    <a href="#"
                        class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        Profile Management
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        Booking History
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        Favorite Events
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                    User Profil
                </a>
            </li>
        @endauth
    </ul>
</nav>
