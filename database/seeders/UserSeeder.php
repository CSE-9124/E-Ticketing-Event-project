<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create event organizer
        User::factory()->create([
            'name' => 'Event Organizer',
            'email' => 'organizer@example.com',
            'password' => Hash::make('organizer123'),
            'role' => 'event_organizer',
        ]);

        // Create regular user
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        // Create random users
        User::factory(5)->user()->create();
        User::factory(3)->eventOrganizer()->create();
        User::factory(2)->admin()->create();
    }
}
