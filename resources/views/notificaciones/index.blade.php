<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🔔 Notificaciones en Tiempo Real (Socket)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Tarjeta del Contador -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">Total de Artesanos Registrados:</h3>
                    <p id="contador-vivo" class="text-5xl font-black text-blue-600">{{ $totalArtesanos }}</p>
                    <p class="text-sm text-gray-500 mt-2">Este número se actualiza automáticamente sin recargar la página.</p>
                </div>
            </div>

            <!-- Consola de Eventos en Vivo -->
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 border-b border-gray-700 flex justify-between items-center">
                    <span class="text-green-400 font-mono text-sm">● WebSocket Conectado</span>
                    <span class="text-gray-400 font-mono text-xs">Canal: #panel</span>
                </div>
                <div id="consola-eventos" class="p-4 h-64 overflow-y-auto font-mono text-sm text-gray-300">
                    <p class="text-gray-500">// Esperando eventos del socket...</p>
                </div>
            </div>

        </div>
    </div>

    <!-- EL SCRIPT DEL SOCKET SOLO PARA ESTA PANTALLA -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.Echo) {
                window.Echo.channel('panel')
                    .listen('ArtesanoCreado', (e) => {
                        // 1. Actualizar el contador grande
                        document.getElementById('contador-vivo').innerText = e.nuevoTotal;

                        // 2. Escribir en la consola visual
                        const consola = document.getElementById('consola-eventos');
                        const hora = new Date().toLocaleTimeString();

                        // Quitar el texto de "Esperando..."
                        const placeholder = consola.querySelector('.text-gray-500');
                        if (placeholder) placeholder.remove();

                        // Agregar el nuevo mensaje
                        const nuevoMensaje = document.createElement('div');
                        nuevoMensaje.className = 'mb-1 text-green-400';
                        nuevoMensaje.innerHTML = `<span class="text-gray-500">[${hora}]</span> 🎉 Evento 'ArtesanoCreado' recibido. Nuevo total: <strong>${e.nuevoTotal}</strong>`;
                        consola.appendChild(nuevoMensaje);
                    });
            }
        });
    </script>
</x-app-layout>
