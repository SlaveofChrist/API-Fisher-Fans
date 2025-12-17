<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Boat>
 */
class BoatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->words(3, true),
            'description'       => fake()->paragraph(),
            'brand'             => fake()->company(),
            'manufacturingYear' => fake()->year(),
            'homePort'          => fake()->city(),
            
            // Enums basés sur ton modèle
            'permitType'        => fake()->randomElement(['COTIER', 'FLUVIAL']),
            'boatType'          => fake()->randomElement(['OPEN', 'CABINE', 'CATAMARAN', 'VOILIER', 'JETSKI', 'CANOE']),
            'engineType'        => fake()->randomElement(['DIESEL', 'ESSENCE', 'AUCUN']),
            
            // Tableau d'équipements (Casté en JSON en base)
            'equipments'        => fake()->randomElements(
                ['SONDEUR', 'VIVIER', 'ECHELLE', 'GPS', 'PORTECANNES', 'RADIO_VHF'], 
                fake()->numberBetween(1, 4)
            ),
            
            'depositAmount'     => fake()->randomFloat(2, 500, 5000),
            'maxCapacity'       => fake()->numberBetween(2, 12),
            'numberOfBeds'      => fake()->numberBetween(0, 6),
            'enginePower'       => fake()->randomFloat(2, 5, 300),
            
            // Coordonnées GPS
            'latitude'          => fake()->latitude(),
            'longitude'         => fake()->longitude(),
            
            // Relation avec un utilisateur existant ou créé à la volée
            'user_id'           => User::factory(),
        ];
    }
}
