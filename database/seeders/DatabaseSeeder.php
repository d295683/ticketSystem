<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\Ticket;
use App\Notifications\DummyNotification;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $adminRole = Role::factory()->create([
        //     'name' => 'admin',
        // ]);
        // $roles = Role::factory(25)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $adminUser = User::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        // ]);
        // $adminUser->roles()->attach($adminRole->id);

        // User::factory(100)->create();

        // $users = User::all();

        // foreach ($users as $user) {
        //     $notification = new DummyNotification([
        //         'title' => fake()->sentence(5),
        //         'body' => fake()->paragraph(3),
        //     ]);

        //     $user->notify($notification);

        //     $user->roles()->attach($roles->random(rand(1, 3))->pluck('id')->toArray());
        // }

        // Event::factory(100)->create()->each(function ($event) use ($users) {
        //     $ticketsRemaining = $event->tickets;

        //     while ($ticketsRemaining > 0 && rand(0, 100) >= 30) {
        //         $ticketsForThisReservation = rand(1, min($ticketsRemaining, 10));

        //         $reservation = Reservation::factory()->for(
        //             $users->random(),
        //             'user' // Assuming 'user' is the relationship name in Reservation model
        //         )->create([
        //             'event_id' => $event->id,
        //         ]);

        //         Ticket::factory($ticketsForThisReservation)->create([
        //             'reservation_id' => $reservation->id,
        //         ]);

        //         $ticketsRemaining -= $ticketsForThisReservation;
        //     }
        // });
        
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            EventSeeder::class,
            ReservationSeeder::class,
            TicketSeeder::class,
        ]);
    }
}
