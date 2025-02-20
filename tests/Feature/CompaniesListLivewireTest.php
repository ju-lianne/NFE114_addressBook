<?php

namespace Tests\Feature;

use App\Livewire\CompaniesList;
use App\Models\Entreprise;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CompaniesListLivewireTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_renders_initially_without_companies()
    {
        Livewire::test(CompaniesList::class)
            ->assertSee('Aucune entreprise trouvée.');
    }
    public function test_search_filters_companies()
    {
        Entreprise::factory()->create(['nom' => 'Alpha Corp']);
        Entreprise::factory()->create(['nom' => 'Beta Industries']);

        Livewire::test(CompaniesList::class)
            ->set('search', 'Alpha')
            ->assertSee('Alpha Corp')
            ->assertDontSee('Beta Industries');

        Livewire::test(CompaniesList::class)
            ->set('search', 'Industries')
            ->assertSee('Beta Industries')
            ->assertDontSee('Alpha Corp');

        Livewire::test(CompaniesList::class)
            ->set('search', 'Gamma')
            ->assertSee('Aucune entreprise trouvée.');
    }
}
