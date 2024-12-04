@extends('layouts/app')

@section('content')
<div class="py-10 px-5">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
            Welcome back, {{ auth()->user()->name }}! 👋
        </h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Here's your personalized dashboard overview</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Bookings Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                    <ion-icon name="ticket-outline" class="text-2xl text-blue-600 dark:text-blue-400"></ion-icon>
                </div>
                <span class="px-3 py-1 text-xs text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900 rounded-full">Bookings</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-300">0</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Active Bookings</p>
        </div>

        <!-- Favorites Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-full bg-red-100 dark:bg-red-900">
                    <ion-icon name="heart-outline" class="text-2xl text-red-600 dark:text-red-400"></ion-icon>
                </div>
                <span class="px-3 py-1 text-xs text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900 rounded-full">Favorites</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-300">0</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Saved Events</p>
        </div>

        <!-- Profile Status Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                    <ion-icon name="person-outline" class="text-2xl text-green-600 dark:text-green-400"></ion-icon>
                </div>
                <span class="px-3 py-1 text-xs text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900 rounded-full">Profile</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-300">Active</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Account Status</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="{{ route('events') }}" class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 mr-4">
                    <ion-icon name="calendar-outline" class="text-xl text-yellow-600 dark:text-yellow-400"></ion-icon>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300">Browse Events</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Discover upcoming events</p>
                </div>
            </a>

            <a href="{{ route('user.bookings') }}" class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 mr-4">
                    <ion-icon name="time-outline" class="text-xl text-purple-600 dark:text-purple-400"></ion-icon>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300">My Bookings</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">View your ticket history</p>
                </div>
            </a>

            <a href="{{ route('user.favorites') }}" class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                <div class="p-3 rounded-full bg-pink-100 dark:bg-pink-900 mr-4">
                    <ion-icon name="heart-outline" class="text-xl text-pink-600 dark:text-pink-400"></ion-icon>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300">Favorites</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Manage saved events</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection