<?php

namespace Database\Factories;

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
        return [
            'title' => $this->faker->text(20),
            'date' => $this->faker->date,
            'time' => $this->faker->time,
            'description' => $this->faker->text,
            'location' => $this->faker->text,
            'image' => 'https://picsum.photos/seed/picsum/1920/1080',
            'price' => $this->faker->randomFloat(2, 0, 99.99),
        ];
    }
}
