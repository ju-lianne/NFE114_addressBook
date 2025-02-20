<?php

namespace Tests\Feature;

use App\Livewire\CreateContact;
use App\Models\Entreprise;
use App\Models\Categorie;
use App\Models\Personne;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateContactLivewireTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_contact_validation_and_submission()
    {
        $entreprise = Entreprise::factory()->create();
        $categorie = Categorie::factory()->create();


        Livewire::test(CreateContact::class)
            ->set('name', 'John')
            ->set('surname', 'Doe')
            ->set('phone', '0102030405')
            ->set('email', 'john@example.com')
            ->set('entreprise_id', $entreprise->id)
            ->set('categorie_id', $categorie->id)
            ->call('submit')
            ->assertSee('Contact créé avec succès.');

        $this->assertDatabaseHas('personnes', [
            'prenom'        => 'John',
            'nom'           => 'Doe',
            'courriel'      => 'john@example.com',
            'entreprise_id' => $entreprise->id,
        ]);

        $person = Personne::where('prenom', 'John')->where('nom', 'Doe')->first();
        $this->assertDatabaseHas('contacts', [
            'id'           => $person->id,
            'categorie_id' => $categorie->id,
        ]);
    }
}
