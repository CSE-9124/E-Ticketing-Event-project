<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all events
        $events = Event::all();
        
        // Get users with 'user' role
        $users = User::where('role', 'user')->get();

        foreach ($events as $event) {
            // Generate random number of tickets for each event
            $ticketCount = rand(1, min($event->ticket_quota, 10));
            
            // Create active tickets
            Ticket::factory()
                ->count($ticketCount * 2/3) // 2/3 of tickets are active
                ->active()
                ->create([
                    'event_id' => $event->id,
                    'user_id' => function () use ($users) {
                        return $users->random()->id;
                    }
                ]);

            // Create cancelled tickets
            Ticket::factory()
                ->count($ticketCount * 1/3) // 1/3 of tickets are cancelled
                ->cancelled()
                ->create([
                    'event_id' => $event->id,
                    'user_id' => function () use ($users) {
                        return $users->random()->id;
                    }
                ]);
        }
    }
}
