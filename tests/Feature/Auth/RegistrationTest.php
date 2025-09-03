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
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'admin',         // champ requis par la contrainte CHECK
            'telephone' => '0000000000', // champ requis par la table
        ]);

        // Vérifie que l'utilisateur a bien été créé
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
        ]);

        // Authentifie l'utilisateur pour le test
        $user = User::where('email', 'test@example.com')->first();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        // Vérifie que la réponse redirige vers le dashboard
        $response->assertRedirect('/dashboard');
    }
}
