<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creamos el usuario administrador por defecto
        User::create([
            'nombre' => 'Administrador',      // <-- Cambiado de 'name' a 'nombre'
            'email' => 'admin@test.com',
            'password' => Hash::make('password'), // La contraseña será: password
            'rol' => 'administrador',         // Lo creamos como admin
        ]);

        // Si quieres crear un usuario normal de prueba, descomenta esto:
        /*
        User::create([
            'nombre' => 'Usuario Prueba',
            'email' => 'usuario@test.com',
            'password' => Hash::make('password'),
            'rol' => 'usuario',
        ]);
        */
    }
}
