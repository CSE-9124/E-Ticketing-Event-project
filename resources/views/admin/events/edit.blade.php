@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
    <div class="py-20 px-5">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Edit Event</h1>
            <a href="{{ route('admin.events') }}"
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                Back to Events
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Current Image Preview -->
                @if($event->event_image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Current Image:</p>
                        <img src="{{ asset('storage/' . $event->event_image) }}" 
                            alt="{{ $event->name }}" 
                            class="w-32 h-32 object-cover rounded-lg">
                    </div>
                @endif

                <!-- Event Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Event Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $event->name) }}"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
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
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
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
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
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
                        <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            required>
                        @error('location')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ticket Price -->
                    <div class="mb-6">
                        <label for="ticket_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Ticket Price (Rp)
                        </label>
                        <input type="number" name="ticket_price" id="ticket_price" 
                            value="{{ old('ticket_price', $event->ticket_price) }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            min="0" step="0.01" required>
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
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            min="1" required>
                        @error('ticket_quota')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Event Image -->
                <div class="mb-6">
                    <label for="event_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Update Event Image
                    </label>
                    <input type="file" name="event_image" id="event_image" accept="image/*"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Leave empty to keep current image</p>
                    @error('event_image')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
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