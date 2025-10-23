<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Day;
use App\Models\Level;
use App\Models\Centre;
use App\Models\School;
use App\Models\SchoolYear;
use App\Models\Nationality;
use App\Models\OriginSchool;
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
        Level::create(['level' => 'sixième', 'code' => '6eme']);
        Level::create(['level' => 'cinquième', 'code' => '5eme']);
        Level::create(['level' => 'quatrième', 'code' => '4eme']);
        Level::create(['level' => 'troisième', 'code' => '3eme']);
        Level::create(['level' => 'séconde', 'code' => '2nde']);
        Level::create(['level' => 'première', 'code' => '1ere']);
        Level::create(['level' => 'terminale', 'code' => 'Tle']);


        // Get School Year Default
        SchoolYear::create(['year' => '2025-2026']);


        // Get Naotionalities Default
        Nationality::create(['libelle' => 'ivoirienne']);


        // Get Origine School Student
        OriginSchool::create(['libelle' => 'groupe scolaire la rochelle']);


        // Get School Default
        School::create([
            'school' => 'centre thalith',
            'code' => '02501',
            'autorisation' => '025CTR01',
            'email' => 'centrethalith@gmail.com',
            'phon' => '0143260012',
            'ville' => 'abidjan',
        ]);



        // Get To First Center
        Centre::create([
            'libelle' => 'centre 1',
            'school_id' => 1,
            'school_year_id' => 1,
        ]);

        // Gestion dee Role
        Day::create(['libelle' => 'Lundi']);
        Day::create(['libelle' => 'Mardi']);
        Day::create(['libelle' => 'Mercredi']);
        Day::create(['libelle' => 'Jeudi']);
        Day::create(['libelle' => 'Vendredi']);
        Day::create(['libelle' => 'Samedi']);

        // User::factory(1)->create();
        User::factory()->create();
    }
}
