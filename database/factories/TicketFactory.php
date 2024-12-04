<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $event = Event::inRandomOrder()->first();
        $user = User::where('role', 'user')->inRandomOrder()->first();
        $bookingDate = Carbon::now()->subDays(rand(1, 30));
        
        return [
            'event_id' => $event->id,
            'user_id' => $user->id,
            'status' => $this->faker->randomElement(['pending', 'active', 'cancelled']),
            'booking_date' => $bookingDate,
            'cancel_by' => function (array $attributes) use ($bookingDate) {
                // Only set cancel_by if status is cancelled
                return $attributes['status'] === 'cancelled' 
                    ? $bookingDate->copy()->addDays(rand(1, 5))
                    : null;
            },
        ];
    }

    // State method for active tickets
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'active',
                'cancel_by' => null
            ];
        });
    }

    // State method for cancelled tickets
    public function cancelled()
    {
        return $this->state(function (array $attributes) {
            $bookingDate = Carbon::parse($attributes['booking_date']);
            return [
                'status' => 'cancelled',
                'cancel_by' => $bookingDate->copy()->addDays(rand(1, 5))
            ];
        });
    }
}
