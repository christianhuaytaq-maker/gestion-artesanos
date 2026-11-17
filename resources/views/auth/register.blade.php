<x-guest-layout>
    <div style="background-color: #1e293b; border: 1px solid #334155; width: 100%; max-width: 450px; padding: 2.5rem; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); position: relative; margin: auto;">
        <!-- Línea superior azul -->
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background-color: #3b82f6; border-radius: 16px 16px 0 0;"></div>

        <h2 style="color: #ffffff; font-size: 1.5rem; margin-bottom: 0.5rem; text-align: center; font-weight: 700;">Crear una Cuenta</h2>
        <p style="color: #94a3b8; font-size: 0.9rem; margin-bottom: 2rem; text-align: center;">
            Regístrate para poder acceder al sistema de gestión.
        </p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <div style="margin-bottom: 1.25rem;">
                <label for="nombre" style="display: block; color: #cbd5e1; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Nombre Completo</label>
                <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" required autofocus autocomplete="name" style="width: 100%; padding: 0.75rem 1rem; background-color: #0f172a; border: 1px solid #334155; border-radius: 8px; color: #ffffff; font-size: 1rem;">
                @error('nombre')
                    <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.3rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Correo -->
            <div style="margin-bottom: 1.25rem;">
                <label for="email" style="display: block; color: #cbd5e1; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Correo Electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" style="width: 100%; padding: 0.75rem 1rem; background-color: #0f172a; border: 1px solid #334155; border-radius: 8px; color: #ffffff; font-size: 1rem;">
                @error('email')
                    <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.3rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contraseña -->
            <div style="margin-bottom: 1.25rem;">
                <label for="password" style="display: block; color: #cbd5e1; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" style="width: 100%; padding: 0.75rem 1rem; background-color: #0f172a; border: 1px solid #334155; border-radius: 8px; color: #ffffff; font-size: 1rem;">
                @error('password')
                    <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.3rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div style="margin-bottom: 1.5rem;">
                <label for="password_confirmation" style="display: block; color: #cbd5e1; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Confirmar Contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" style="width: 100%; padding: 0.75rem 1rem; background-color: #0f172a; border: 1px solid #334155; border-radius: 8px; color: #ffffff; font-size: 1rem;">
                @error('password_confirmation')
                    <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.3rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" style="width: 100%; padding: 0.85rem; background-color: #3b82f6; color: white; border: none; border-radius: 8px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background-color 0.2s;">
                Registrarse
            </button>
        </form>

        <div style="margin-top: 1.5rem; text-align: center; font-size: 0.85rem;">
            <a href="{{ route('login') }}" style="color: #94a3b8; text-decoration: none;">¿Ya tienes cuenta? Inicia Sesión</a>
        </div>
    </div>
</x-guest-layout>
