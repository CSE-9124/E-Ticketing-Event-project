<nav class="relative z-10 w-full px-6 py-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-bold text-white">
            <a href="{{ route('home') }}">
                <span class="text-yellow-400">Tix</span>Fest
            </a>
        </h1>

        <div class="hidden md:flex space-x-4">
            <a href="{{ route('events') }}"
                class="text-white hover:text-yellow-400 transition-colors duration-300">Events</a>
            <a href="#about" class="text-white hover:text-yellow-400 transition-colors duration-300">About</a>
            <a href="#contact" class="text-white hover:text-yellow-400 transition-colors duration-300">Contact</a>
        </div>

        @if (Route::has('login'))
            <div class="space-x-4">
                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-white hover:text-yellow-400 transition-colors duration-300">
                            Dashboard
                        </a>
                    @elseif(auth()->user()->role === 'event_organizer')
                        <a href="{{ route('organizer.dashboard') }}"
                            class="text-white hover:text-yellow-400 transition-colors duration-300">
                            Dashboard
                        </a>
                    @elseif(auth()->user()->role === 'user')
                        <!-- Profile Picture -->
                        <div>
                            <button type="button"
                                class="relative flex text-sm bg-gray-800 rounded-full overflow-hidden focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-[40px] h-[40px] rounded-full object-cover"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{ route('user.dashboard') }}"
                                        class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white transition-all duration-300 ease-in-out"
                                        role="menuitem">
                                        <ion-icon name="home-outline" class="text-base"></ion-icon>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('profile.edit') }}"
                                        class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white transition-all duration-300 ease-in-out"
                                        role="menuitem">
                                        <ion-icon name="person-outline" class="text-base"></ion-icon>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 font-semibold hover:bg-red-600 hover:text-white transition-all duration-300 ease-in-out">
                                            <ion-icon name="log-out-outline" class="text-base"></ion-icon>
                                            Log out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-yellow-400 transition-colors duration-300">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg hover:bg-yellow-500 transition-colors duration-300">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>
