<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FishingLog;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FishingLogPage>
 */
class FishingLogPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sizeCm' => fake()->randomFloat(2, 10, 150),
            'weightKg' => fake()->randomFloat(2, 0.5, 30),
            'fishingLocation' => fake()->city(),
            'fishingDate' => fake()->date(),
            'released' => fake()->boolean(),
            'photoUrl' => fake()->imageUrl(),
            'fishing_log_id' => FishingLog::factory(),
        ];
    }
}
