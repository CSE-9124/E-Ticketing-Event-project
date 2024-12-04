@extends('layouts.app')

@section('content')
    <div class="py-10 px-5">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
                My Bookings History 🎟️
            </h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Track and manage your event tickets</p>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 dark:bg-green-800 dark:border-green-600">
                <div class="flex items-center">
                    <ion-icon name="checkmark-circle" class="text-xl text-green-500 dark:text-green-400 mr-2"></ion-icon>
                    <p class="text-green-700 dark:text-green-300">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Bookings</p>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $bookings->total() }}</h3>
                    </div>
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                        <ion-icon name="ticket" class="text-2xl text-blue-600 dark:text-blue-400"></ion-icon>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Active Tickets</p>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $bookings->where('status', 'active')->count() }}
                        </h3>
                    </div>
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                        <ion-icon name="checkmark-circle" class="text-2xl text-green-600 dark:text-green-400"></ion-icon>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Past Events</p>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $bookings->filter(function ($booking) {return $booking->event->date_time->isPast();})->count() }}
                        </h3>
                    </div>
                    <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                        <ion-icon name="time" class="text-2xl text-purple-600 dark:text-purple-400"></ion-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bookings Table -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Event Details</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Date & Time</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img class="h-10 w-10 rounded-lg object-cover"
                                                src="{{ $booking->event->event_image ? asset('storage/' . $booking->event->event_image) : 'https://via.placeholder.com/40x40' }}"
                                                alt="{{ $booking->event->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $booking->event->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                <ion-icon name="location-outline" class="align-middle"></ion-icon>
                                                {{ $booking->event->location }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        <ion-icon name="calendar-outline" class="align-middle"></ion-icon>
                                        {{ $booking->event->date_time->format('M d, Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        <ion-icon name="time-outline" class="align-middle"></ion-icon>
                                        {{ $booking->event->date_time->format('h:i A') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $booking->status === 'active'
                                        ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                                        : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('user.bookings.show', $booking) }}"
                                            class="text-yellow-500 hover:text-yellow-600 dark:hover:text-yellow-400 transition-colors duration-200">
                                            <ion-icon name="eye-outline" class="text-xl"></ion-icon>
                                        </a>
                                        @if ($booking->status === 'active' && $booking->event->date_time->subHours(24)->isFuture())
                                            <form action="{{ route('user.bookings.cancel', $booking) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-600 dark:hover:text-red-400 transition-colors duration-200">
                                                    <ion-icon name="close-circle-outline" class="text-xl"></ion-icon>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <ion-icon name="ticket-outline"
                                            class="text-6xl text-gray-400 dark:text-gray-600 mb-4"></ion-icon>
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Bookings Found
                                        </h3>
                                        <p class="text-gray-500 dark:text-gray-400 mb-4">You haven't made any bookings yet.
                                        </p>
                                        <a href="{{ route('events') }}"
                                            class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors duration-200">
                                            <ion-icon name="search-outline" class="mr-2"></ion-icon>
                                            Browse Events
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($bookings->hasPages())
            <div class="mt-6">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
@endsection
