@extends('welcome')

@section('title', $event->name)

@section('content')
    <div class="py-10 px-5">
        <!-- Event Header -->
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <!-- Event Image -->
            @if ($event->event_image)
                <img src="{{ Storage::url($event->event_image) }}" alt="{{ $event->name }}"
                    class="w-full h-64 object-cover object-center">
            @endif

            <!-- Event Details -->
            <div class="p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                            {{ $event->name }}
                        </h1>
                        <div class="flex items-center gap-4 text-gray-600 dark:text-gray-300 mb-6">
                            <div class="flex items-center">
                                <ion-icon name="calendar-outline" class="text-xl mr-2"></ion-icon>
                                {{ $event->date_time->format('D, M d, Y') }}
                            </div>
                            <div class="flex items-center">
                                <ion-icon name="time-outline" class="text-xl mr-2"></ion-icon>
                                {{ $event->date_time->format('h:i A') }}
                            </div>
                        </div>
                    </div>

                    <!-- Favorite Button -->
                    @auth
                        <button type="button" onclick="toggleFavorite({{ $event->id }})"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700">
                            <ion-icon name="{{ auth()->user()->favoriteEvents->contains($event) ? 'heart' : 'heart-outline' }}"
                                class="text-xl {{ auth()->user()->favoriteEvents->contains($event) ? 'text-red-500' : 'text-gray-600 dark:text-gray-300' }}">
                            </ion-icon>
                            <span class="text-gray-600 dark:text-gray-300">Favorite</span>
                        </button>
                    @endauth
                </div>

                <!-- Event Description -->
                <div class="prose dark:prose-invert max-w-none mb-8">
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ $event->description }}
                    </p>
                </div>

                <!-- Event Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                            <ion-icon name="location-outline"
                                class="text-2xl text-yellow-600 dark:text-yellow-400"></ion-icon>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Location</h3>
                            <p class="text-gray-900 dark:text-white">{{ $event->location }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                            <ion-icon name="ticket-outline"
                                class="text-2xl text-yellow-600 dark:text-yellow-400"></ion-icon>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Ticket Price</h3>
                            <p class="text-gray-900 dark:text-white">
                                Rp{{ number_format($event->ticket_price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                            <ion-icon name="people-outline"
                                class="text-2xl text-yellow-600 dark:text-yellow-400"></ion-icon>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Available Tickets</h3>
                            <p class="text-gray-900 dark:text-white">
                                {{ $event->ticket_quota - ($event->tickets_count ?? 0) }} remaining</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                            <ion-icon name="person-outline"
                                class="text-2xl text-yellow-600 dark:text-yellow-400"></ion-icon>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Organizer</h3>
                            <p class="text-gray-900 dark:text-white">{{ $event->organizer->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="flex justify-center">
                    @auth
                        @if ($event->date_time->isFuture())
                            @if ($event->ticket_quota - ($event->tickets_count ?? 0) > 0)
                                <form action="{{ route('user.bookings.store', $event) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition-colors duration-200">
                                        <ion-icon name="ticket-outline" class="text-xl mr-2"></ion-icon>
                                        Book Ticket
                                    </button>
                                </form>
                            @else
                                <button disabled
                                    class="inline-flex items-center px-6 py-3 bg-gray-400 text-white font-medium rounded-lg cursor-not-allowed">
                                    <ion-icon name="ticket-outline" class="text-xl mr-2"></ion-icon>
                                    Sold Out
                                </button>
                            @endif
                        @else
                            <button disabled
                                class="inline-flex items-center px-6 py-3 bg-gray-400 text-white font-medium rounded-lg cursor-not-allowed">
                                <ion-icon name="time-outline" class="text-xl mr-2"></ion-icon>
                                Event Has Ended
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition-colors duration-200">
                            <ion-icon name="log-in-outline" class="text-xl mr-2"></ion-icon>
                            Login to Book Tickets
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    @if (session('error'))
        <div class="mt-4 text-center">
            <p class="text-red-600">{{ session('error') }}</p>
        </div>
    @endif

    @push('scripts')
        <script>
            function toggleFavorite(eventId) {
                fetch(`/events/${eventId}/favorite`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'added') {
                            document.querySelector('ion-icon[name="heart-outline"]').setAttribute('name', 'heart');
                            document.querySelector('ion-icon[name="heart"]').classList.add('text-red-500');
                        } else {
                            document.querySelector('ion-icon[name="heart"]').setAttribute('name', 'heart-outline');
                            document.querySelector('ion-icon[name="heart-outline"]').classList.remove('text-red-500');
                        }
                    });
            }
        </script>
    @endpush

@endsection
