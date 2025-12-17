<?php

namespace Database\Seeders;
use App\Models\Boat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Option 1 : Créer 10 bateaux, chacun avec un nouveau propriétaire
        Boat::factory()->count(10)->create();

        // Option 2 : Créer des bateaux pour des utilisateurs spécifiques si nécessaire
        // $admin = User::where('role', 'admin')->first();
        // Boat::factory()->count(3)->create(['user_id' => $admin->id]);
    }
}
