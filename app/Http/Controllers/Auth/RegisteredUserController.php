<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            // Se eliminó 'lowercase' para permitir mayúsculas
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            // Convertimos el email a minúsculas antes de guardarlo
            'email' => strtolower($request->email),
            // Encriptamos la contraseña correctamente
            'password' => Hash::make($request->password),
            'rol' => 'usuario', // Por defecto se registran como "usuario"
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirigimos con el mensaje de éxito (el "verdecito")
        return redirect()->route('dashboard')->with('success', '¡Registro exitoso! Ya eres parte del sistema.');
    }
}
