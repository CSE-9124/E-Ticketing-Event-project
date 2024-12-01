@extends('layouts.app')

@section('title', 'Manage Tickets')

@section('content')
    <div class="py-10 px-5">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Ticket Management</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Manage tickets for your events</p>
        </div>

        <!-- Events with Tickets Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($events as $event)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $event->name }}</h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {{ $event->date_time->format('M d, Y - H:i A') }}
                    </p>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Total Tickets: {{ $event->ticket_quota }}
                    </p>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Sold: {{ $event->tickets_count ?? 0 }}
                    </p>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Available: {{ $event->ticket_quota - ($event->tickets_count ?? 0) }}
                    </p>
                    <div class="mt-4 text-right">
                        <a href="{{ route('organizer.tickets.event', $event->id) }}" 
                            class="px-3 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-600 text-sm transition-all duration-300 ease-in-out">
                            View Details
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center text-sm text-gray-500 dark:text-gray-400">
                    No events with tickets found
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if(isset($events) && $events->hasPages())
            <div class="mt-4">
                {{ $events->links() }}
            </div>
        @endif
    </div>
@endsection