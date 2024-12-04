@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
    <div class="py-10 px-5">
        <!-- Header Section with Stats -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-semibold text-gray-900 dark:text-white mb-4">Manage Users</h1>
                <a href="{{ route('admin.users.create') }}"
                    class="px-4 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200 flex items-center gap-2">
                    <ion-icon name="person-add-outline" class="text-xl"></ion-icon>
                    <span>Add New User</span>
                </a>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 mr-4">
                            <ion-icon name="people" class="text-xl text-blue-600 dark:text-blue-400"></ion-icon>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Users</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $users->total() }}</p>
                        </div>
                    </div>
                </div>

                @php
                    $roleStats = $users->groupBy('role')->map->count();
                @endphp

                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 mr-4">
                            <ion-icon name="shield" class="text-xl text-red-600 dark:text-red-400"></ion-icon>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Admins</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $roleStats['admin'] ?? 0 }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 mr-4">
                            <ion-icon name="briefcase" class="text-xl text-yellow-600 dark:text-yellow-400"></ion-icon>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Organizers</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $roleStats['event_organizer'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 mr-4">
                            <ion-icon name="person" class="text-xl text-green-600 dark:text-green-400"></ion-icon>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Regular Users</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $roleStats['user'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
            <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by name or email..."
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white pr-10">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <ion-icon name="search" class="text-gray-400"></ion-icon>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Role</label>
                    <select name="role"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="all">All Roles</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="event_organizer" {{ request('role') === 'event_organizer' ? 'selected' : '' }}>Event
                            Organizer</option>
                        <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort by</label>
                    <select name="sort"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>Date Created
                        </option>
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name</option>
                        <option value="email" {{ request('sort') === 'email' ? 'selected' : '' }}>Email</option>
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

        <!-- Session Messages -->
        @if (session('sukses'))
            <div id="alert-success"
                class="flex items-center p-4 mb-4 rounded-lg bg-green-50 border-2 border-green-800 dark:bg-gray-800 dark:border-green-400"
                role="alert">
                <div class="ms-3 text-sm font-medium text-green-800 dark:text-green-400">
                    {{ session('sukses') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @elseif (session('delete'))
            <div id="alert-delete"
                class="flex items-center p-4 mb-4 rounded-lg bg-red-50 border-2 border-red-800 dark:bg-gray-800 dark:border-red-400"
                role="alert">
                <div class="ms-3 text-sm font-medium text-red-800 dark:text-red-400">
                    {{ session('delete') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-delete" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @elseif (session('update'))
            <div id="alert-update"
                class="flex items-center p-4 mb-4 rounded-lg bg-blue-50 border-2 border-blue-800 dark:bg-gray-800 dark:border-blue-400"
                role="alert">
                <div class="ms-3 text-sm font-medium text-blue-800 dark:text-blue-400">
                    {{ session('update') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-update" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Search and Filter Section -->
        {{-- <div class="mb-6 flex gap-4">
            <div class="flex-1">
                <form class="flex gap-2">
                    <input type="text" name="search" placeholder="Search users..."
                        class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500">
                    <button type="submit"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500">
                        Search
                    </button>
                </form>
            </div>
        </div> --}}

        <!-- Users Table -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-2xl">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Name</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Email</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Role</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Created At</th>
                        <th
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2 text-sm font-medium text-gray-900 dark:text-white">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center dark:bg-gray-700">
                                        <span class="text-sm font-medium text-gray-600 dark:text-gray-800">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 dark:text-gray-300">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span @class([
                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                    'bg-red-100 text-red-800' => $user->role === 'admin',
                                    'bg-green-100 text-green-800' => $user->role === 'event_organizer',
                                    'bg-blue-100 text-blue-800' => $user->role === 'user',
                                ])>
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td
                                class="px-6
                                    py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <a href="#"
                                        onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 inline-flex items-center">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 inline-flex items-center"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500 dark:text-gray-300">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>

        <!-- Edit User Modal -->
        <div id="editUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden"
            x-data="{ open: false }">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Edit User</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="edit_name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" id="edit_name"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="edit_email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="edit_email"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            required>
                    </div>

                    <!-- Role -->
                    <div class="mb-4">
                        <label for="edit_role"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                        <select name="role" id="edit_role"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="admin">Admin</option>
                            <option value="event_organizer">Event Organizer</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-4 mt-6">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id, name, email, role) {
            // Set form action
            document.getElementById('editUserForm').action = `/admin/users/${id}/update`;

            // Set form values
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;

            // Show modal
            document.getElementById('editUserModal').classList.remove('hidden');
        }

        function closeEditModal() {
            // Hide modal
            document.getElementById('editUserModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editUserModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>

    @push('scripts')
        <script>
            // Add any JavaScript for interactivity
            document.addEventListener('DOMContentLoaded', function() {
                // Auto-submit form when sort or role changes
                document.querySelectorAll('select[name="role"], select[name="sort"]').forEach(select => {
                    select.addEventListener('change', () => {
                        select.closest('form').submit();
                    });
                });
            });
        </script>
    @endpush
@endsection
