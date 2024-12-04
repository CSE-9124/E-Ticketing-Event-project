{{-- resources/views/admin/reports/sales.blade.php --}}
@extends('layouts.app')

@section('title', 'Sales Report')

@section('content')
    <div class="py-10 px-5">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Sales Report</h1>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue</h3>
                <p class="text-2xl font-bold text-yellow-400">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Tickets</h3>
                <p class="text-2xl font-bold text-yellow-400">{{ $totalTickets }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Events</h3>
                <p class="text-2xl font-bold text-yellow-400">{{ $totalEvents }}</p>
            </div>
        </div>

        <!-- Daily Sales Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Daily Sales (Last 30 Days)</h2>
            <canvas id="dailySalesChart" class="w-full h-64"></canvas>
        </div>

        <!-- Sales Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Sales by Event</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Event Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Active Tickets</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Cancelled</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Total Sales</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Created Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($reports as $report)
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $report->event_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $report->active_tickets }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $report->cancelled_tickets }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        Rp{{ number_format($report->total_sales, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($report->created_at)->format('M d, Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('dailySalesChart').getContext('2d');
                const dailySales = @json($dailySales);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dailySales.map(item => item.date),
                        datasets: [{
                            label: 'Daily Revenue (Rp)',
                            data: dailySales.map(item => item.daily_revenue),
                            borderColor: 'rgb(250, 204, 21)',
                            tension: 0.1
                        }, {
                            label: 'Tickets Sold',
                            data: dailySales.map(item => item.tickets_sold),
                            borderColor: 'rgb(34, 197, 94)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
