<x-app-layout>
    <x-slot name="header">
        👥 Lista de Artesanos
    </x-slot>

    <div class="max-w-7xl mx-auto">
        
        <!-- Encabezado y Botón Crear -->
        <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <!-- Buscador (Aprovechando la lógica de tu controlador) -->
            <form action="{{ route('artesanos.index') }}" method="GET" class="flex w-full md:w-1/2 gap-2">
                <input type="text" name="buscar" placeholder="Buscar por DNI, nombres o apellidos..." value="{{ request('buscar') }}" 
                       class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2 border">
                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition">
                    🔍 Buscar
                </button>
            </form>

            <a href="{{ route('artesanos.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nuevo Artesano
            </a>
        </div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tarjeta de la Tabla -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                            <th class="py-3 px-4 border-b">DNI</th>
                            <th class="py-3 px-4 border-b">Nombres y Apellidos</th>
                            <th class="py-3 px-4 border-b">Teléfono</th>
                            <th class="py-3 px-4 border-b">Especialidad</th>
                            <th class="py-3 px-4 border-b text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @forelse($artesanos as $artesano)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $artesano->dni }}</td>
                                <td class="py-3 px-4 font-medium text-gray-900">{{ $artesano->nombres }} {{ $artesano->apellidos }}</td>
                                <td class="py-3 px-4">{{ $artesano->telefono ?? '-' }}</td>
                                <td class="py-3 px-4">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                        {{ $artesano->especialidad ?? 'Sin asignar' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <div class="flex item-center justify-center gap-2">
                                        <!-- Botón Editar (Usando Route::resource) -->
                                        <a href="{{ route('artesanos.edit', $artesano) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                            ✏️ Editar
                                        </a>
                                        
                                        <!-- Botón Eliminar (Usando Route::resource) -->
                                        <form action="{{ route('artesanos.destroy', $artesano) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar a este artesano?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 px-4 text-center text-gray-500">
                                    No se encontraron artesanos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>