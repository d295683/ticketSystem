<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Role;
use App\Notifications\DummyNotification;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::factory()->create([
            'name' => 'admin',
        ]);
        $roles = Role::factory(25)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $adminUser->roles()->attach($adminRole->id);

        $users = User::factory(100)->create();
        Event::factory(100)->create();

        foreach ($users as $user) {
            $notification = new DummyNotification([
                'title' => fake()->sentence(5),
                'body' => fake()->paragraph(3),
            ]);

            $user->notify($notification);

            $user->roles()->attach($roles->random(rand(1, 3))->pluck('id')->toArray());
        }
    }
}
