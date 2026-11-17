<?php

namespace App\Models;

class Usuario extends User
{
    // Al heredar de User, ya toma la tabla 'usuarios' y la configuración del login.
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
        'password_updates', // 👈 AGREGA ESTA LÍNEA AQUÍ
    ];
}
