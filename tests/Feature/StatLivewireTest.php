<?php

namespace Tests\Feature;

use App\Livewire\Stats;
use App\Models\Contact;
use App\Models\Entreprise;
use App\Models\Personne;
use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StatLivewireTest extends TestCase
{
    use RefreshDatabase;

    public function test_stats_component_without_authenticated_user()
    {
        $persons = Personne::factory()->count(5)->create();
        foreach ($persons as $person) {
            Contact::factory()->create([
                'id' => $person->id,
            ]);
        }

        Entreprise::factory()->count(3)->create();

        $component = Livewire::test(Stats::class);

        $component->assertSet('contactsCount', 5)
            ->assertSet('entreprisesCount', 3)
            ->assertSet('favoritesCount', 0);

        $component->assertSee('5')
            ->assertSee('3')
            ->assertSee('0');
    }

    public function test_stats_component_with_authenticated_user_and_favorites()
    {
        $persons = Personne::factory()->count(7)->create();
        foreach ($persons as $person) {
            Contact::factory()->create([
                'id' => $person->id,
            ]);
        }

        Entreprise::factory()->count(4)->create();

        $user = \Mockery::mock(Utilisateur::class)->makePartial();
        $favoritesStub = new class {
            public function count() {
                return 2;
            }
        };
        $user->shouldReceive('favoris')->andReturn($favoritesStub);

        $this->actingAs($user);

        $component = Livewire::test(Stats::class);

        $component->assertSet('contactsCount', 7)
            ->assertSet('entreprisesCount', 4)
            ->assertSet('favoritesCount', 2);

        $component->assertSee('7')
            ->assertSee('4')
            ->assertSee('2');
    }
}
