<?php

namespace Database\Seeders;

use App\Models\ROle;
use App\Models\User;
use App\Models\Level;
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

        // Gestion dee Role
        Role::create(['libelle' => 'admin']);
        Role::create(['libelle' => 'directeur']);
        Role::create(['libelle' => 'superviseur']);
        Role::create(['libelle' => 'enseignant']);
        Role::create(['libelle' => 'comptable']);
        Role::create(['libelle' => 'secretaire']);


        // Get Level Default
        Level::create(['libelle' => 'sixième', 'code' => '6eme']);
        Level::create(['libelle' => 'cinquième', 'code' => '5eme']);
        Level::create(['libelle' => 'quatrième', 'code' => '4eme']);
        Level::create(['libelle' => 'troisième', 'code' => '3eme']);
        Level::create(['libelle' => 'séconde', 'code' => '2nde']);
        Level::create(['libelle' => 'première', 'code' => '1ere']);
        Level::create(['libelle' => 'terminale', 'code' => 'Tle']);


        // User::factory(1)->create();
        User::factory()->create();
    }
}
