<?php

namespace Tests\Feature;

use App\Livewire\ContactsList;
use App\Models\Categorie;
use App\Models\Contact;
use App\Models\Personne;
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
        $category = Categorie::factory()->create([
            'libelle' => 'Test Catégorie'
        ]);

        $personne = Personne::factory()->create([
            'nom'       => 'Doe',
            'prenom'    => 'John',
            'telephone' => '0102030405',
            'courriel'  => 'john.doe@example.com'
        ]);

        Contact::factory()->create([
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
        $category1 = Categorie::factory()->create(['libelle' => 'Category A']);
        $category2 = Categorie::factory()->create(['libelle' => 'Category B']);

        $person1 = Personne::factory()->create([
            'nom'    => 'Smith',
            'prenom' => 'Alice'
        ]);
        Contact::factory()->create([
            'id'           => $person1->id,
            'categorie_id' => $category1->id,
        ]);

        $person2 = Personne::factory()->create([
            'nom'    => 'Jones',
            'prenom' => 'Bob'
        ]);
        Contact::factory()->create([
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
        $categoryA = Categorie::factory()->create(['libelle' => 'Category A']);
        $categoryB = Categorie::factory()->create(['libelle' => 'Category B']);

        $personA = Personne::factory()->create([
            'nom'    => 'Alpha',
            'prenom' => 'Anna'
        ]);
        Contact::factory()->create([
            'id'           => $personA->id,
            'categorie_id' => $categoryA->id,
        ]);

        $personB = Personne::factory()->create([
            'nom'    => 'Beta',
            'prenom' => 'Brian'
        ]);
        Contact::factory()->create([
            'id'           => $personB->id,
            'categorie_id' => $categoryB->id,
        ]);

        $personC = Personne::factory()->create([
            'nom'    => 'Gamma',
            'prenom' => 'Charlie'
        ]);
        Contact::factory()->create([
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
        $category1 = Categorie::factory()->create(['libelle' => 'Category A']);
        $category2 = Categorie::factory()->create(['libelle' => 'Category B']);

        $person1 = Personne::factory()->create([
            'nom'    => 'Doe',
            'prenom' => 'John'
        ]);
        Contact::factory()->create([
            'id'           => $person1->id,
            'categorie_id' => $category1->id,
        ]);

        $person2 = Personne::factory()->create([
            'nom'    => 'Smith',
            'prenom' => 'Jane'
        ]);
        Contact::factory()->create([
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
