<x-app-layout>
    <x-slot name="header">
        {{ __('panel.title') }}
    </x-slot>

    <!-- TARJETAS CON COLORES VIVOS (Estilo directo garantizado) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">

        <!-- Tarjeta Artesanos (Azul Brillante) -->
        <div style="background-color: #3b82f6; border-radius: 0.5rem; padding: 1.5rem; display: flex; align-items: center; justify-content: space-between; color: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <div>
                <p style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9; margin: 0;">{{ __('panel.artesanos') }}</p>
                <!-- SE AGREGO EL ID AQUI -->
                <p id="total-artesanos" style="font-size: 2.5rem; font-weight: bold; margin: 0.5rem 0 0 0; line-height: 1;">{{ $totalArtesanos }}</p>
            </div>
            <div style="opacity: 0.4;">
                <svg style="width: 4rem; height: 4rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

        <!-- Tarjeta Productos (Verde Esmeralda) -->
        <div style="background-color: #10b981; border-radius: 0.5rem; padding: 1.5rem; display: flex; align-items: center; justify-content: space-between; color: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <div>
                <p style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9; margin: 0;">{{ __('panel.productos') }}</p>
                <!-- SE AGREGO EL ID AQUI -->
                <p id="total-productos" style="font-size: 2.5rem; font-weight: bold; margin: 0.5rem 0 0 0; line-height: 1;">{{ $totalProductos }}</p>
            </div>
            <div style="opacity: 0.4;">
                <svg style="width: 4rem; height: 4rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
        </div>

        <!-- Tarjeta Usuarios (Amarillo/Naranja Brillante) -->
        <div style="background-color: #f59e0b; border-radius: 0.5rem; padding: 1.5rem; display: flex; align-items: center; justify-content: space-between; color: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <div>
                <p style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.9; margin: 0;">{{ __('panel.usuarios') }}</p>
                <!-- SE AGREGO EL ID AQUI -->
                <p id="total-usuarios" style="font-size: 2.5rem; font-weight: bold; margin: 0.5rem 0 0 0; line-height: 1;">{{ $totalUsuarios }}</p>
            </div>
            <div style="opacity: 0.4;">
                <svg style="width: 4rem; height: 4rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- TABLA DE ÚLTIMOS ARTESANOS -->
    <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; background-color: #f9fafb;">
            <h3 style="font-size: 1.125rem; font-weight: bold; color: #1f2937; margin: 0;">{{ __('panel.ultimos_artesanos') }}</h3>
            <a href="{{ route('artesanos.index') }}" style="font-size: 0.875rem; font-weight: 500; color: #2563eb; text-decoration: none;">{{ __('panel.ver_todos') }} &rarr;</a>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; text-align: left; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: white; color: #6b7280; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">
                        <th style="padding: 1rem; font-weight: 600;">{{ __('panel.nombre_completo') }}</th>
                        <th style="padding: 1rem; font-weight: 600;">{{ __('panel.especialidad') }}</th>
                        <th style="padding: 1rem; font-weight: 600;">{{ __('panel.telefono') }}</th>
                    </tr>
                </thead>
                <tbody style="divide-y: 1px solid #f3f4f6;">
                    @forelse($ultimosArtesanos as $artesano)
                    <tr style="border-bottom: 1px solid #f3f4f6;">
                        <td style="padding: 1rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; background-color: #dbeafe; color: #2563eb; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.875rem;">
                                    {{ substr($artesano->nombres, 0, 1) }}
                                </div>
                                <div>
                                    <p style="font-weight: 600; color: #1f2937; margin: 0;">{{ $artesano->nombres }} {{ $artesano->apellidos }}</p>
                                    <p style="font-size: 0.75rem; color: #6b7280; margin: 0;">DNI: {{ $artesano->dni ?? 'No registrado' }}</p>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 1rem; font-size: 0.875rem; color: #4b5563;">
                            <span style="padding: 0.25rem 0.75rem; background-color: #f3f4f6; border: 1px solid #e5e7eb; color: #374151; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 500;">
                                {{ $artesano->especialidad }}
                            </span>
                        </td>
                        <td style="padding: 1rem; font-size: 0.875rem; color: #4b5563;">{{ $artesano->telefono }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="padding: 2rem; text-align: center; font-size: 0.875rem; color: #6b7280;">
                            {{ __('panel.sin_registros') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- SCRIPT PARA ESCUCHAR EL SOCKET -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.Echo) {
                // Nos conectamos al canal 'panel'
                window.Echo.channel('panel')
                    .listen('ArtesanoCreado', (e) => {
                        console.log('¡Nuevo artesano detectado!', e);

                        // Actualiza el número de artesanos en la tarjeta azul
                        const contador = document.getElementById('total-artesanos');
                        if (contador) {
                            contador.innerText = e.nuevoTotal;
                        }
                    });
            } else {
                console.warn('Laravel Echo no está cargado. Revisa bootstrap.js y app.js');
            }
        });
    </script>
</x-app-layout>
