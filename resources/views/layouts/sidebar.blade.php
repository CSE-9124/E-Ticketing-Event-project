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
                    <a href="{{ route('admin.tickets') }}"
                        class="block px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        Manage Tickets
                    </a>
                </li>
                <li x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-2.5 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                        <span>Reports</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="pl-4 mt-2 space-y-2 transition-all duration-300">
                        <a href="{{ route('admin.reports.sales') }}"
                            class="block px-4 py-2 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                            Sales Report
                        </a>
                        <a href="{{ route('admin.reports.user_activity') }}"
                            class="block px-4 py-2 text-slate-200 font-semibold hover:bg-blue-700 hover:text-yellow-400 rounded-lg transition-all duration-300 ease-in-out">
                            User Activity
                        </a>
                    </div>
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
