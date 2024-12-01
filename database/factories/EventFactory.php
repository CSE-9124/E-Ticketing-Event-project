<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['music', 'sport', 'conference', 'culiner', 'theater', 'festival', 'others'];
        
        return [
            'name' => $this->faker->catchPhrase(),
            'description' => $this->faker->paragraphs(3, true),
            'date_time' => $this->faker->dateTimeBetween('now', '+1 year'),
            'location' => $this->faker->city(),
            'category' => $this->faker->randomElement($categories),
            'ticket_price' => $this->faker->numberBetween(50000, 2000000),
            'ticket_quota' => $this->faker->numberBetween(50, 1000),
            'event_image' => null, // You could add default images if needed
            'organizer_id' => User::where('role', 'event_organizer')->inRandomOrder()->first()->id
        ];
    }

    // State for upcoming events
    public function upcoming(): static
    {
        return $this->state(fn (array $attributes) => [
            'date_time' => $this->faker->dateTimeBetween('now', '+6 months'),
        ]);
    }

    // State for featured events
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'ticket_quota' => $this->faker->numberBetween(500, 2000),
        ]);
    }
}
