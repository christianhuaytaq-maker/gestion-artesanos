<x-app-layout>
    <x-slot name="header">
        {{ __('usuarios.titulo') }}
    </x-slot>

    <!-- Contenedor del Buscador -->
    <div style="background: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 1.5rem;">
        <form action="{{ route('usuarios.index') }}" method="GET" style="display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; font-size: 0.875rem; color: #374151; margin-bottom: 0.5rem; font-weight: bold;">{{ __('usuarios.buscar') }}</label>
                <input type="text" name="buscar" placeholder="{{ __('usuarios.buscar_placeholder') }}" value="{{ request('buscar') }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; outline: none;">
            </div>
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; font-size: 0.875rem; color: #374151; margin-bottom: 0.5rem; font-weight: bold;">{{ __('usuarios.rol') }}</label>
                <select name="rol" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; outline: none;">
                    <option value="">{{ __('usuarios.todos_roles') }}</option>
                    <option value="admin" {{ request('rol') == 'admin' ? 'selected' : '' }}>{{ __('usuarios.rol_admin') }}</option>
                    <option value="cliente" {{ request('rol') == 'cliente' ? 'selected' : '' }}>{{ __('usuarios.rol_cliente') }}</option>
                </select>
            </div>
            <div style="display: flex; gap: 0.5rem;">
                <button type="submit" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: bold;">{{ __('usuarios.btn_buscar') }}</button>
                <a href="{{ route('usuarios.create') }}" style="background-color: #059669; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; font-weight: bold; display: flex; align-items: center;">+ {{ __('usuarios.btn_nuevo') }}</a>
            </div>
        </form>
    </div>

    <!-- Tabla de Datos -->
    <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background-color: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                <tr>
                    <th style="padding: 1rem; font-size: 0.75rem; color: #6b7280; text-transform: uppercase;">{{ __('usuarios.id') }}</th>
                    <th style="padding: 1rem; font-size: 0.75rem; color: #6b7280; text-transform: uppercase;">{{ __('usuarios.nombre') }}</th>
                    <th style="padding: 1rem; font-size: 0.75rem; color: #6b7280; text-transform: uppercase;">{{ __('usuarios.email') }}</th>
                    <th style="padding: 1rem; font-size: 0.75rem; color: #6b7280; text-transform: uppercase;">{{ __('usuarios.rol') }}</th>
                    <th style="padding: 1rem; font-size: 0.75rem; color: #6b7280; text-transform: uppercase;">{{ __('usuarios.acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 1rem; color: #4b5563;">{{ $usuario->id }}</td>
                    <td style="padding: 1rem; color: #111827; font-weight: 500;">{{ $usuario->name }}</td>
                    <td style="padding: 1rem; color: #4b5563;">{{ $usuario->email }}</td>
                    <td style="padding: 1rem;">
                        <span style="background-color: #ecfeff; color: #155e75; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: bold;">
                            {{ $usuario->rol }}
                        </span>
                    </td>
                    <td style="padding: 1rem;">
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" style="background-color: #facc15; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; text-decoration: none;">✏️</a>
                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('{{ __('usuarios.confirmar_eliminar') }}')">
                                @csrf
                                @method('DELETE')
                                <button style="background-color: #ef4444; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; border: none; cursor: pointer;">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 2rem; text-align: center; color: #6b7280;">{{ __('usuarios.sin_registros') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
