<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\Personne;
use App\Models\Utilisateur;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testRegistration()
    {
        Role::factory()->create([
            'id'      => 2,
            'libelle' => 'User'
        ]);

        Categorie::factory()->create([
            'id'      => 1,
            'libelle' => 'Default'
        ]);

        $registrationData = [
            'prenom'                => 'Alice',
            'nom'                   => 'Dupont',
            'email'                 => 'alice@example.com',
            'password'              => 'secret123',
            'password_confirmation' => 'secret123',
            'birthdate'             => '1990-01-01',
        ];

        $response = $this->post(route('register.post'), $registrationData);

        $response->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('personnes', [
            'prenom'   => 'Alice',
            'nom'      => 'Dupont',
            'courriel' => 'alice@example.com',
        ]);

        $person = Personne::where('courriel', 'alice@example.com')->first();
        $this->assertNotNull($person);
        $this->assertDatabaseHas('utilisateurs', [
            'id' => $person->id,
        ]);
    }
    public function testLogin()
    {
        $person = Personne::factory()->create([
            'courriel' => 'bob@example.com',
        ]);

        $password = 'mypassword';
        $user = Utilisateur::factory()->create([
            'id'       => $person->id,
            'password' => Hash::make($password),
        ]);

        $loginData = [
            'email'    => 'bob@example.com',
            'password' => $password,
        ];

        $response = $this->post(route('login.post'), $loginData);

        $response->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function testLogout()
    {
        $person = Personne::factory()->create([
            'courriel' => 'charlie@example.com',
        ]);
        $user = Utilisateur::factory()->create([
            'id'       => $person->id,
            'password' => Hash::make('secret'),
        ]);
        $this->actingAs($user);

        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
