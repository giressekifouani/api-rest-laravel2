<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        // Envoi de la requête d'inscription
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Vérifie que l'utilisateur a bien été créé dans la base
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
        ]);

        // Récupère l'utilisateur créé et l'authentifie pour le test
        $user = User::where('email', 'test@example.com')->first();
        $this->actingAs($user);

        // Vérifie qu'on est authentifié
        $this->assertAuthenticatedAs($user);

        // Vérifie que la réponse redirige (Breeze/Jetstream redirige souvent vers /dashboard)
        $response->assertRedirect('/dashboard');
    }
}
