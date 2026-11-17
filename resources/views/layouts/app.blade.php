<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gestión Artesanos') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { margin: 0; font-family: sans-serif; background-color: #f3f4f6; }
        .layout-container { display: flex; height: 100vh; overflow: hidden; }
        .sidebar { width: 260px; background-color: #1e293b; color: white; display: flex; flex-direction: column; }
        .sidebar-header { padding: 1.5rem; background-color: #0f172a; border-bottom: 1px solid #334155; font-weight: bold; color: #34d399; font-size: 1.25rem; }
        .sidebar-nav { flex: 1; padding: 1.5rem 1rem; }
        .sidebar-link { display: flex; align-items: center; padding: 0.75rem 1rem; color: #cbd5e1; text-decoration: none; border-radius: 0.5rem; margin-bottom: 0.25rem; transition: 0.2s; }
        .sidebar-link:hover, .sidebar-link.active { background-color: #334155; color: white; }
        .main-content { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .topbar { height: 64px; background: white; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .page-content { flex: 1; padding: 2rem; overflow-y: auto; }
        .user-profile { display: flex; align-items: center; gap: 1rem; font-size: 0.875rem; color: #4b5563; }
        .avatar { width: 32px; height: 32px; background-color: #10b981; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }

        /* Estilo especial para el botón del Socket/TV */
        .socket-btn { color: #fbbf24 !important; font-weight: 600; }
        .socket-btn:hover { background-color: #334155 !important; }
        .socket-btn .dot { width: 8px; height: 8px; background-color: #ef4444; border-radius: 50%; display: inline-block; margin-left: auto; animation: pulse 1.5s infinite; }

        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(239, 68, 68, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        /* NUEVOS ESTILOS PARA EL SELECTOR DE IDIOMA */
        .lang-selector-topbar { display: flex; gap: 0.5rem; background: #f3f4f6; padding: 0.25rem 0.5rem; border-radius: 6px; margin-right: 1rem; }
        .lang-selector-topbar a { text-decoration: none; font-size: 0.75rem; font-weight: bold; color: #6b7280; padding: 0.2rem 0.4rem; border-radius: 4px; transition: 0.2s; }
        .lang-selector-topbar a:hover { background: #e5e7eb; color: #1f2937; }
        .lang-selector-topbar a.active { background: #3b82f6; color: white; }
    </style>
</head>
<body>
    <div class="layout-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                Artesanos
            </div>
            <nav class="sidebar-nav">
                @if(auth()->check() && auth()->user()->esAdmin())
                    <!-- MENÚ ADMINISTRADOR -->
                    <p style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; font-weight: bold; margin: 0 1rem 0.5rem 1rem;">{{ __('panel.administracion') }}</p>

                    <a href="{{ route('panel') }}" class="sidebar-link {{ request()->routeIs('panel') ? 'active' : '' }}">
                        <span style="margin-right: 10px;">📊</span> {{ __('panel.title') }}
                    </a>

                    <!-- BOTÓN DE PANTALLA TV (SOCKET) -->
                    <a href="{{ route('socket.pantalla') }}" target="_blank" class="sidebar-link socket-btn">
                        <span style="margin-right: 10px;">📺</span> {{ __('panel.pantalla_tv') }}
                        <span class="dot"></span>
                    </a>

                    <a href="{{ route('artesanos.index') }}" class="sidebar-link {{ request()->routeIs('artesanos.*') ? 'active' : '' }}">
                        <span style="margin-right: 10px;">👥</span> {{ __('panel.artesanos') }}
                    </a>
                    <a href="{{ route('productos.index') }}" class="sidebar-link {{ request()->routeIs('productos.*') ? 'active' : '' }}">
                        <span style="margin-right: 10px;">📦</span> {{ __('panel.productos') }}
                    </a>
                    <a href="{{ route('usuarios.index') }}" class="sidebar-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                        <span style="margin-right: 10px;">👤</span> {{ __('panel.usuarios') }}
                    </a>
                    <a href="{{ route('ventas.index') }}" class="sidebar-link {{ request()->routeIs('ventas.*') ? 'active' : '' }}">
                        <span style="margin-right: 10px;">💰</span> {{ __('panel.ventas') }}
                    </a>
                @else
                    <!-- MENÚ CLIENTE -->
                    <p style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; font-weight: bold; margin: 0 1rem 0.5rem 1rem;">Tienda</p>
                    <a href="{{ route('catalogo') }}" class="sidebar-link {{ request()->routeIs('catalogo') ? 'active' : '' }}">
                        <span style="margin-right: 10px;">🛍️</span> Catálogo de Productos
                    </a>
                @endif

                <hr style="border-color: #334155; margin: 1rem 0;">

                <!-- BOTÓN: MI PERFIL -->
                <a href="{{ route('profile.edit') }}" class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <span style="margin-right: 10px;">⚙️</span> {{ __('panel.mi_perfil') }}
                </a>

                <!-- BOTÓN CERRAR SESIÓN -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                        <span style="margin-right: 10px;">🚪</span> {{ __('panel.cerrar_sesion') }}
                    </button>
                </form>
            </nav>
        </aside>

        <div class="main-content">
            <header class="topbar">
                <h2 style="font-size: 1.25rem; font-weight: bold; color: #1f2937; margin: 0;">
                    {{ $header ?? __('panel.title') }}
                </h2>

                <div style="display: flex; align-items: center;">
                    <!-- SELECTOR DE IDIOMA EN EL TOPBAR (NUEVO) -->
                    <div class="lang-selector-topbar">
                        <a href="{{ route('lang.switch', 'es') }}" class="{{ app()->getLocale() == 'es' ? 'active' : '' }}">ES</a>
                        <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
                        <a href="{{ route('lang.switch', 'qu') }}" class="{{ app()->getLocale() == 'qu' ? 'active' : '' }}">QU</a>
                    </div>

                    <!-- PERFIL EN TOPBAR -->
                    <a href="{{ route('profile.edit') }}" class="user-profile" style="text-decoration: none;">
                        <span style="font-weight: 500;">{{ Auth::user()->nombre ?? 'Invitado' }}</span>
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
