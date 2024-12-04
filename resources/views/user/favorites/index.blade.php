@extends('layouts.app')

@section('title', 'My Favorite Events')

@section('content')
    <div class="py-10 px-5">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">My Favorite Events</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($favoriteEvents as $event)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <!-- Event Image -->
                    <img src="{{ $event->event_image ? asset('storage/' . $event->event_image) : 'https://via.placeholder.com/400x200' }}"
                        alt="{{ $event->name }}" class="w-full h-48 object-cover">

                    <div class="p-6">
                        <!-- Event Header -->
                        <div class="mb-4">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                {{ $event->name }}
                            </h2>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <ion-icon name="calendar-outline" class="mr-2"></ion-icon>
                                {{ $event->date_time->format('D, M d, Y - h:i A') }}
                            </div>
                        </div>

                        <!-- Event Details -->
                        <div class="mb-4">
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-2">
                                <ion-icon name="location-outline" class="mr-2"></ion-icon>
                                {{ $event->location }}
                            </div>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <ion-icon name="ticket-outline" class="mr-2"></ion-icon>
                                Rp{{ number_format($event->ticket_price, 0, ',', '.') }}
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-between items-center">
                            <a href="{{ route('events.show', $event) }}"
                                class="inline-flex items-center px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg transition-colors duration-200">
                                <ion-icon name="eye-outline" class="mr-2"></ion-icon>
                                View Details
                            </a>
                            <button onclick="toggleFavorite({{ $event->id }})"
                                class="inline-flex items-center p-2 text-red-500 hover:text-red-700 rounded-lg transition-colors duration-200">
                                <ion-icon name="heart" class="text-xl"></ion-icon>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="flex flex-col items-center">
                        <ion-icon name="heart-outline" class="text-6xl text-gray-400 dark:text-gray-600 mb-4"></ion-icon>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Favorite Events Yet</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">Start exploring events and add them to your
                            favorites!</p>
                        <a href="{{ route('events.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg transition-colors duration-200">
                            <ion-icon name="search-outline" class="mr-2"></ion-icon>
                            Browse Events
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($favoriteEvents->hasPages())
            <div class="mt-6">
                {{ $favoriteEvents->links() }}
            </div>
        @endif
    </div>

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
                        window.location.reload();
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script>
    @endpush
@endsection
