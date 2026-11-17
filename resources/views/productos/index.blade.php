<x-app-layout>
    <x-slot name="header">
        {{ __('productos.titulo') }}
    </x-slot>

    <!-- Contenedor del Buscador -->
    <div style="background: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 1.5rem;">
        <form action="{{ route('productos.index') }}" method="GET" style="display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; font-size: 0.875rem; color: #374151; margin-bottom: 0.5rem; font-weight: bold;">{{ __('productos.buscar') }}</label>
                <input type="text" name="buscar" placeholder="{{ __('productos.buscar_placeholder') }}" value="{{ request('buscar') }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; outline: none;">
            </div>
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; font-size: 0.875rem; color: #374151; margin-bottom: 0.5rem; font-weight: bold;">{{ __('productos.categoria') }}</label>
                <select name="categoria" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; outline: none;">
                    <option value="">{{ __('productos.todas_categorias') }}</option>
                    @foreach($categorias as $cat)
                        <!-- CORRECCIÓN AQUÍ: $cat es un string, no un objeto -->
                        <option value="{{ $cat }}" {{ request('categoria') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display: flex; gap: 0.5rem;">
                <button type="submit" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: bold;">{{ __('productos.btn_buscar') }}</button>
                <a href="{{ route('productos.create') }}" style="background-color: #059669; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; font-weight: bold; display: flex; align-items: center;">+ {{ __('productos.btn_nuevo') }}</a>
            </div>
        </form>
    </div>

    <!-- Tabla de Datos -->
    <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background-color: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                <tr>
                    <th style="padding: 1rem; font-size: 0.75rem; color: #6b7280; text-transform: uppercase;">{{ __('productos.id') }}</th>
                    <th style="padding: 1rem; font-size: 0.75rem; color: #6b7280; text-transform: uppercase;">{{ __('productos.nombre') }}</th>
                    <th style="padding: 1rem; font-size: 0.75rem; color: #6b7280; text-transform: uppercase;">{{ __('productos.descripcion') }}</th>
                    <th style="padding: 1rem; font-size: 0.75rem; color: #6b7280; text-transform: uppercase;">{{ __('productos.precio') }}</th>
                    <th style="padding: 1rem; font-size: 0.75rem; color: #6b7280; text-transform: uppercase;">{{ __('productos.categoria') }}</th>
                    <th style="padding: 1rem; font-size: 0.75rem; color: #6b7280; text-transform: uppercase;">{{ __('productos.artesano') }}</th>
                    <th style="padding: 1rem; font-size: 0.75rem; color: #6b7280; text-transform: uppercase;">{{ __('productos.acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 1rem; color: #4b5563;">{{ $producto->id }}</td>
                    <td style="padding: 1rem; color: #111827; font-weight: 500;">{{ $producto->nombre }}</td>
                    <td style="padding: 1rem; color: #4b5563;">{{ Str::limit($producto->descripcion, 50) }}</td>
                    <td style="padding: 1rem; color: #4b5563;">S/ {{ number_format($producto->precio, 2) }}</td>
                    <td style="padding: 1rem;">
                        <span style="background-color: #ecfeff; color: #155e75; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: bold;">
                            {{ $producto->categoria }}
                        </span>
                    </td>
                    <!-- CORRECCIÓN AQUÍ: El nombre del artesano viene de la relación -->
                    <td style="padding: 1rem; color: #4b5563;">{{ $producto->artesano->nombres ?? 'Sin artesano' }} {{ $producto->artesano->apellidos ?? '' }}</td>
                    <td style="padding: 1rem;">
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('productos.edit', $producto->id) }}" style="background-color: #facc15; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; text-decoration: none;">✏️</a>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('{{ __('productos.confirmar_eliminar') }}')">
                                @csrf
                                @method('DELETE')
                                <button style="background-color: #ef4444; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; border: none; cursor: pointer;">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 2rem; text-align: center; color: #6b7280;">{{ __('productos.sin_registros') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
