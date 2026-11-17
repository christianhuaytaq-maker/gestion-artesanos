<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla de Notificaciones en Vivo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #0f172a; color: white; font-family: sans-serif; display: flex; flex-direction: column; height: 100vh; margin: 0; overflow: hidden; }
        .header { text-align: center; padding: 2rem; }
        .title { font-size: 3rem; font-weight: bold; color: #3b82f6; text-transform: uppercase; letter-spacing: 0.1em; margin: 0; }

        .main-content { display: flex; flex: 1; padding: 2rem; gap: 2rem; }

        /* Caja del contador */
        .counter-box { background-color: #1e293b; border: 4px solid #10b981; border-radius: 1rem; padding: 3rem; box-shadow: 0 0 50px rgba(16, 185, 129, 0.3); text-align: center; flex: 1; display: flex; flex-direction: column; justify-content: center; }
        .counter-number { font-size: 12rem; font-weight: 900; color: #10b981; margin: 0; line-height: 1; transition: all 0.3s ease; }

        /* Consola de eventos (Noticiero) */
        .news-box { background-color: #1e293b; border-radius: 1rem; padding: 2rem; flex: 2; display: flex; flex-direction: column; border: 1px solid #334155; }
        .news-title { font-size: 1.5rem; color: #94a3b8; border-bottom: 1px solid #334155; padding-bottom: 1rem; margin-top: 0; }
        .news-list { flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 1rem; }

        /* Tarjeta de noticia */
        .news-item { background-color: #0f172a; border-left: 6px solid #f59e0b; padding: 1.5rem; border-radius: 0.5rem; animation: slideIn 0.5s ease-out; }

        /* El nombre del artesano (Lo primero que se lee) */
        .news-item .name { font-size: 2rem; font-weight: bold; color: #f59e0b; margin: 0; }
        /* El rol del artesano */
        .news-item .role { font-size: 1.2rem; color: #cbd5e1; margin: 0.5rem 0 0 0; }

        /* El mensaje de felicitaciones */
        .news-item .greeting {
            font-size: 1.5rem;
            color: #34d399;
            font-weight: bold;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px dashed #334155;
            display: none; /* Oculto al principio */
            animation: bounceIn 0.8s ease-out forwards;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); display: block; }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1 class="title">Sistema de Artesanos</h1>
    </div>

    <div class="main-content">
        <!-- Lado Izquierdo: El Contador Total -->
        <div class="counter-box" id="tv-box">
            <p style="font-size: 1.5rem; color: #94a3b8;">Total de Artesanos</p>
            <p class="counter-number" id="tv-contador">0</p>
        </div>

        <!-- Lado Derecho: El Noticiero en Vivo -->
        <div class="news-box">
            <h2 class="news-title">🔴 Últimas Noticias en Vivo</h2>
            <div class="news-list" id="news-list">
                <p style="color: #64748b; text-align: center; margin-top: 2rem;">Esperando nuevos registros...</p>
            </div>
        </div>
    </div>

    <script>
        // --- FUNCIÓN DE VOZ (SÍNTESIS DE VOZ) ---
        function speak(text) {
            if ('speechSynthesis' in window) {
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'es-ES'; // Voz en español
                utterance.rate = 1;       // Velocidad normal
                utterance.pitch = 1;      // Tono normal
                window.speechSynthesis.speak(utterance);
            } else {
                console.warn('Tu navegador no soporta síntesis de voz.');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            if (window.Echo) {
                window.Echo.channel('panel')
                    .listen('ArtesanoCreado', (e) => {
                        console.log('¡Evento recibido en la TV!', e);

                        // 1. Actualizar el número
                        const contador = document.getElementById('tv-contador');
                        contador.innerText = e.nuevoTotal;

                        // Efecto de parpadeo en el contador
                        const box = document.getElementById('tv-box');
                        box.style.transform = 'scale(1.05)';
                        box.style.borderColor = '#f59e0b';
                        setTimeout(() => {
                            box.style.transform = 'scale(1)';
                            box.style.borderColor = '#10b981';
                        }, 1000);

                        // 2. Agregar la noticia al listado
                        const lista = document.getElementById('news-list');

                        // Eliminar el mensaje de "Esperando..."
                        const placeholder = lista.querySelector('p');
                        if (placeholder) placeholder.remove();

                        // Crear la nueva tarjeta de noticia
                        const nuevaNoticia = document.createElement('div');
                        nuevaNoticia.className = 'news-item';

                        nuevaNoticia.innerHTML = `
                            <p class="name">👤 ${e.nombreArtesano}</p>
                            <p class="role">Se acaba de registrar como <strong>${e.especialidad}</strong></p>
                            <p class="greeting">🎉 ¡FELICIDADES!</p>
                        `;

                        // Poner la noticia al principio de la lista
                        lista.prepend(nuevaNoticia);

                        // 3. Mostrar el "¡Felicidades!" después de un momento
                        const greetingElement = nuevaNoticia.querySelector('.greeting');

                        // --- LÓGICA DE VOZ ---
                        // Primero lee el nombre del artesano
                        speak(`Nuevo artesano registrado: ${e.nombreArtesano}. Especialidad: ${e.especialidad}`);

                        // Después de 2 segundos, lee el "¡Felicidades!"
                        setTimeout(() => {
                            greetingElement.style.display = 'block';
                            speak('¡Felicidades!');
                        }, 2500); // 2.5 segundos después
                    });
            } else {
                console.error('Echo no está cargado. Revisa app.js');
            }
        });
    </script>
</body>
</html>
