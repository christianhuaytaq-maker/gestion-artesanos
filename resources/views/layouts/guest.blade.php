<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Gestión de Artesanos') }}</title>

        <!-- Fuente Inter (profesional) -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

        <!-- Scripts de Laravel -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="margin: 0; padding: 0; font-family: 'Inter', sans-serif; background-color: #0f172a;">

        <!-- Fondo azul oscuro con cuadrícula idéntico al de tu sistema -->
        <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center;
                    background-image: radial-gradient(circle at 50% 0%, #1e3a8a 0%, transparent 70%),
                                      linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                                      linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
                    background-size: 100% 100%, 40px 40px, 40px 40px;">

            <!-- Aquí se carga el contenido (login, register, etc) -->
            <div style="width: 100%; max-width: 450px; margin: 1rem;">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
