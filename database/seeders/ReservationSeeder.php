<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all();
        $events = Event::all();

        $events->each(function ($event) use ($users) {
            $ticketsRemaining = $event->tickets;

            while ($ticketsRemaining > 0 && rand(0, 100) >= 30) {
                $ticketsForThisReservation = rand(1, min($ticketsRemaining, 10));

                $reservation = Reservation::factory()->for(
                    $users->random(),
                    'user' // Assuming 'user' is the relationship name in Reservation model
                )->create([
                    'event_id' => $event->id,
                ]);

                Ticket::factory($ticketsForThisReservation)->create([
                    'reservation_id' => $reservation->id,
                ]);

                $ticketsRemaining -= $ticketsForThisReservation;
            }
        });
    }
}
