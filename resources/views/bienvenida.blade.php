<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido | Gestión Artesanos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }
        .card-bienvenida {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 50px;
            max-width: 600px;
            text-align: center;
            color: white;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }
        .icono { font-size: 5rem; color: #fff; }
        h1 { font-size: 2.5rem; font-weight: 800; }
        .btn-entrar {
            background: white;
            color: #5b3fa0;
            padding: 12px 40px;
            border-radius: 50px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: 0.3s;
        }
        .btn-entrar:hover { transform: scale(1.05); color: #4a2d85; }

        .btn-secundario {
            background: transparent;
            color: white;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
            border: 2px solid rgba(255, 255, 255, 0.6);
            transition: 0.3s;
        }
        .btn-secundario:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-color: white;
        }
    </style>
</head>
<body>
    <div class="card-bienvenida">
        <i class="bi bi-hammer icono"></i>
        <h1 class="mt-3">Gestión de Artesanos</h1>
        <p class="mt-3">Bienvenido al sistema de gestión de artesanos, productos y usuarios.</p>

        @auth
            {{-- Si YA está logueado --}}
            <a href="{{ route('dashboard') }}" class="btn-entrar">
                <i class="bi bi-speedometer2"></i> Ir al Dashboard
            </a>
        @else
            {{-- Si NO está logueado --}}
            <a href="{{ route('login') }}" class="btn-entrar">
                <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
            </a>
            <br>
            <a href="{{ route('register') }}" class="btn-secundario">
                <i class="bi bi-person-plus"></i> Registrarse
            </a>
        @endauth
    </div>
</body>
</html>
