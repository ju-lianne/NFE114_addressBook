<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Categorie;
use App\Models\Entreprise;
use App\Models\Personne;
use App\Models\Contact;
use App\Models\Utilisateur;

class DatabaseSeeder extends Seeder
{
    public function run()
    {


        $entreprises = Entreprise::factory()->count(10)->create();

        $personnes = Personne::factory()->count(100)->create();

        $personnes->each(function($personne) {
            if (rand(0, 1)) {
                Contact::factory()->create([
                    'id' => $personne->id,
                ]);
            }

            if (rand(0, 1)) {
                Utilisateur::factory()->create([
                    'id' => $personne->id,
                ]);
            }
        });
    }
}
