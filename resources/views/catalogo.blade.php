<x-app-layout>
    <x-slot name="header">
        Catálogo de Artesanos
    </x-slot>

    <div style="padding: 2rem; background-color: #f8fafc; min-height: 100vh;">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
            <div style="background-color: #10b981; padding: 0.75rem; border-radius: 0.5rem; color: white;">
                <svg style="width: 2rem; height: 2rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div>
                <h1 style="font-size: 1.875rem; font-weight: 800; color: #1e293b; margin: 0;">Productos Disponibles</h1>
                <p style="color: #64748b; margin: 0;">Explora las creaciones de nuestros artesanos</p>
            </div>
        </div>

        @if(session('success'))
            <div style="background-color: #d1fae5; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; font-weight: bold;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; font-weight: bold;">{{ session('error') }}</div>
        @endif

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
            @forelse($productos as $producto)
            <div style="background-color: white; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; overflow: hidden; display: flex; flex-direction: column;">

                <!-- IMAGEN DEL PRODUCTO (Base64 desde la Base de Datos) -->
                <div style="height: 200px; background-color: #e2e8f0; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    @if($producto->imagen)
                        <!-- Imprimimos el texto Base64 directo -->
                        <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <svg style="width: 4rem; height: 4rem; color: #94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    @endif
                </div>

                <!-- Cabecera (Categoría) -->
                <div style="background-color: #f1f5f9; padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0;">
                    <span style="background-color: #d1fae5; color: #065f46; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">{{ $producto->categoria }}</span>
                </div>

                <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-top: 0; margin-bottom: 0.5rem;">{{ $producto->nombre }}</h3>
                    <p style="font-size: 0.875rem; color: #64748b; margin-bottom: 1.5rem; line-height: 1.5; flex: 1;">{{ $producto->descripcion }}</p>

                    <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-top: auto;">
                        <div>
                            <p style="font-size: 0.75rem; color: #94a3b8; margin: 0; text-transform: uppercase; font-weight: 600;">Precio</p>
                            <p style="font-size: 1.5rem; font-weight: 800; color: #0f172a; margin: 0;">S/ {{ number_format($producto->precio, 2) }}</p>
                        </div>
                    </div>

                    <!-- COMPRA -->
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #e2e8f0;">
                        <p style="font-size: 0.8rem; color: #64748b; margin-bottom: 0.5rem;">Stock: <strong>{{ $producto->stock ?? '0' }}</strong></p>
                        @if(($producto->stock ?? 0) > 0)
                            <form action="{{ route('ventas.store') }}" method="POST" style="display: flex; gap: 0.5rem;">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <input type="text" name="dni_cliente" placeholder="Tu DNI" required style="width: 100px; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 0.375rem; font-size: 0.8rem;">
                                <button type="submit" style="background-color: #10b981; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: bold; cursor: pointer; flex: 1;">Comprar</button>
                            </form>
                        @else
                            <div style="background-color: #fee2e2; color: #991b1b; padding: 0.5rem; border-radius: 0.375rem; text-align: center; font-size: 0.875rem; font-weight: bold;">Agotado</div>
                        @endif
                    </div>
                </div>

                <div style="background-color: #f8fafc; padding: 1rem 1.5rem; border-top: 1px solid #e2e8f0; display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 2rem; height: 2rem; background-color: #cbd5e1; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #475569; font-size: 0.875rem;">{{ substr($producto->artesano->nombres ?? 'A', 0, 1) }}</div>
                    <p style="font-size: 0.75rem; color: #64748b; margin: 0;">Por <strong style="color: #334155;">{{ $producto->artesano->nombres ?? 'Artesano' }} {{ $producto->artesano->apellidos ?? '' }}</strong></p>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; background-color: white; padding: 3rem; border-radius: 0.75rem; text-align: center; border: 2px dashed #cbd5e1;">
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin: 0;">No hay productos disponibles</h3>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
