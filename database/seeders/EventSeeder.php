<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create featured upcoming events
        Event::factory()
            ->count(5)
            ->featured()
            ->upcoming()
            ->create();

        // Create regular events
        Event::factory()
            ->count(15)
            ->create();

        // Create events for specific organizers
        $organizers = User::where('role', 'event_organizer')->get();
        
        foreach ($organizers as $organizer) {
            Event::factory()
                ->count(3)
                ->create([
                    'organizer_id' => $organizer->id,
                ]);
        }
    }
}
