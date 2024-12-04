@extends('welcome')

@section('title', 'Event Catalog')

@section('content')
<div class="py-10 px-16">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Events Catalog</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Discover amazing events happening near you</p>
    </div>

    <!-- Filters Section -->
    <div class="mb-8 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <form action="{{ route('events') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    placeholder="Search events...">
            </div>

            <!-- Category Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                <select name="category" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="">All Categories</option>
                    <option value="music" {{ request('category') === 'music' ? 'selected' : '' }}>Music</option>
                    <option value="sport" {{ request('category') === 'sport' ? 'selected' : '' }}>Sport</option>
                    <option value="conference" {{ request('category') === 'conference' ? 'selected' : '' }}>Conference</option>
                    <option value="culiner" {{ request('category') === 'culiner' ? 'selected' : '' }}>Culinary</option>
                    <option value="theater" {{ request('category') === 'theater' ? 'selected' : '' }}>Theater</option>
                    <option value="festival" {{ request('category') === 'festival' ? 'selected' : '' }}>Festival</option>
                </select>
            </div>

            <!-- Date Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date</label>
                <input type="date" name="date" value="{{ request('date') }}"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>

            <!-- Sort -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort By</label>
                <select name="sort" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                    <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>

            <!-- Filter Button -->
            <div class="md:col-span-4 flex justify-end">
                <button type="submit" 
                    class="px-4 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 transition-colors duration-200">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($events as $event)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <!-- Event Image -->
                <img class="w-full h-48 object-cover" 
                    src="{{ $event->event_image ? asset('storage/' . $event->event_image) : 'https://via.placeholder.com/400x300' }}" 
                    alt="{{ $event->name }}">
                
                <!-- Event Details -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $event->name }}</h3>
                    
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
                            <span>Rp{{ number_format($event->ticket_price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('events.show', $event) }}" 
                            class="inline-flex items-center px-4 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 transition-colors duration-200">
                            <ion-icon name="eye-outline" class="mr-2"></ion-icon>
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Events Found</h3>
                <p class="text-gray-500 dark:text-gray-400">Try adjusting your search or filter criteria</p>
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