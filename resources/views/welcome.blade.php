<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | Gestión de Artesanos</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }

        body {
            background-color: #0f172a;
            background-image:
                radial-gradient(circle at 50% 0%, #1e3a8a 0%, transparent 70%),
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 100% 100%, 40px 40px, 40px 40px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f8fafc;
        }

        .card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background-color: #3b82f6;
            border-radius: 16px 16px 0 0;
        }

        .icon {
            width: 64px;
            height: 64px;
            color: #3b82f6;
            margin: 0 auto 20px auto;
        }

        h1 { color: #ffffff; font-size: 28px; margin: 0 0 10px 0; }
        p { color: #94a3b8; font-size: 15px; line-height: 1.6; margin-bottom: 30px; }

        .btn-login {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #3b82f6;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 15px;
            transition: background 0.2s;
        }
        .btn-login:hover { background-color: #2563eb; }

        .btn-register {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: transparent;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            border: 1px solid #475569;
            transition: background 0.2s;
        }
        .btn-register:hover { background-color: rgba(255,255,255,0.05); }
    </style>
</head>
<body>

    <div class="card">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
        </svg>

        <h1>Gestión de Artesanos</h1>
        <p>Bienvenido al sistema centralizado de gestión. Administra productos, controla inventarios y gestiona usuarios.</p>

        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-login">Ir al Panel</a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">Iniciar Sesión</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-register">Registrarse</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

</body>
</html>
