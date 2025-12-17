<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Boat;
use App\Models\Trip;
use App\Models\Booking;
use App\Models\FishingLog;
use App\Models\FishingLogPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create()->each(function ($user) {
            
            // Création du bateau
            $boat = Boat::factory()->create(['user_id' => $user->id]);

            // Création d'un voyage pour ce bateau
            $trip = Trip::factory()->create([
                'user_id' => $user->id,
                'boat_id' => $boat->idBoat // On utilise idBoat car défini dans ton modèle
            ]);

            // 2. Créer des réservations pour ce voyage (par d'autres utilisateurs)
            Booking::factory(3)->create([
                'trip_id' => $trip->idTrip
            ]);

            // 3. Créer un carnet de pêche pour l'utilisateur avec 5 prises
            $log = FishingLog::factory()->create(['user_id' => $user->id]);
            FishingLogPage::factory(5)->create(['fishing_log_id' => $log->idFishingLog]);
        });
    }
}
