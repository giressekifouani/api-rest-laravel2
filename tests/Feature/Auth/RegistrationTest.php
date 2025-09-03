<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        // Envoie du formulaire d'inscription
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'telephone' => '0000000000', // valeur par défaut
            'role' => 'user',             // valeur par défaut compatible avec le CHECK constraint
        ]);

        // Vérifie que l'utilisateur a bien été créé en base
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
            'telephone' => '0000000000',
            'role' => 'user',
        ]);

        // Vérifie que l'utilisateur est authentifié
        $this->assertAuthenticated();

        // Vérifie que la réponse redirige correctement après inscription
        $response->assertRedirect('/home'); // ou la route de redirection après l'inscription
    }
}
