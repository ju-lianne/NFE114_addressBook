<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
use App\Models\Categories;
use App\Models\Entreprises;
use App\Models\Personnes;
use App\Models\Contacts;
use App\Models\Utilisateurs;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $roles = collect(['admin', 'manager', 'user'])->map(function($roleName) {
            return Roles::create(['libelle' => $roleName]);
        });

        $categories = collect(['VIP', 'Standard', 'Prospect', 'Fidèle', 'Nouveau'])->map(function($catName) {
            return Categories::create(['libelle' => $catName]);
        });

        $entreprises = Entreprises::factory()->count(10)->create();

        $personnes = Personnes::factory()->count(100)->create();

        $personnes->each(function($personne) {
            if (rand(0, 1)) {
                Contacts::factory()->create([
                    'id' => $personne->id,
                ]);
            }

            if (rand(0, 1)) {
                Utilisateurs::factory()->create([
                    'id' => $personne->id,
                ]);
            }
        });
    }
}
