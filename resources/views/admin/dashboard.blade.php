@extends('layouts/app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="px-5 py-10">
        {{-- Welcome Section --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Welcome back, Admin!</h1>
            <p class="mt-1 text-gray-600 dark:text-gray-400">Here's what's happening with your platform today.</p>
        </div>

        {{-- Stats Overview --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Total Users Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                        <ion-icon name="people" class="text-2xl text-blue-600 dark:text-blue-400"></ion-icon>
                    </div>
                    <span
                        class="px-3 py-1 text-xs text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900 rounded-full">Users</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-700 dark:text-gray-300">{{ $totalUsers }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Users</p>
            </div>

            {{-- Total Organizers Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                        <ion-icon name="briefcase" class="text-2xl text-yellow-600 dark:text-yellow-400"></ion-icon>
                    </div>
                    <span
                        class="px-3 py-1 text-xs text-yellow-600 dark:text-yellow-400 bg-yellow-100 dark:bg-yellow-900 rounded-full">Organizers</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-700 dark:text-gray-300">{{ $totalOrganizers }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Event Organizers</p>
            </div>

            {{-- Total Events Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                        <ion-icon name="calendar" class="text-2xl text-green-600 dark:text-green-400"></ion-icon>
                    </div>
                    <span
                        class="px-3 py-1 text-xs text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900 rounded-full">Events</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-700 dark:text-gray-300">{{ $totalEvents }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Events</p>
            </div>

            {{-- Total Revenue Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                        <ion-icon name="cash" class="text-2xl text-purple-600 dark:text-purple-400"></ion-icon>
                    </div>
                    <span
                        class="px-3 py-1 text-xs text-purple-600 dark:text-purple-400 bg-purple-100 dark:bg-purple-900 rounded-full">Revenue</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-700 dark:text-gray-300">
                    Rp{{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Revenue</p>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.users.create') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 mr-4">
                        <ion-icon name="person-add" class="text-xl text-blue-600 dark:text-blue-400"></ion-icon>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300">Add User</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Create new user account</p>
                    </div>
                </a>

                <a href="{{ route('admin.events.create') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 mr-4">
                        <ion-icon name="add-circle" class="text-2xl text-yellow-600 dark:text-yellow-400"></ion-icon>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300">Add Event</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Create new event</p>
                    </div>
                </a>

                <a href="{{ route('admin.reports.sales') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 mr-4">
                        <ion-icon name="bar-chart" class="text-xl text-green-600 dark:text-green-400"></ion-icon>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300">Sales Report</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">View sales analytics</p>
                    </div>
                </a>

                <a href="{{ route('admin.reports.user_activity') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 mr-4">
                        <ion-icon name="pulse" class="text-xl text-purple-600 dark:text-purple-400"></ion-icon>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300">User Activity</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Monitor user actions</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
