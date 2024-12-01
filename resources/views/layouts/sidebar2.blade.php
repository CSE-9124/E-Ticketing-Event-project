<!-- =============== Navigation ================ -->
{{-- <div
    class="navigation fixed h-full bg-blue-950 border-l-[10px] border-blue-950 transition-all duration-500 overflow-hidden"> --}}
<div class="navigation w-[240px] min-h-screen bg-blue-950 border-r border-blue-950 transition-all duration-500">
    <ul class="absolute top-0 left-0 w-full pr-2">
        <li class="flex relative w-full list-none rounded-tl-[30px] rounded-bl-[30px] mb-[40px]">
            {{-- Toggle Bar --}}
            <div
                class="toggle relative w-[60px] h-[60px] flex pl-3 justify-center items-center text-[2.5rem] cursor-pointer text-white hover:text-yellow-400 transition-all duration-300 ease-in-out">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <a href="{{ route('home') }}" class="flex w-full text-whit items-center">
                {{-- <span class="icon relative block min-w-[60px] h-[60px] leading-[75px] text-center">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3 m-4" alt="FlowBite Logo" />
                </span> --}}
                <span
                    class="title relative block pl-[10px] self-center text-xl font-semibold sm:text-2xl leading-[60px] text-start whitespace-nowrap text-yellow-400">Tix</span>
                <span
                    class="title relative block self-center text-xl font-semibold sm:text-2xl leading-[60px] text-start whitespace-nowrap text-white">Fest</span>
            </a>
        </li>

        @auth
            {{-- Admin Menu --}}
            @if (auth()->user()->role === 'admin')
                <li class="relative w-full list-none rounded-tr-[50px] rounded-br-[50px] hover:bg-gray-50 dark:hover:bg-gray-900 transition-all duration-300 ease-in-out"
                    id="dashboard">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex w-full text-white font-semibold no-underline m-auto hover:text-yellow-400">
                        <span class="icon relative block min-w-[60px] h-[60px] leading-[75px] text-center">
                            <ion-icon name="home-outline" class="text-[1.75rem]"></ion-icon>
                        </span>
                        <span class="title relative block px-[10px] h-[60px] leading-[60px] text-start whitespace-nowrap">
                            Dashboard
                        </span>
                    </a>
                </li>

                <li class="relative w-full list-none rounded-tr-[50px] rounded-br-[50px] hover:bg-gray-50 dark:hover:bg-gray-900 transition-all duration-300 ease-in-out"
                    id="users">
                    <a href="{{ route('admin.users') }}"
                        class="flex w-full text-white font-semibold no-underline hover:text-yellow-400">
                        <span class="icon relative block min-w-[60px] h-[60px] leading-[75px] text-center">
                            <ion-icon name="people-outline" class="text-[1.75rem]"></ion-icon>
                        </span>
                        <span class="title relative block px-[10px] h-[60px] leading-[60px] text-start whitespace-nowrap">
                            Users
                        </span>
                    </a>
                </li>

                <li class="relative w-full list-none rounded-tr-[50px] rounded-br-[50px] hover:bg-gray-50 dark:hover:bg-gray-900 transition-all duration-300 ease-in-out"
                    id="events">
                    <a href="{{ route('admin.events') }}"
                        class="flex w-full text-white font-semibold no-underline hover:text-yellow-400">
                        <span class="icon relative block min-w-[60px] h-[60px] leading-[75px] text-center">
                            <ion-icon name="calendar-outline" class="text-[1.75rem]"></ion-icon>
                        </span>
                        <span class="title relative block px-[10px] h-[60px] leading-[60px] text-start whitespace-nowrap">
                            Events
                        </span>
                    </a>
                </li>

                <li class="relative w-full list-none rounded-tr-[50px] rounded-br-[50px] hover:bg-gray-50 dark:hover:bg-gray-900 transition-all duration-300 ease-in-out"
                    id="tickets">
                    <a href="{{ route('admin.tickets') }}"
                        class="flex w-full text-white font-semibold no-underline hover:text-yellow-400">
                        <span class="icon relative block min-w-[60px] h-[60px] leading-[75px] text-center">
                            <ion-icon name="ticket-outline" class="text-[1.75rem]"></ion-icon>
                        </span>
                        <span class="title relative block px-[10px] h-[60px] leading-[60px] text-start whitespace-nowrap">
                            Tickets
                        </span>
                    </a>
                </li>

                <li x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center w-full text-white font-semibold hover:bg-gray-50 dark:hover:bg-gray-900 hover:text-yellow-400 rounded-tr-[50px] rounded-br-[50px] transition-all duration-300 ease-in-out">
                        <span class="icon relative block min-w-[60px] h-[60px] leading-[75px] text-center">
                            <ion-icon name="newspaper-outline" class="text-[1.75rem]"></ion-icon>
                        </span>
                        <span class="title relative block px-[10px] h-[60px] leading-[60px] text-start whitespace-nowrap">
                            Reports
                        </span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="pl-4 mt-2 space-y-2 transition-all duration-300">
                        <a href="{{ route('admin.reports.sales') }}"
                            class="flex px-4 items-center w-full text-white font-semibold hover:bg-gray-50 dark:hover:bg-gray-900 hover:text-yellow-400 rounded-full transition-all duration-300 ease-in-out group">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.75rem" height="1.75rem" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M11.1 19h1.75v-1.25q1.25-.225 2.15-.975t.9-2.225q0-1.05-.6-1.925T12.9 11.1q-1.5-.5-2.075-.875T10.25 9.2t.463-1.025T12.05 7.8q.8 0 1.25.387t.65.963l1.6-.65q-.275-.875-1.012-1.525T12.9 6.25V5h-1.75v1.25q-1.25.275-1.95 1.1T8.5 9.2q0 1.175.688 1.9t2.162 1.25q1.575.575 2.188 1.025t.612 1.175q0 .825-.587 1.213t-1.413.387t-1.463-.512T9.75 14.1l-1.65.65q.35 1.2 1.088 1.938T11.1 17.7zm.9 3q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                            </svg>
                            <span
                                class="title relative block px-[10px] h-[60px] leading-[60px] text-start whitespace-nowrap">
                                Sales Report
                            </span>
                        </a>
                        <a href="{{ route('admin.reports.user_activity') }}"
                            class="flex px-4 items-center w-full text-white font-semibold hover:bg-gray-50 dark:hover:bg-gray-900 hover:text-yellow-400 rounded-full transition-all duration-300 ease-in-out group">
                            <svg class="w-6 h-6 text-[1.75rem] text-gray-800 dark:text-white group-hover:text-yellow-400 transition-all duration-300 ease-in-out"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1.75rem" height="1.75rem"
                                fill="none" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2"
                                    d="M7 6H5m2 3H5m2 3H5m2 3H5m2 3H5m11-1a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2M7 3h11a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm8 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                            </svg>
                            <span
                                class="title relative block px-[10px] h-[60px] leading-[60px] text-start whitespace-nowrap">
                                User Activity
                            </span>
                        </a>
                    </div>
                </li>

            {{-- Event Organizer Menu --}}
            @elseif (auth()->user()->role === 'event_organizer')
                <li class="relative w-full list-none rounded-tr-[50px] rounded-br-[50px] hover:bg-gray-50 dark:hover:bg-gray-900 transition-all duration-300 ease-in-out"
                    id="dashboard">
                    <a href="{{ route('organizer.dashboard') }}"
                        class="flex w-full text-white font-semibold no-underline hover:text-yellow-400">
                        <span class="icon relative block min-w-[60px] h-[60px] leading-[75px] text-center">
                            <ion-icon name="home-outline" class="text-[1.75rem]"></ion-icon>
                        </span>
                        <span class="title relative block px-[10px] h-[60px] leading-[60px] text-start whitespace-nowrap">
                            Dashboard
                        </span>
                    </a>
                </li>

                <li class="relative w-full list-none rounded-tr-[50px] rounded-br-[50px] hover:bg-gray-50 dark:hover:bg-gray-900 transition-all duration-300 ease-in-out"
                    id="events">
                    <a href="{{ route('organizer.events') }}"
                        class="flex w-full text-white font-semibold no-underline hover:text-yellow-400">
                        <span class="icon relative block min-w-[60px] h-[60px] leading-[75px] text-center">
                            <ion-icon name="calendar-outline" class="text-[1.75rem]"></ion-icon>
                        </span>
                        <span class="title relative block px-[10px] h-[60px] leading-[60px] text-start whitespace-nowrap">
                            Events
                        </span>
                    </a>
                </li>

                <li class="relative w-full list-none rounded-tr-[50px] rounded-br-[50px] hover:bg-gray-50 dark:hover:bg-gray-900 transition-all duration-300 ease-in-out"
                    id="tickets">
                    <a href="{{ route('organizer.tickets') }}"
                        class="flex w-full text-white font-semibold no-underline hover:text-yellow-400">
                        <span class="icon relative block min-w-[60px] h-[60px] leading-[75px] text-center">
                            <ion-icon name="ticket-outline" class="text-[1.75rem]"></ion-icon>
                        </span>
                        <span class="title relative block px-[10px] h-[60px] leading-[60px] text-start whitespace-nowrap">
                            Tickets
                        </span>
                    </a>
                </li>
            
            {{-- Registerd User Menu --}}
            @elseif (auth()->user()->role === 'user')
                <li class="relative w-full list-none rounded-tl-[30px] rounded-bl-[30px] hover:bg-gray-50" id="dashboard">
                    <a href="#" class="flex w-full text-white font-semibold no-underline hover:text-blue-600">
                        <span class="icon relative block min-w-[60px] h-[60px] leading-[75px] text-center">
                            <ion-icon name="home-outline" class="text-[1.75rem]"></ion-icon>
                        </span>
                        <span class="title relative block px-[10px] h-[60px] leading-[60px] text-start whitespace-nowrap">
                            Dashboard
                        </span>
                    </a>
                </li>
                {{-- <li class="relative w-full list-none rounded-tl-[30px] rounded-bl-[30px] hover:bg-gray-50">
                        <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                            @csrf
                            <a href="{{ route('logout') }}" class="flex w-full text-white no-underline hover:text-blue-600"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <span class="icon relative block min-w-[60px] h-[60px] leading-[75px] text-center">
                                    <ion-icon name="log-out-outline" class="text-[1.75rem]"></ion-icon>
                                </span>
                                <span
                                    class="title relative block px-[10px] h-[60px] leading-[60px] text-start whitespace-nowrap">Sign
                                    Out</span>
                            </a>
                        </form>
                    </li> --}}
            @endif
        @endauth
    </ul>
</div>
