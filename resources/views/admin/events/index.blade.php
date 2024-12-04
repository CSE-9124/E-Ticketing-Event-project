@extends('layouts.app')

@section('title', 'Manage Events')

@section('content')
    <div class="py-10 px-5">
        <!-- Header Section with Stats -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Manage Events</h1>
                <a href="{{ route('admin.events.create') }}"
                    class="px-4 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200 flex items-center gap-1">
                    <ion-icon name="add-circle-outline" class="text-xl"></ion-icon>
                    <span>Add New Event</span>
                </a>
            </div>

            <!-- Event Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @php
                    $totalEvents = $events->count();
                    $categoryStats = $events->groupBy('category')->map->count();
                @endphp

                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 mr-4">
                            <ion-icon name="calendar" class="text-xl text-yellow-600 dark:text-yellow-400"></ion-icon>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Events</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $totalEvents }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
            <form class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search events..."
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white pr-10">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <ion-icon name="search" class="text-gray-400"></ion-icon>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by
                        Category</label>
                    <select name="category"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">All Categories</option>
                        <option value="music" {{ request('category') === 'music' ? 'selected' : '' }}>Music</option>
                        <option value="sport" {{ request('category') === 'sport' ? 'selected' : '' }}>Sport</option>
                        <option value="conference" {{ request('category') === 'conference' ? 'selected' : '' }}>Conference
                        </option>
                        <option value="culiner" {{ request('category') === 'culiner' ? 'selected' : '' }}>Culinary</option>
                        <option value="theater" {{ request('category') === 'theater' ? 'selected' : '' }}>Theater</option>
                        <option value="festival" {{ request('category') === 'festival' ? 'selected' : '' }}>Festival
                        </option>
                        <option value="others" {{ request('category') === 'others' ? 'selected' : '' }}>Others</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="w-full px-4 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 transition-colors duration-200">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <!-- Events Table -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Event</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Category</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Organizer</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Date & Time</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Location</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Price</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Quota</th>
                        <th
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($events as $event)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-16">
                                        <img class="h-10 w-16 rounded-lg object-cover"
                                            src="{{ $event->event_image ? asset('storage/' . $event->event_image) : 'https://via.placeholder.com/400x300' }}"
                                            alt="{{ $event->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $event->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ Str::limit($event->description, 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span @class([
                                    'px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full',
                                    'bg-purple-100 text-purple-800' => $event->category === 'music',
                                    'bg-blue-100 text-blue-800' => $event->category === 'sport',
                                    'bg-yellow-100 text-yellow-800' => $event->category === 'conference',
                                    'bg-green-100 text-green-800' => $event->category === 'culiner',
                                    'bg-red-100 text-red-800' => $event->category === 'theater',
                                    'bg-pink-100 text-pink-800' => $event->category === 'festival',
                                    'bg-gray-100 text-gray-800' => $event->category === 'others',
                                ])>
                                    {{ ucfirst($event->category) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $event->organizer->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    {{ $event->date_time->format('M d, Y') }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $event->date_time->format('H:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $event->location }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    Rp{{ number_format($event->ticket_price, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $event->ticket_quota }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('admin.events.edit', $event->id) }}"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m14.3 4.8 2.9 2.9M7 7H4a1 1 0 0 0-1 1v10c0 .6.4 1 1 1h11c.6 0 1-.4 1-1v-4.5m2.4-10a2 2 0 0 1 0 3l-6.8 6.8L8 14l.7-3.6 6.9-6.8a2 2 0 0 1 2.8 0Z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.events.delete', $event->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                            onclick="return confirm('Are you sure you want to delete this event?')">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $events->links() }}
        </div>
    </div>
@endsection
