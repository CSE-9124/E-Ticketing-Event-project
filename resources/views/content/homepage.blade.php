@extends('welcome')

@section('content')
    <!-- Hero Content -->
    <div class="container mx-auto px-6 py-20 text-center" data-aos="fade-up">
        <h2 class="text-4xl md:text-6xl font-bold text-white mb-8">
            Discover Amazing Events
        </h2>

        <!-- Welcome Text -->
        <div class="max-w-2xl mx-auto mb-16" data-aos="fade-up" data-aos-delay="200">
            <p class="text-xl text-white">
                Welcome to our event platform. Explore amazing events happening around you!
            </p>
        </div>
    </div>

    <!-- Popular Events Section -->
    <div class="container mx-auto px-6 pb-20">
        <h2 class="text-3xl font-bold text-white mb-8" data-aos="fade-up">Popular Events</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($popularEvents as $event)
                <div class="bg-white/10 backdrop-blur-lg rounded-xl overflow-hidden" data-aos="fade-up"
                    data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative h-48">
                        <img class="w-full h-full object-cover"
                            src="{{ $event->event_image ? asset('storage/' . $event->event_image) : 'https://via.placeholder.com/400x300' }}"
                            alt="{{ $event->name }}">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">{{ $event->name }}</h3>
                        <p class="text-gray-400 mb-4">{{ $event->date_time->format('M d, Y') }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-yellow-400">{{ $event->price_range }}</span>
                            <a href="{{ route('events.show', $event->id) }}"
                                class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg hover:bg-yellow-500 transition-colors duration-300">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Latest Events Section -->
    <div class="container mx-auto px-6 pb-20">
        <h2 class="text-3xl font-bold text-white mb-8" data-aos="fade-up">Latest Events</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($latestEvents as $event)
                <div class="bg-white/10 backdrop-blur-lg rounded-xl overflow-hidden" data-aos="fade-up"
                    data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative h-48">
                        <img class="w-full h-full object-cover"
                            src="{{ $event->event_image ? asset('storage/' . $event->event_image) : 'https://via.placeholder.com/400x300' }}"
                            alt="{{ $event->name }}">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">{{ $event->name }}</h3>
                        <p class="text-gray-400 mb-4">{{ $event->date_time->format('M d, Y') }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-yellow-400">{{ $event->price_range }}</span>
                            <a href="{{ route('events.show', $event->id) }}"
                                class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg hover:bg-yellow-500 transition-colors duration-300">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
