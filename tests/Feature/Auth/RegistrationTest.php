<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'telephone' => '0000000000', // champ requis par la table
            'role' => 'user',             // valeur par défaut compatible avec le CHECK constraint
        ]);

        // Vérifie que l'utilisateur a bien été créé
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
            'telephone' => '0000000000',
            'role' => 'user',
        ]);

        // Vérifie que l'utilisateur est authentifié
        $this->assertAuthenticated();

        // Vérifie que la réponse est correcte
        $response->assertNoContent();
    }
}
