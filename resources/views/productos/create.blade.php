<x-app-layout>
    <x-slot name="header">
        Agregar Nuevo Producto
    </x-slot>

    <div style="padding: 2rem; background-color: #f8fafc; min-height: 100vh;">
        <div style="background-color: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 800px; margin: 0 auto;">

            <h2 style="font-size: 1.5rem; font-weight: 700; color: #1e293b; margin-bottom: 1.5rem;">Información del Producto</h2>

            @if($errors->any())
                <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                    <ul style="margin: 0; padding-left: 1.5rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- IMPORTANTE: enctype para subir imágenes -->
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <!-- Artesano -->
                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Artesano *</label>
                        <select name="artesano_id" required style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; background-color: white;">
                            <option value="">Selecciona un artesano...</option>
                            @foreach($artesanos as $artesano)
                                <option value="{{ $artesano->id }}" {{ old('artesano_id') == $artesano->id ? 'selected' : '' }}>
                                    {{ $artesano->nombres }} {{ $artesano->apellidos }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Nombre del Producto *</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 0.5rem;">
                    </div>

                    <!-- Descripción -->
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Descripción</label>
                        <textarea name="descripcion" rows="3" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; resize: vertical;">{{ old('descripcion') }}</textarea>
                    </div>

                    <!-- Precio -->
                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Precio (S/) *</label>
                        <input type="number" name="precio" step="0.01" min="0" value="{{ old('precio') }}" required style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 0.5rem;">
                    </div>

                    <!-- Categoría -->
                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Categoría *</label>
                        <input type="text" name="categoria" value="{{ old('categoria') }}" placeholder="Ej: Cerámica" required style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 0.5rem;">
                    </div>

                    <!-- Stock -->
                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Stock Disponible *</label>
                        <input type="number" name="stock" min="0" value="{{ old('stock', 10) }}" required style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 0.5rem;">
                    </div>

                    <!-- Imagen -->
                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Imagen del Producto</label>
                        <input type="file" name="imagen" accept="image/*" style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; background-color: #f8fafc;">
                        <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.25rem;">Cualquier formato de imagen (JPG, PNG, WEBP). Máx 2MB.</p>
                    </div>
                </div>

                <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                    <button type="submit" style="background-color: #10b981; color: white; padding: 0.6rem 1.5rem; border: none; border-radius: 0.5rem; font-weight: bold; cursor: pointer;">
                        Guardar Producto
                    </button>
                    <a href="{{ route('productos.index') }}" style="background-color: #f1f5f9; color: #475569; padding: 0.6rem 1.5rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-weight: bold; text-decoration: none;">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
