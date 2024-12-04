@extends('layouts.app')

@section('content')
    <div class="py-10 px-5">
        <div class="max-w-4xl mx-auto">
            <!-- Event Hero Section -->
            <div class="relative mb-8 rounded-2xl overflow-hidden shadow-lg">
                <img src="{{ $ticket->event->event_image ? asset('storage/' . $ticket->event->event_image) : 'https://via.placeholder.com/800x300' }}"
                    class="w-full h-64 object-cover" alt="{{ $ticket->event->name }}">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6 text-white">
                    <h1 class="text-3xl font-bold mb-2">{{ $ticket->event->name }}</h1>
                    <div class="flex items-center space-x-4">
                        <span class="flex items-center">
                            <ion-icon name="calendar-outline" class="mr-2"></ion-icon>
                            {{ $ticket->event->date_time->format('M d, Y') }}
                        </span>
                        <span class="flex items-center">
                            <ion-icon name="time-outline" class="mr-2"></ion-icon>
                            {{ $ticket->event->date_time->format('h:i A') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Ticket Status Banner -->
            <div
                class="mb-8 p-4 rounded-xl {{ $ticket->status === 'active' ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }} border-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-full {{ $ticket->status === 'active' ? 'bg-green-200' : 'bg-red-200' }}">
                            <ion-icon name="{{ $ticket->status === 'active' ? 'checkmark-circle' : 'close-circle' }}"
                                class="text-2xl {{ $ticket->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                            </ion-icon>
                        </div>
                        <div>
                            <h3
                                class="font-semibold {{ $ticket->status === 'active' ? 'text-green-700' : 'text-red-700' }}">
                                Ticket {{ ucfirst($ticket->status) }}
                            </h3>
                            <p class="text-sm {{ $ticket->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $ticket->status === 'active' ? 'Your ticket is valid for entry' : 'This ticket has been cancelled' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-1 gap-6 mb-8">
                <!-- Event Details Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Event Details</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="p-2 rounded-lg bg-blue-50 dark:bg-blue-900 mr-3">
                                <ion-icon name="location" class="text-xl text-blue-600 dark:text-blue-400"></ion-icon>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Location</p>
                                <p class="font-medium text-gray-800 dark:text-white">{{ $ticket->event->location }}</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="p-2 rounded-lg bg-purple-50 dark:bg-purple-900 mr-3">
                                <ion-icon name="people" class="text-xl text-purple-600 dark:text-purple-400"></ion-icon>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Organizer</p>
                                <p class="font-medium text-gray-800 dark:text-white">{{ $ticket->event->organizer->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center">
                <a href="{{ route('user.bookings') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-colors duration-200">
                    <ion-icon name="arrow-back-outline" class="mr-2"></ion-icon>
                    Back to Bookings
                </a>

                @if ($ticket->status === 'active' && $ticket->event->date_time->subHours(24)->isFuture())
                    <form action="{{ route('user.bookings.cancel', $ticket) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200"
                            onclick="return confirm('Are you sure you want to cancel this ticket?')">
                            <ion-icon name="close-circle-outline" class="mr-2"></ion-icon>
                            Cancel Ticket
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
