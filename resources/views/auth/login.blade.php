<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('auth.login_title') }} - Gestión de Artesanos</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }

        body {
            background-color: #0f172a; /* AZUL OSCURO */
            background-image:
                radial-gradient(circle at 50% 0%, #1e3a8a 0%, transparent 70%),
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 100% 100%, 40px 40px, 40px 40px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: #1e293b;
            border: 1px solid #334155;
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background-color: #3b82f6;
            border-radius: 16px 16px 0 0;
        }

        /* ESTILOS PARA EL SELECTOR DE IDIOMA */
        .lang-selector {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            display: flex;
            gap: 0.5rem;
            background-color: #0f172a;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            border: 1px solid #334155;
        }
        .lang-selector a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 600;
            transition: color 0.2s;
        }
        .lang-selector a:hover, .lang-selector a.active {
            color: #3b82f6;
        }

        h2 { color: #ffffff; font-size: 1.5rem; margin-bottom: 0.5rem; text-align: center; margin-top: 1rem; }
        p.subtitle { color: #94a3b8; font-size: 0.9rem; margin-bottom: 2rem; text-align: center; }

        label { display: block; color: #cbd5e1; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; }

        input {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: #0f172a;
            border: 1px solid #334155;
            border-radius: 8px;
            color: #ffffff;
            font-size: 1rem;
            margin-bottom: 1.25rem;
        }

        input:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2); }

        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 1rem;
        }

        .btn-submit:hover { background-color: #2563eb; }

        .links { display: flex; justify-content: space-between; margin-top: 1.5rem; font-size: 0.85rem; }
        .links a { color: #94a3b8; text-decoration: none; }
        .links a:hover { color: #3b82f6; }
        .error { color: #ef4444; font-size: 0.8rem; margin-top: -1rem; margin-bottom: 1rem; display: block; }
    </style>
</head>
<body>

    <div class="login-card">
        <!-- SELECTOR DE IDIOMAS -->
        <div class="lang-selector">
            <a href="{{ route('lang.switch', 'es') }}" class="{{ app()->getLocale() == 'es' ? 'active' : '' }}">ES</a>
            <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
            <a href="{{ route('lang.switch', 'qu') }}" class="{{ app()->getLocale() == 'qu' ? 'active' : '' }}">QU</a>
        </div>

        <h2>{{ __('auth.login_title') }}</h2>
        <p class="subtitle">{{ __('auth.login_subtitle') }}</p>

        @if (session('status'))
            <div style="color: #22c55e; font-size: 0.9rem; margin-bottom: 1rem; text-align: center;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email">{{ __('auth.email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@artesanos.com">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password">{{ __('auth.password') }}</label>
                <input id="password" type="password" name="password" required placeholder="••••••••">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">{{ __('auth.login_btn') }}</button>
        </form>

        <div class="links">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">{{ __('auth.forgot') }}</a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}">{{ __('auth.register') }}</a>
            @endif
        </div>
    </div>

</body>
</html>
