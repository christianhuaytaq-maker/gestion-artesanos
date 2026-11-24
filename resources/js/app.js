import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// ============================
// 🔔 TOAST DE NOTIFICACIÓN
// ============================
function mostrarNotificacionSocket(titulo, mensaje) {
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        bottom: 22px;
        right: 22px;
        z-index: 99999;
        background: linear-gradient(135deg, #1E1B4B 0%, #991B1B 100%);
        color: #FFFFFF;
        padding: 15px 18px;
        border-radius: 16px;
        border: 1px solid rgba(251, 191, 36, 0.55);
        box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.35);
        max-width: 340px;
        font-family: Inter, sans-serif;
    `;
    toast.innerHTML = `
        <div style="font-size: 0.72rem; font-weight: 800; color: #FDE68A; letter-spacing: 0.5px; text-transform: uppercase;">
            ⚡ En Vivo · WebSocket Reverb
        </div>
        <div style="font-weight: 800; font-size: 0.95rem; margin-top: 3px;">${titulo}</div>
        <div style="font-size: 0.83rem; color: #E2E8F0; margin-top: 4px; line-height: 1.4;">${mensaje}</div>
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 6500);
}

// ============================
// 🎙️ VOZ (speechSynthesis)
// ============================
function hablarEnVozAlta(texto, lang = 'es-PE') {
    if (!('speechSynthesis' in window) || !texto) return false;
    try {
        const u = new SpeechSynthesisUtterance(texto);
        u.lang = lang;
        u.rate = 1;
        u.pitch = 1;
        window.speechSynthesis.cancel();
        window.speechSynthesis.speak(u);
        return true;
    } catch (e) {
        console.warn('Error de voz:', e);
        return false;
    }
}
window.hablarEnVozAlta = hablarEnVozAlta;

// ============================
// 🔌 LISTENERS DE WEBSOCKET
// ============================
document.addEventListener('DOMContentLoaded', function () {
    if (!window.Echo) {
        console.warn('❌ Laravel Echo no está definido. Revisa bootstrap.js');
        return;
    }

    console.log('🔌 Conectando listeners de Echo...');

    // 1. Canal 'panel' — nuevo artesano
    window.Echo.channel('panel')
        .listen('ArtesanoCreado', (e) => {
            console.log('¡Socket recibido! Nuevo artesano:', e);

            const contador = document.getElementById('total-artesanos');
            if (contador && typeof e.nuevoTotal !== 'undefined') {
                contador.innerText = e.nuevoTotal;
            }

            mostrarNotificacionSocket(
                '🔔 ¡Aviso del Sistema!',
                'Se ha registrado un nuevo artesano. Total actual: ' + (e.nuevoTotal ?? '')
            );

            if (window.location.pathname === '/artesanos') {
                window.location.reload();
            }
        });

    // 2. Canal 'tienda-artesanos' — notificación de stock/actualización
    window.Echo.channel('tienda-artesanos')
        .listen('.notificacion.usuario', (e) => {
            console.log('¡Socket recibido! Notificación tienda:', e);

            if (typeof e.productId !== 'undefined' && typeof e.stock !== 'undefined' && typeof window.actualizarStockEnVista === 'function') {
                window.actualizarStockEnVista(e.productId, e.stock);
            }

            mostrarNotificacionSocket(
                e.titulo || 'Actualización en Vivo',
                e.mensaje || ''
            );

            // 🎙️ Voz automática del mensaje
            const textoVoz = (e.titulo || '') + '. ' + (e.mensaje || '');
            if (textoVoz.trim()) {
                hablarEnVozAlta(textoVoz);
            }
        });

    // 3. Canal 'artesanos' — ArtesanoActualizado (para voz en TODOS los navegadores)
    const manejarArtesanoActualizado = (e) => {
        console.log('¡Socket recibido! ArtesanoActualizado:', e);
        const usuario = e.usuario || e.user_name || 'Usuario';
        const msg = `Bienvenidos a nuestra tienda ${usuario}, gracias por confiar con nosotros. Si tienes alguna duda, no te olvides comunicarte con el administrador.`;
        mostrarNotificacionSocket('🎙️ Voz en Vivo', msg);
        hablarEnVozAlta(msg);
    };

    window.Echo.channel('artesanos')
        .listen('ArtesanoActualizado', manejarArtesanoActualizado)
        .listen('.ArtesanoActualizado', manejarArtesanoActualizado);

    // 4. Canal privado del usuario autenticado
    if (window.LaravelUserId) {
        window.Echo.private('App.Models.User.' + window.LaravelUserId)
            .listen('.notificacion.usuario', (e) => {
                console.log('¡Socket recibido! Notificación privada:', e);
                mostrarNotificacionSocket(
                    e.titulo || 'Tu Cuenta · En Vivo',
                    e.mensaje || ''
                );
                const textoVoz = (e.titulo || '') + '. ' + (e.mensaje || '');
                if (textoVoz.trim()) {
                    hablarEnVozAlta(textoVoz);
                }
            });
    }

    console.log('✅ Listeners de Echo registrados');
});
