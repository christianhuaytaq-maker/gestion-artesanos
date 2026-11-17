<nav x-data="{ open: false }" style="background-color: #0f172a; border-bottom: 1px solid #1e293b;">
    <!-- Menú de Navegación Principal -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <div style="display: flex; justify-content: space-between; height: 64px; align-items: center;">

            <!-- Logo -->
            <div style="display: flex; align-items: center;">
                <a href="{{ route('dashboard') }}" style="text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                    <svg style="width: 32px; height: 32px; color: #3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                    </svg>
                    <span style="color: white; font-weight: 700; font-size: 1.1rem; letter-spacing: 0.5px;">Artesanos</span>
                </a>
            </div>

            <!-- Menú de Usuario (Escritorio) -->
            <div style="display: flex; align-items: center; gap: 1.5rem;">

                <!-- NUEVO BOTÓN DE NOTIFICACIONES EN VIVO (SOCKET) -->
                <a href="{{ route('notificaciones.index') }}" style="display: flex; align-items: center; gap: 0.5rem; color: #fbbf24; text-decoration: none; font-size: 0.9rem; font-weight: 600; transition: color 0.2s; background-color: rgba(251, 191, 36, 0.1); padding: 0.4rem 0.8rem; border-radius: 0.375rem;" onmouseover="this.style.color='#fcd34d'" onmouseout="this.style.color='#fbbf24'">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    Notificaciones
                    <span style="display: inline-block; width: 8px; height: 8px; background-color: #ef4444; border-radius: 50%; margin-left: 2px;"></span>
                </a>

                <!-- Botón de Mi Perfil -->
                <a href="{{ route('profile.edit') }}" style="display: flex; align-items: center; gap: 0.5rem; color: #cbd5e1; text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: color 0.2s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#cbd5e1'">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Mi Perfil
                </a>

                <!-- Nombre del Usuario -->
                <div style="display: flex; align-items: center; gap: 0.5rem; color: white; font-weight: 600; font-size: 0.9rem;">
                    <div style="width: 32px; height: 32px; background-color: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    {{ Auth::user()->name }}
                </div>

                <!-- Botón de Cerrar Sesión -->
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #f87171; cursor: pointer; display: flex; align-items: center; gap: 0.3rem; font-size: 0.9rem; font-weight: 500;">
                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Salir
                    </button>
                </form>
            </div>

            <!-- Botón Hamburguesa (Móvil) -->
            <div style="display: flex; align-items: center;" class="sm:hidden">
                <button @click="open = ! open" style="background: none; border: none; color: #cbd5e1; cursor: pointer; padding: 0.5rem;">
                    <svg style="width: 24px; height: 24px;" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú Móvil -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background-color: #1e293b; border-top: 1px solid #334155;">
        <div style="padding: 1rem;">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #334155;">
                <div style="width: 40px; height: 40px; background-color: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div style="font-weight: 600; color: white;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 0.8rem; color: #94a3b8;">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <!-- Notificaciones en Móvil -->
            <a href="{{ route('notificaciones.index') }}" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 0; color: #fbbf24; text-decoration: none; font-weight: 600;">
                🔔 Notificaciones
            </a>

            <a href="{{ route('profile.edit') }}" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 0; color: #cbd5e1; text-decoration: none; font-weight: 500;">
                Mi Perfil
            </a>

            <form method="POST" action="{{ route('logout') }}" style="margin-top: 0.5rem;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #f87171; cursor: pointer; padding: 0.5rem 0; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</nav>
