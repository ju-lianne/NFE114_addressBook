<?php

namespace Tests\Feature;

use App\Livewire\ContactsList;
use App\Models\Categories;
use App\Models\Contacts;
use App\Models\Personnes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ContactsListLivewireTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_renders_initially_without_contacts()
    {
        Livewire::test(ContactsList::class)
            ->assertSee('Aucun contact trouvé.');
    }

    public function test_search_filters_contacts()
    {
        $category = Categories::factory()->create([
            'libelle' => 'Test Catégorie'
        ]);

        $personne = Personnes::factory()->create([
            'nom'       => 'Doe',
            'prenom'    => 'John',
            'telephone' => '0102030405',
            'courriel'  => 'john.doe@example.com'
        ]);

        Contacts::factory()->create([
            'id'           => $personne->id,
            'categorie_id' => $category->id,
        ]);

        Livewire::test(ContactsList::class)
            ->set('search', 'John')
            ->assertDontSee('Aucun contact trouvé.')
            ->assertSee('John')
            ->assertSee('Doe');

        Livewire::test(ContactsList::class)
            ->set('search', 'Inexistant')
            ->assertSee('Aucun contact trouvé.');
    }

    public function test_filter_by_single_category()
    {
        $category1 = Categories::factory()->create(['libelle' => 'Category A']);
        $category2 = Categories::factory()->create(['libelle' => 'Category B']);

        $person1 = Personnes::factory()->create([
            'nom'    => 'Smith',
            'prenom' => 'Alice'
        ]);
        Contacts::factory()->create([
            'id'           => $person1->id,
            'categorie_id' => $category1->id,
        ]);

        $person2 = Personnes::factory()->create([
            'nom'    => 'Jones',
            'prenom' => 'Bob'
        ]);
        Contacts::factory()->create([
            'id'           => $person2->id,
            'categorie_id' => $category2->id,
        ]);

        Livewire::test(ContactsList::class)
            ->set('selectedCategories', [$category1->id])
            ->assertSee('Alice')
            ->assertDontSee('Bob');

        Livewire::test(ContactsList::class)
            ->set('selectedCategories', [$category2->id])
            ->assertSee('Bob')
            ->assertDontSee('Alice');
    }

    public function test_filter_by_multiple_categories()
    {
        $categoryA = Categories::factory()->create(['libelle' => 'Category A']);
        $categoryB = Categories::factory()->create(['libelle' => 'Category B']);

        $personA = Personnes::factory()->create([
            'nom'    => 'Alpha',
            'prenom' => 'Anna'
        ]);
        Contacts::factory()->create([
            'id'           => $personA->id,
            'categorie_id' => $categoryA->id,
        ]);

        $personB = Personnes::factory()->create([
            'nom'    => 'Beta',
            'prenom' => 'Brian'
        ]);
        Contacts::factory()->create([
            'id'           => $personB->id,
            'categorie_id' => $categoryB->id,
        ]);

        $personC = Personnes::factory()->create([
            'nom'    => 'Gamma',
            'prenom' => 'Charlie'
        ]);
        Contacts::factory()->create([
            'id'           => $personC->id,
            'categorie_id' => null,
        ]);

        Livewire::test(ContactsList::class)
            ->set('selectedCategories', [$categoryA->id, $categoryB->id])
            ->assertSee('Anna')
            ->assertSee('Brian')
            ->assertDontSee('Charlie');
    }

    public function test_search_and_filter_combination()
    {
        $category1 = Categories::factory()->create(['libelle' => 'Category A']);
        $category2 = Categories::factory()->create(['libelle' => 'Category B']);

        $person1 = Personnes::factory()->create([
            'nom'    => 'Doe',
            'prenom' => 'John'
        ]);
        Contacts::factory()->create([
            'id'           => $person1->id,
            'categorie_id' => $category1->id,
        ]);

        $person2 = Personnes::factory()->create([
            'nom'    => 'Smith',
            'prenom' => 'Jane'
        ]);
        Contacts::factory()->create([
            'id'           => $person2->id,
            'categorie_id' => $category2->id,
        ]);

        Livewire::test(ContactsList::class)
            ->set('search', 'John')
            ->set('selectedCategories', [$category1->id])
            ->assertSee('John')
            ->assertDontSee('Jane');

        Livewire::test(ContactsList::class)
            ->set('search', 'Smith')
            ->set('selectedCategories', [$category1->id])
            ->assertSee('Aucun contact trouvé.');
    }
}
