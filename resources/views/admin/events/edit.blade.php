@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
    <div class="py-20 px-5">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Edit Event</h1>
            <a href="{{ route('admin.events') }}"
                class="px-4 py-2 text-gray-700 rounded-lg hover:text-yellow-400 dark:text-gray-300 dark:hover:text-yellow-400 transition-colors duration-200">
                <ion-icon name="arrow-back-circle-outline" class="text-[2rem]"></ion-icon>
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Current Image Preview -->
                @if ($event->event_image)
                    <div class="mb-6">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Image</p>
                        <img src="{{ asset('storage/' . $event->event_image) }}" alt="{{ $event->name }}"
                            class="w-full object-cover rounded-lg">
                    </div>
                @endif

                <!-- Event Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Event Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $event->name) }}"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring-yellow-500"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring-yellow-500"
                        required>{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Date & Time -->
                    <div class="mb-6">
                        <label for="date_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Date & Time
                        </label>
                        <input type="datetime-local" name="date_time" id="date_time"
                            value="{{ old('date_time', $event->date_time->format('Y-m-d\TH:i')) }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring-yellow-500"
                            required>
                        @error('date_time')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="mb-6">
                        <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Location
                        </label>
                        <input type="text" name="location" id="location"
                            value="{{ old('location', $event->location) }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring-yellow-500"
                            required>
                        @error('location')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category -->
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Category
                        </label>
                        <select name="category" id="category"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring-yellow-500"
                            required>
                            <option value="music" {{ old('category', $event->category) == 'music' ? 'selected' : '' }}>
                                Music</option>
                            <option value="sport" {{ old('category', $event->category) == 'sport' ? 'selected' : '' }}>
                                Sport</option>
                            <option value="conference"
                                {{ old('category', $event->category) == 'conference' ? 'selected' : '' }}>Conference
                            </option>
                            <option value="culiner" {{ old('category', $event->category) == 'culiner' ? 'selected' : '' }}>
                                Culinary</option>
                            <option value="theater" {{ old('category', $event->category) == 'theater' ? 'selected' : '' }}>
                                Theater</option>
                            <option value="festival"
                                {{ old('category', $event->category) == 'festival' ? 'selected' : '' }}>Festival</option>
                            <option value="others" {{ old('category', $event->category) == 'others' ? 'selected' : '' }}>
                                Others</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Event Image -->
                    <div class="mb-6">
                        <label for="event_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Update Event Image
                        </label>
                        <input type="file" name="event_image" id="event_image" accept="image/*"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring-yellow-500">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to keep current image</p>
                        @error('event_image')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Ticket Price -->
                    <div class="mb-6">
                        <label for="ticket_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Ticket Price (Rp)
                        </label>
                        <input type="number" name="ticket_price" id="ticket_price"
                            value="{{ old('ticket_price', $event->ticket_price) }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring-yellow-500"
                            min="0" step="1000" required>
                        @error('ticket_price')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ticket Quota -->
                    <div class="mb-6">
                        <label for="ticket_quota" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Ticket Quota
                        </label>
                        <input type="number" name="ticket_quota" id="ticket_quota"
                            value="{{ old('ticket_quota', $event->ticket_quota) }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring-yellow-500"
                            min="1" required>
                        @error('ticket_quota')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-4">
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                        Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
