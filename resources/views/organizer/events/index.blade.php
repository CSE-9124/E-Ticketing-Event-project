@extends('layouts.app')

@section('title', 'My Events')

@section('content')
    <div class="py-10 px-5">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">My Events</h1>
            <a href="{{ route('organizer.events.create') }}"
                class="px-4 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200 flex items-center gap-1">
                <ion-icon name="add-circle-outline" class="text-xl"></ion-icon>
                <span>Create New Event</span>
            </a>
        </div>

        <!-- Session Messages -->
        @if (session('sukses'))
            <div id="alert-success"
                class="flex items-center p-4 mb-4 rounded-lg bg-green-50 border-2 border-green-800 dark:bg-gray-800 dark:border-green-400">
                <div class="ms-3 text-sm font-medium text-green-800 dark:text-green-400">
                    {{ session('sukses') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @elseif (session('update'))
            <div id="alert-update"
                class="flex items-center p-4 mb-4 rounded-lg bg-blue-50 border-2 border-blue-800 dark:bg-gray-800 dark:border-blue-400"
                role="alert">
                <div class="ms-3 text-sm font-medium text-blue-800 dark:text-blue-400">
                    {{ session('update') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-update" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @elseif (session('delete'))
            <div id="alert-delete"
                class="flex items-center p-4 mb-4 rounded-lg bg-red-50 border-2 border-red-800 dark:bg-gray-800 dark:border-red-400"
                role="alert">
                <div class="ms-3 text-sm font-medium text-red-800 dark:text-red-400">
                    {{ session('delete') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-delete" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($events as $event)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <!-- Event Image -->
                    <img class="w-full h-48 object-cover"
                        src="{{ $event->event_image ? asset('storage/' . $event->event_image) : "https://via.placeholder.com/400x300" }}"
                        alt="{{ $event->name }}">

                    <!-- Event Details -->
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $event->name }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ Str::limit($event->description, 100) }}
                        </p>

                        <!-- Event Info -->
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <ion-icon name="calendar-outline" class="w-4 h-4 mr-2"></ion-icon>
                                <span>{{ $event->date_time->format('M d, Y - H:i A') }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <ion-icon name="location-outline" class="w-4 h-4 mr-2"></ion-icon>
                                <span>{{ $event->location }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <ion-icon name="ticket-outline" class="w-4 h-4 mr-2"></ion-icon>
                                <span>{{ $event->ticket_quota }} tickets available</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <ion-icon name="cash-outline" class="w-4 h-4 mr-2"></ion-icon>
                                <span>Rp{{ number_format($event->ticket_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('organizer.events.edit', $event->id) }}"
                                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm transition-all duration-300 ease-in-out">
                                Edit
                            </a>
                            <form action="{{ route('organizer.events.delete', $event->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm transition-all duration-300 ease-in-out"
                                    onclick="return confirm('Are you sure you want to delete this event?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Events Yet</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4">Start by creating your first event!</p>
                    <a href="{{ route('organizer.events.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                        <ion-icon name="add-outline" class="w-5 h-5 mr-2"></ion-icon>
                        Create Event
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($events->hasPages())
            <div class="mt-6">
                {{ $events->links() }}
            </div>
        @endif
    </div>
@endsection
