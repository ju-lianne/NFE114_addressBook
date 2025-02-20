<?php

namespace Tests\Feature;

use App\Livewire\FavoriteContactsList;
use App\Models\Categorie;
use App\Models\Contact;
use App\Models\Personne;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FavoriteContactsListLivewireTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_renders_initially_without_favorites()
    {
        Livewire::test(FavoriteContactsList::class)
            ->assertSee('Aucun contact favori trouvé.');
    }

    public function test_search_filters_favorite_contacts()
    {
        $personneUser = Personne::factory()->create();
        $user = Utilisateur::factory()->create(['id' => $personneUser->id]);

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

        $user->favoris()->attach($personne->id);
        $this->actingAs($user);

        Livewire::test(FavoriteContactsList::class)
            ->set('search', 'John')
            ->assertDontSee('Aucun contact favori trouvé.')
            ->assertSee('John')
            ->assertSee('Doe');

        Livewire::test(FavoriteContactsList::class)
            ->set('search', 'Inexistant')
            ->assertSee('Aucun contact favori trouvé.');
    }

    public function test_filter_by_single_category()
    {
        $personneUser = Personne::factory()->create();
        $user = Utilisateur::factory()->create(['id' => $personneUser->id]);

        $category1 = Categorie::factory()->create(['libelle' => 'Category A']);
        $category2 = Categorie::factory()->create(['libelle' => 'Category B']);

        $person1 = Personne::factory()->create([
            'nom'    => 'Smith',
            'prenom' => 'Alice'
        ]);
        $person2 = Personne::factory()->create([
            'nom'    => 'Jones',
            'prenom' => 'Bob'
        ]);

        $contact1 = Contact::factory()->create([
            'id'           => $person1->id,
            'categorie_id' => $category1->id,
        ]);
        $contact2 = Contact::factory()->create([
            'id'           => $person2->id,
            'categorie_id' => $category2->id,
        ]);

        $user->favoris()->attach([$contact1->id, $contact2->id]);
        $this->actingAs($user);

        Livewire::test(FavoriteContactsList::class)
            ->set('selectedCategories', [$category1->id])
            ->assertSee('Alice')
            ->assertDontSee('Bob');

        Livewire::test(FavoriteContactsList::class)
            ->set('selectedCategories', [$category2->id])
            ->assertSee('Bob')
            ->assertDontSee('Alice');
    }

    public function test_filter_by_multiple_categories()
    {
        $personneUser = Personne::factory()->create();
        $user = Utilisateur::factory()->create(['id' => $personneUser->id]);

        $categoryA = Categorie::factory()->create(['libelle' => 'Category A']);
        $categoryB = Categorie::factory()->create(['libelle' => 'Category B']);

        $personA = Personne::factory()->create([
            'nom'    => 'Alpha',
            'prenom' => 'Anna'
        ]);
        $personB = Personne::factory()->create([
            'nom'    => 'Beta',
            'prenom' => 'Brian'
        ]);
        $personC = Personne::factory()->create([
            'nom'    => 'Gamma',
            'prenom' => 'Charlie'
        ]);

        $contactA = Contact::factory()->create([
            'id'           => $personA->id,
            'categorie_id' => $categoryA->id,
        ]);
        $contactB = Contact::factory()->create([
            'id'           => $personB->id,
            'categorie_id' => $categoryB->id,
        ]);
        $contactC = Contact::factory()->create([
            'id'           => $personC->id,
            'categorie_id' => null,
        ]);

        $user->favoris()->attach([$contactA->id, $contactB->id, $contactC->id]);
        $this->actingAs($user);

        Livewire::test(FavoriteContactsList::class)
            ->set('selectedCategories', [$categoryA->id, $categoryB->id])
            ->assertSee('Anna')
            ->assertSee('Brian')
            ->assertDontSee('Charlie');
    }

    public function test_search_and_filter_combination()
    {
        $personneUser = Personne::factory()->create();
        $user = Utilisateur::factory()->create(['id' => $personneUser->id]);

        $category1 = Categorie::factory()->create(['libelle' => 'Category A']);
        $category2 = Categorie::factory()->create(['libelle' => 'Category B']);

        $person1 = Personne::factory()->create([
            'nom'    => 'Doe',
            'prenom' => 'John'
        ]);
        $person2 = Personne::factory()->create([
            'nom'    => 'Smith',
            'prenom' => 'Jane'
        ]);

        $contact1 = Contact::factory()->create([
            'id'           => $person1->id,
            'categorie_id' => $category1->id,
        ]);
        $contact2 = Contact::factory()->create([
            'id'           => $person2->id,
            'categorie_id' => $category2->id,
        ]);

        $user->favoris()->attach([$contact1->id, $contact2->id]);
        $this->actingAs($user);

        Livewire::test(FavoriteContactsList::class)
            ->set('search', 'John')
            ->set('selectedCategories', [$category1->id])
            ->assertSee('John')
            ->assertDontSee('Jane');

        Livewire::test(FavoriteContactsList::class)
            ->set('search', 'Smith')
            ->set('selectedCategories', [$category1->id])
            ->assertSee('Aucun contact favori trouvé.');
    }
}
