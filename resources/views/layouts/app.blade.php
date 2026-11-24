<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gestión Artesanos') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-body: #EEF3FF;
            --text-main: #1B2559;
            --text-muted: #7E8CE0;
            --primary-accent: #4F46E5;
            --border-color: #DCE5FF;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
            background-image:
                radial-gradient(circle at 12% 10%, rgba(79, 70, 229, 0.14) 0%, transparent 35%),
                radial-gradient(circle at 88% 15%, rgba(16, 185, 129, 0.12) 0%, transparent 35%),
                radial-gradient(circle at 75% 90%, rgba(245, 158, 11, 0.12) 0%, transparent 40%);
        }

        .layout-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
            padding: 1.5rem;
            box-sizing: border-box;
            gap: 1.5rem;
        }

        /* =========================================
           SIDEBAR CRISTAL NOCHE CON BRILLOS VIVOS
           ========================================= */
        .sidebar {
            width: 280px;
            background: linear-gradient(175deg, #0B1124 0%, #141E3E 55%, #1E1B4B 100%);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 26px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 55px -12px rgba(11, 17, 36, 0.55), inset 0 1px 0 rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: -80px; right: -60px;
            width: 240px; height: 240px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.45) 0%, transparent 70%);
            pointer-events: none;
            filter: blur(16px);
        }

        .sidebar::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -60px;
            width: 240px; height: 240px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.28) 0%, transparent 70%);
            pointer-events: none;
            filter: blur(18px);
        }

        .sidebar-header {
            padding: 1.85rem 1.5rem;
            font-weight: 900;
            color: #FFFFFF;
            font-size: 1.45rem;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 2;
        }

        .sidebar-header .logo-icon {
            background: linear-gradient(135deg, #FBBF24, #F59E0B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.65rem;
            filter: drop-shadow(0 0 12px rgba(251, 191, 36, 0.65));
        }

        .sidebar-nav { flex: 1; padding: 1.4rem 1rem; overflow-y: auto; z-index: 2; }

        .nav-section-title {
            font-size: 0.72rem;
            color: rgba(255, 255, 255, 0.55);
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin: 0 1rem 0.9rem 1rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.88rem 1rem;
            color: rgba(255, 255, 255, 0.78);
            text-decoration: none;
            border-radius: 15px;
            margin-bottom: 0.45rem;
            transition: all 0.28s cubic-bezier(0.22, 1, 0.36, 1);
            font-weight: 600;
            font-size: 0.94rem;
            position: relative;
            z-index: 2;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.11);
            color: #FFFFFF;
            transform: translateX(5px);
        }

        .sidebar-link.active {
            background: linear-gradient(95deg, #4F46E5 0%, #7C3AED 100%);
            color: #FFFFFF;
            font-weight: 700;
            box-shadow: 0 8px 22px rgba(79, 70, 229, 0.55), inset 0 1px 0 rgba(255, 255, 255, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .sidebar-link .icon { margin-right: 12px; font-size: 1.2rem; }

        /* MAIN CONTENT */
        .main-content { flex: 1; display: flex; flex-direction: column; overflow: hidden; }

        /* =========================================
           TOPBAR VIBRANTE Y LLAMATIVA TIPO PREMIO
           ========================================= */
        .topbar {
            min-height: 76px;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.94) 0%, rgba(224, 231, 255, 0.90) 50%, rgba(254, 243, 199, 0.88) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.65rem 1.25rem;
            border-radius: 24px;
            border: 1.5px solid rgba(255, 255, 255, 0.92);
            box-shadow: 0 12px 28px rgba(79, 70, 229, 0.13), inset 0 1px 0 rgba(255, 255, 255, 0.95);
            margin-bottom: 0.85rem;
            position: relative;
            overflow: hidden;
        }

        .topbar::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 26% 32%, rgba(99, 102, 241, 0.18) 0px, transparent 14px),
                radial-gradient(circle at 68% 72%, rgba(245, 158, 11, 0.24) 0px, transparent 16px),
                radial-gradient(circle at 83% 25%, rgba(236, 72, 153, 0.16) 0px, transparent 11px);
            pointer-events: none;
            z-index: 0;
        }

        .topbar h2 {
            font-size: 1.85rem;
            font-weight: 900;
            background: linear-gradient(90deg, #1D4ED8 0%, #7C3AED 45%, #EC4899 78%, #F59E0B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            letter-spacing: -0.6px;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 2px 8px rgba(124, 58, 237, 0.15));
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            position: relative;
            z-index: 1;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-size: 0.9rem;
            color: #1E1B4B;
            text-decoration: none;
            background: linear-gradient(135deg, #FFFFFF 0%, #FFFBEB 55%, #FDF2F8 100%);
            padding: 0.4rem 0.95rem 0.4rem 0.85rem;
            border-radius: 30px;
            border: 1.5px solid #FDE68A;
            transition: all 0.25s ease;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.16);
        }

        .user-profile:hover {
            box-shadow: 0 12px 24px rgba(236, 72, 153, 0.24);
            transform: translateY(-2px);
            border-color: #F472B6;
        }

        .avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #F59E0B 0%, #EC4899 52%, #6366F1 100%);
            color: #FFFFFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 0.92rem;
            box-shadow: 0 4px 12px rgba(236, 72, 153, 0.42);
            border: 1.5px solid rgba(255, 255, 255, 0.8);
        }

        /* SELECTOR DE IDIOMA */
        .lang-selector-topbar {
            display: flex;
            gap: 0.25rem;
            background: linear-gradient(135deg, #EEF2FF 0%, #FCE7F3 100%);
            padding: 0.35rem 0.45rem;
            border-radius: 22px;
            border: 1.5px solid #C7D2FE;
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.14);
        }

        .lang-selector-topbar a {
            text-decoration: none;
            font-size: 0.76rem;
            font-weight: 800;
            color: #4338CA;
            padding: 0.34rem 0.68rem;
            border-radius: 14px;
            transition: all 0.22s ease;
        }

        .lang-selector-topbar a:hover {
            background: rgba(255, 255, 255, 0.85);
            color: #EC4899;
            transform: translateY(-1px);
        }

        .lang-selector-topbar a.active {
            background: linear-gradient(135deg, #4F46E5 0%, #EC4899 100%);
            color: #FFFFFF;
            box-shadow: 0 4px 12px rgba(236, 72, 153, 0.4);
        }

        /* CONTENIDO */
        .page-content { flex: 1; padding: 0.25rem 0.75rem 1rem 0.75rem; overflow-y: auto; }

        /* SOCKET BTN */
        .socket-btn { color: #FBBF24 !important; font-weight: 700; }
        .socket-btn .dot {
            width: 8px; height: 8px; background-color: #EF4444; border-radius: 50%;
            display: inline-block; margin-left: auto; animation: pulse 1.5s infinite;
            box-shadow: 0 0 10px #EF4444;
        }
        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.75); }
            70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(239, 68, 68, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #C7D2FE; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="layout-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <span class="logo-icon">✦</span> Artesanos
            </div>
            <nav class="sidebar-nav">
                @if(auth()->check() && auth()->user()->esAdmin())
                    <p class="nav-section-title">{{ __('panel.administracion') }}</p>

                    <a href="{{ route('panel') }}" class="sidebar-link {{ request()->routeIs('panel') ? 'active' : '' }}">
                        <span class="icon">📊</span> {{ __('panel.title') }}
                    </a>
                    <a href="{{ route('socket.pantalla') }}" target="_blank" class="sidebar-link socket-btn">
                        <span class="icon">📺</span> {{ __('panel.pantalla_tv') }}
                        <span class="dot"></span>
                    </a>
                    <a href="{{ route('artesanos.index') }}" class="sidebar-link {{ request()->routeIs('artesanos.*') ? 'active' : '' }}">
                        <span class="icon">👥</span> {{ __('panel.artesanos') }}
                    </a>
                    <a href="{{ route('productos.index') }}" class="sidebar-link {{ request()->routeIs('productos.*') ? 'active' : '' }}">
                        <span class="icon">📦</span> {{ __('panel.productos') }}
                    </a>
                    <a href="{{ route('usuarios.index') }}" class="sidebar-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                        <span class="icon">👤</span> {{ __('panel.usuarios') }}
                    </a>
                    <a href="{{ route('ventas.index') }}" class="sidebar-link {{ request()->routeIs('ventas.*') ? 'active' : '' }}">
                        <span class="icon">💰</span> {{ __('panel.ventas') }}
                    </a>
                @else
                    <p class="nav-section-title">Tienda</p>
                    <a href="{{ route('catalogo') }}" class="sidebar-link {{ request()->routeIs('catalogo') ? 'active' : '' }}">
                        <span class="icon">🛍️</span> Catálogo de Productos
                    </a>
                @endif

                <hr style="border-color: rgba(255,255,255,0.1); margin: 1.5rem 0;">

                <a href="{{ route('profile.edit') }}" class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <span class="icon">⚙️</span> {{ __('panel.mi_perfil') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; font-family: inherit; color: rgba(255, 255, 255, 0.78);">
                        <span class="icon">🚪</span> {{ __('panel.cerrar_sesion') }}
                    </button>
                </form>
            </nav>
        </aside>

        <div class="main-content">
            <header class="topbar">
                <h2>{{ $header ?? __('panel.title') }}</h2>
                <div class="topbar-actions">
                    <div class="lang-selector-topbar">
                        <a href="{{ route('lang.switch', 'es') }}" class="{{ app()->getLocale() == 'es' ? 'active' : '' }}">ES</a>
                        <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
                        <a href="{{ route('lang.switch', 'qu') }}" class="{{ app()->getLocale() == 'qu' ? 'active' : '' }}">QU</a>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="user-profile">
                        <span style="font-weight: 800;">{{ Auth::user()->nombre ?? 'Invitado' }}</span>
                        <div class="avatar">{{ substr(Auth::user()->nombre ?? 'A', 0, 1) }}</div>
                    </a>
                </div>
            </header>

            <main class="page-content">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
