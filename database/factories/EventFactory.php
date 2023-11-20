<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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

        $tickets = $this->faker->numberBetween(0, 100);
        $ticketsSold = $this->faker->numberBetween(0, $tickets);
        $ticketsAvailable = $tickets - $ticketsSold;
        return [
            'title' => $this->faker->text(20),
            'datetime' => $this->faker->dateTimeBetween('-1 years', '+2 years'),
            'description' => $this->faker->paragraphs(rand(1, 5), true),
            'location' => $this->faker->city(),
            'image_url' => 'https://picsum.photos/seed/picsum/1920/1080',
            'tickets' => $tickets,
            // 'tickets_sold' => $ticketsSold,
            'price' => $this->faker->randomFloat(2, 0, 99.99),
        ];
    }
}
