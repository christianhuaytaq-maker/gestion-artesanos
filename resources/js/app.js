import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    if (window.Echo) {
        // Escuchamos el canal 'panel' en TODAS las pantallas de tu sistema
        window.Echo.channel('panel')
            .listen('ArtesanoCreado', (e) => {
                console.log('¡Socket recibido! Nuevo artesano:', e);

                // 1. Actualizar el contador si estamos en el Panel
                const contadorArtesanos = document.getElementById('total-artesanos');
                if (contadorArtesanos) {
                    contadorArtesanos.innerText = e.nuevoTotal;
                }

                // 2. Mostrar una alerta en la pantalla donde estés (Usuarios, Ventas, etc.)
                alert('🔔 ¡Aviso del Sistema!\n\nSe ha registrado un nuevo artesano.\nTotal actual: ' + e.nuevoTotal);

                // 3. Si estás en la lista de artesanos, recargar para ver el nuevo
                if (window.location.pathname === '/artesanos') {
                    window.location.reload();
                }
            });
    } else {
        console.warn('Laravel Echo no está definido. Revisa bootstrap.js');
    }
});
