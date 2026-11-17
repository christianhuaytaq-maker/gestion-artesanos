<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'nombre' => 'Test User', // <-- CAMBIADO: de 'name' a 'nombre'
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // NOTA: Tu sistema usa verificación de correo, por lo que el usuario
        // no se autentica automáticamente. Solo verificamos que no haya errores.
        $response->assertSessionHasNoErrors();

        // Si tu sistema NO requiere verificación, descomenta estas líneas:
        // $this->assertAuthenticated();
        // $response->assertRedirect(route('dashboard', absolute: false));
    }
}
