<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'TixFest - Your Event Ticketing Solution')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Animation Libraries -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <!-- Hero Section -->
    <div class="relative min-h-screen bg-gradient-to-b from-gray-900 to-gray-800">
        <!-- Navigation -->
        <nav class="relative z-10 w-full px-6 py-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-bold text-white">
                    <span class="text-yellow-400">Tix</span>Fest
                </h1>

                <div class="hidden md:flex space-x-4">
                    <a href="#events" class="text-white hover:text-yellow-400 transition-colors duration-300">Events</a>
                    <a href="#about" class="text-white hover:text-yellow-400 transition-colors duration-300">About</a>
                    <a href="#contact"
                        class="text-white hover:text-yellow-400 transition-colors duration-300">Contact</a>
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
                                <a href="{{ route('user.dashboard') }}"
                                    class="text-white hover:text-yellow-400 transition-colors duration-300">
                                    Dashboard
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="text-white hover:text-yellow-400 transition-colors duration-300">
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

        <!-- Hero Content -->
        <div class="container mx-auto px-6 py-20 text-center" data-aos="fade-up">
            <h2 class="text-4xl md:text-6xl font-bold text-white mb-8">
                Discover Amazing Events
            </h2>

            <!-- Search Section -->
            <div class="max-w-2xl mx-auto mb-16" data-aos="fade-up" data-aos-delay="200">
                <form class="flex items-center">
                    <div class="relative flex-1">
                        <input type="text" name="search" placeholder="Search events by name, category, or location"
                            class="w-full px-6 py-4 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 text-gray-900">
                    </div>
                    <button type="submit"
                        class="px-8 py-4 bg-yellow-400 text-gray-900 rounded-r-lg hover:bg-yellow-500 transition-colors duration-300">
                        Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Events Section -->
        <div class="container mx-auto px-6 pb-20">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Latest Events -->
                <div data-aos="fade-right" class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                    <h3 class="text-2xl font-bold text-white mb-6">Latest Events</h3>
                    <div class="space-y-4">
                        @foreach ($latestEvents as $event)
                            <div class="bg-white/5 rounded-lg p-4 hover:bg-white/10 transition-colors duration-300">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-white font-semibold">{{ $event->name }}</h4>
                                        <p class="text-gray-400">{{ $event->date_time->format('M d, Y') }}</p>
                                    </div>
                                    {{-- <a href="{{ route('events.show', $event->id) }}"
                                        class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg hover:bg-yellow-500 transition-colors duration-300">
                                        View
                                    </a> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Popular Events -->
                <div data-aos="fade-left" class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                    <h3 class="text-2xl font-bold text-white mb-6">Popular Events</h3>
                    <div class="space-y-4">
                        @foreach ($popularEvents as $event)
                            <div class="bg-white/5 rounded-lg p-4 hover:bg-white/10 transition-colors duration-300">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-white font-semibold">{{ $event->name }}</h4>
                                        <p class="text-gray-400">{{ $event->date_time->format('M d, Y') }}</p>
                                    </div>
                                    {{-- <a href="{{ route('events.show', $event->id) }}" 
                                            class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg hover:bg-yellow-500 transition-colors duration-300">
                                            View
                                        </a> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    </script>

    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- boxicons -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
