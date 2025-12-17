<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lastName' => fake()->lastName(),
            'firstName' => fake()->firstName(),
            'birthDate' => fake()->date('Y-m-d', '-18 years'), // Utilisateurs majeurs
            'email' => fake()->unique()->safeEmail(),
            'phoneNumber' => fake()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'postalCode' => fake()->postcode(),
            'city' => fake()->city(),
            'status' => fake()->randomElement(['PARTICULIER', 'PROFESSIONNEL']),
            'spokenLanguages' => fake()->randomElements(['Francais', 'Anglais', 'Espagnol', 'Allemand'], 2),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
