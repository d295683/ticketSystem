<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Notifications\DummyNotification;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        $users = User::factory(10)->create();
        Event::factory(10)->create();

        foreach ($users as $user) {
            $notification = new DummyNotification([
                'title' => fake()->sentence(5),
                'body' => fake()->paragraph(3),
            ]);

            $user->notify($notification);
        }
    }
}
