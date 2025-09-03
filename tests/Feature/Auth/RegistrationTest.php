<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        // Requête POST vers /register avec tous les champs requis
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',             // valeur par défaut compatible avec la contrainte CHECK
            'telephone' => '0000000000',  // valeur par défaut compatible avec NOT NULL
        ]);

        // Vérifie que l'utilisateur a bien été créé en base
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
            'role' => 'user',
            'telephone' => '0000000000',
        ]);

        // Vérifie que l'utilisateur est authentifié
        $this->assertAuthenticated();

        // Vérifie que la réponse redirige vers la page d'accueil ou /home
        $response->assertRedirect('/home');
    }
}
