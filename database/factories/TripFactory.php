<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Boat;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'practicalInformation' => fake()->text(),
            'tripType' => fake()->randomElement(['JOURNALIERE', 'RECURRENTE']),
            'priceType' => fake()->randomElement(['GLOBAL', 'PAR_PERSONNE']),
            'passengerCount' => fake()->numberBetween(1, 12),
            'price' => fake()->randomFloat(2, 20, 500),
            'startDates' => [fake()->date()],
            'endDates' => [fake()->date()],
            'departureTimes' => [fake()->time()],
            'endTimes' => [fake()->time()],
            'user_id' => User::factory(), // Organisateur
            'boat_id' => Boat::factory(),
        ];
    }
}
