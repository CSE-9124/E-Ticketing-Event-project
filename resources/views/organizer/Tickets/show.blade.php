@extends('layouts.app')

@section('title', 'Event Tickets Details')

@section('content')
    <div class="py-10 px-5">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                    Tickets for: {{ $event->name }}
                </h1>
                <a href="{{ route('organizer.tickets') }}"
                    class="px-4 py-2 text-gray-700 rounded-lg hover:text-yellow-400 dark:text-gray-300 dark:hover:text-yellow-400 transition-colors duration-200">
                    <ion-icon name="arrow-back-circle-outline" class="text-[2rem]"></ion-icon>
                </a>
            </div>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Event Date: {{ $event->date_time->format('M d, Y H:i A') }}
            </p>
        </div>

        <!-- Session Messages -->
        @if (session('success'))
            <div id="alert-success"
                class="flex items-center p-4 mb-4 rounded-lg bg-green-50 border-2 border-green-800 dark:bg-gray-800 dark:border-green-400">
                <div class="ms-3 text-sm font-medium text-green-800 dark:text-green-400">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-success">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Event Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Tickets</h3>
                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $event->ticket_quota }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Tickets</h3>
                <p class="text-2xl font-semibold text-green-600">{{ $event->tickets->where('status', 'active')->count() }}
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Cancelled Tickets</h3>
                <p class="text-2xl font-semibold text-red-600">{{ $event->tickets->where('status', 'cancelled')->count() }}
                </p>
            </div>
        </div>

        <!-- Tickets Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            User</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Booking Date</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Status</th>
                        <th
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($event->tickets as $ticket)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $ticket->user->name }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $ticket->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    {{ $ticket->booking_date->format('M d, Y') }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $ticket->booking_date->format('H:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $ticket->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    @if ($ticket->status === 'pending')
                                        <form action="{{ route('organizer.tickets.approve', $ticket->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="text-green-600 hover:text-green-900">Approve</button>
                                        </form>
                                        <form action="{{ route('organizer.tickets.cancel', $ticket->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-900">Cancel</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
