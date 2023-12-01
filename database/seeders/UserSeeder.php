<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Notifications\DummyNotification;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create(['name' => 'Test User', 'email' => 'test@example.com']);
        $adminUser = User::factory()->create(['name' => 'Admin User', 'email' => 'admin@example.com']);
        $adminUser->roles()->attach(Role::where('name', 'admin')->first()->id);
        User::factory(100)->create();

        $users = User::all();
        $roles = Role::where('name', '<>', 'admin')->get();

        foreach ($users as $user) {
            $notification = new DummyNotification(['title' => fake()->sentence(5), 'body' => fake()->paragraph(3)]);
            $user->notify($notification);
            $user->roles()->attach($roles->random(rand(1, 3))->pluck('id')->toArray());
        }
    }
}
