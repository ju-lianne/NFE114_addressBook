<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Personne;
use App\Models\Utilisateur;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function testDashboardAccessible()
    {
        $personne = Personne::factory()->create([
            'courriel' => 'test@example.com'
        ]);

        $user = Utilisateur::factory()->create([
            'id' => $personne->id,
        ]);

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }
}
