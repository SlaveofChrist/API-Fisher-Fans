<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'firstName' => 'Jean',
            'lastName' => 'Dupont',
            'email' => 'test@example.com',
            'status' => 'PARTICULIER',
        ]);

        // Créer 10 utilisateurs aléatoires
        User::factory(10)->create();
    }
}
