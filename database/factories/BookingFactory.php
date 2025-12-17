<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dateBooking' => fake()->date(),
            'numberOfSeats' => fake()->numberBetween(1, 5),
            'totalPrice' => fake()->randomFloat(2, 50, 1000),
            'user_id' => User::factory(),
            'trip_id' => Trip::factory(),
        ];
    }
}
