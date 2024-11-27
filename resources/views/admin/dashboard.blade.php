@extends('layouts/app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="px-5 py-20 text-center">
        <h1 class="font-bold text-3xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard Admin</h1>

        {{-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in as Admin!") }}
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="mt-8 grid lg:grid-cols-3 gap-14 text-left">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h2 class="font-semibold text-lg text-gray-800">Jumlah User</h2>
                <p class="text-2xl font-bold text-yellow-400">{{ $totalUsers }}</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h2 class="font-semibold text-lg text-gray-800">Jumlah Event Organizer</h2>
                <p class="text-2xl font-bold text-yellow-400">{{ $totalOrganizers }}</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h2 class="font-semibold text-lg text-gray-800">Jumlah Event</h2>
                <p class="text-2xl font-bold text-yellow-400">{{ $totalEvents }}</p>
            </div>
        </div>
    </div>
@endsection
