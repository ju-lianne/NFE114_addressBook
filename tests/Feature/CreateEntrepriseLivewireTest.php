<?php

namespace Tests\Feature;

use App\Livewire\CreateEntreprise;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateEntrepriseLivewireTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_entreprise_validation_and_submission()
    {
        Livewire::test(CreateEntreprise::class)
            ->set('nom', 'New Company')
            ->call('submit')
            ->assertSee('Entreprise créée avec succès.');

        $this->assertDatabaseHas('entreprises', [
            'nom' => 'New Company'
        ]);
    }
}
