<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido | Gestión y Comercialización de Productos Artesanales - Coracora</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap" rel="stylesheet">

    <style>
        :root {
            --crimson: #991B1B;
            --crimson-bright: #DC2626;
            --gold: #D97706;
            --gold-light: #FBBF24;
            --indigo-deep: #1E1B4B;
            --cyan-accent: #0891B2;
            --surface: #FFFFFF;
            --text-dark: #0F172A;
            --text-muted: #475569;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background:
                radial-gradient(circle at 12% 15%, rgba(220, 38, 38, 0.16), transparent 38%),
                radial-gradient(circle at 88% 18%, rgba(8, 145, 178, 0.18), transparent 40%),
                radial-gradient(circle at 50% 90%, rgba(217, 119, 6, 0.16), transparent 44%),
                linear-gradient(145deg, #FFFBEB 0%, #F8FAFC 48%, #EEF2FF 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            overflow-x: hidden;
            position: relative;
        }

        /* CAPA DE LUCES ARTIFICIALES Y BURBUJAS FLOTANTES */
        .bubbles-layer {
            position: fixed;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .ambient-orb {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(55px);
            z-index: 0;
            opacity: 0.58;
        }

        .orb-1 {
            width: 340px;
            height: 340px;
            top: -90px;
            left: -80px;
            background: rgba(220, 38, 38, 0.24);
            animation: driftOrbA 12s ease-in-out infinite alternate;
        }

        .orb-2 {
            width: 380px;
            height: 380px;
            bottom: -100px;
            right: -85px;
            background: rgba(8, 145, 178, 0.24);
            animation: driftOrbB 14s ease-in-out infinite alternate;
        }

        .orb-3 {
            width: 260px;
            height: 260px;
            top: 45%;
            left: 52%;
            background: rgba(251, 191, 36, 0.2);
            animation: driftOrbC 11s ease-in-out infinite alternate;
        }

        @keyframes driftOrbA {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(50px, 38px) scale(1.14); }
        }

        @keyframes driftOrbB {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-48px, -34px) scale(1.12); }
        }

        @keyframes driftOrbC {
            0% { transform: translate(-50%, -50%) scale(0.95); }
            100% { transform: translate(-42%, -58%) scale(1.15); }
        }

        /* BURBUJAS LUMINOSAS */
        .bubble {
            position: absolute;
            bottom: -120px;
            border-radius: 50%;
            opacity: 0;
            animation: riseBubble linear infinite;
            box-shadow:
                inset 0 0 14px rgba(255, 255, 255, 0.85),
                inset 4px 6px 12px rgba(255, 255, 255, 0.65),
                0 8px 22px rgba(30, 27, 75, 0.08);
        }

        .bubble::after {
            content: "";
            position: absolute;
            top: 16%;
            left: 20%;
            width: 28%;
            height: 18%;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.75);
            transform: rotate(-28deg);
        }

        .bubble--gold {
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.72), rgba(251, 191, 36, 0.22) 60%, rgba(217, 119, 6, 0.08) 100%);
            border: 1px solid rgba(251, 191, 36, 0.45);
        }

        .bubble--cyan {
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.72), rgba(6, 182, 212, 0.22) 60%, rgba(8, 145, 178, 0.08) 100%);
            border: 1px solid rgba(6, 182, 212, 0.42);
        }

        .bubble--crimson {
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.72), rgba(220, 38, 38, 0.2) 60%, rgba(153, 27, 27, 0.08) 100%);
            border: 1px solid rgba(220, 38, 38, 0.38);
        }

        .b1  { width: 28px; height: 28px; left: 7%;  animation-duration: 13s; animation-delay: 0s;    --sway: 24px;  --peak: 0.72; }
        .b2  { width: 52px; height: 52px; left: 16%; animation-duration: 18s; animation-delay: -5s;   --sway: -34px; --peak: 0.62; }
        .b3  { width: 20px; height: 20px; left: 26%; animation-duration: 11s; animation-delay: -2s;   --sway: 18px;  --peak: 0.78; }
        .b4  { width: 68px; height: 68px; left: 37%; animation-duration: 21s; animation-delay: -9s;   --sway: 40px;  --peak: 0.52; }
        .b5  { width: 24px; height: 24px; left: 48%; animation-duration: 12s; animation-delay: -7s;   --sway: -22px; --peak: 0.75; }
        .b6  { width: 46px; height: 46px; left: 59%; animation-duration: 16s; animation-delay: -3s;   --sway: 30px;  --peak: 0.65; }
        .b7  { width: 18px; height: 18px; left: 69%; animation-duration: 10s; animation-delay: -6s;   --sway: -18px; --peak: 0.8;  }
        .b8  { width: 60px; height: 60px; left: 79%; animation-duration: 19s; animation-delay: -11s;  --sway: -36px; --peak: 0.56; }
        .b9  { width: 32px; height: 32px; left: 88%; animation-duration: 14s; animation-delay: -4s;   --sway: 26px;  --peak: 0.7;  }
        .b10 { width: 42px; height: 42px; left: 94%; animation-duration: 17s; animation-delay: -8s;   --sway: -28px; --peak: 0.6;  }

        @keyframes riseBubble {
            0% {
                transform: translateY(0) translateX(0) scale(0.85);
                opacity: 0;
            }
            12% {
                opacity: var(--peak, 0.65);
            }
            50% {
                transform: translateY(-52vh) translateX(var(--sway, 25px)) scale(1.04);
            }
            88% {
                opacity: var(--peak, 0.65);
            }
            100% {
                transform: translateY(-112vh) translateX(calc(var(--sway, 25px) * -0.5)) scale(0.95);
                opacity: 0;
            }
        }

        /* TARJETA PRINCIPAL FLOTANTE */
        .auth-shell {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1040px;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.92);
            border-radius: 30px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1.08fr 0.92fr;
            box-shadow:
                0 32px 70px -18px rgba(30, 27, 75, 0.25),
                0 0 0 1px rgba(217, 119, 6, 0.16);
            animation: cardEntrance 0.65s cubic-bezier(0.22, 1, 0.36, 1) both,
                       shellFloat 7s ease-in-out 0.7s infinite;
            transition: box-shadow 0.35s ease, transform 0.35s ease;
        }

        .auth-shell:hover {
            box-shadow:
                0 38px 80px -16px rgba(30, 27, 75, 0.3),
                0 0 0 1px rgba(217, 119, 6, 0.28);
        }

        @keyframes cardEntrance {
            0% {
                opacity: 0;
                transform: translateY(24px) scale(0.98);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes shellFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }

        /* PANEL IZQUIERDO: IDENTIDAD VISUAL CON LUCES ARTIFICIALES */
        .brand-panel {
            background:
                radial-gradient(circle at 20% 15%, rgba(251, 191, 36, 0.28), transparent 45%),
                radial-gradient(circle at 85% 85%, rgba(6, 182, 212, 0.28), transparent 45%),
                linear-gradient(160deg, #1E1B4B 0%, #450A0A 58%, #0F172A 100%);
            color: #FFFFFF;
            padding: 2.5rem 2.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* HACES DE LUZ ARTIFICIAL DETRÁS DEL LOGO */
        .brand-panel::before {
            content: "";
            position: absolute;
            width: 310px;
            height: 310px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -54%);
            border-radius: 50%;
            background: radial-gradient(circle, rgba(251, 191, 36, 0.32) 0%, rgba(220, 38, 38, 0.14) 45%, transparent 72%);
            filter: blur(18px);
            animation: spotlightPulse 4s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        .brand-panel > * {
            position: relative;
            z-index: 1;
        }

        @keyframes spotlightPulse {
            0%, 100% { transform: translate(-50%, -54%) scale(0.94); opacity: 0.78; }
            50% { transform: translate(-50%, -54%) scale(1.12); opacity: 1; }
        }

        .brand-ribbon {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(251, 191, 36, 0.16);
            border: 1px solid rgba(251, 191, 36, 0.48);
            color: #FDE68A;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.9px;
            text-transform: uppercase;
            padding: 0.38rem 0.9rem;
            border-radius: 999px;
            margin-bottom: 1.25rem;
            animation: pulseBadge 3.5s ease-in-out infinite;
        }

        @keyframes pulseBadge {
            0%, 100% { box-shadow: 0 0 0 0 rgba(251, 191, 36, 0.25); }
            50% { box-shadow: 0 0 0 8px rgba(251, 191, 36, 0); }
        }

        .logo-frame {
            background: transparent;
            border: none;
            box-shadow: none;
            padding: 0;
            width: 100%;
            max-width: 390px;
            min-height: 215px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.2rem;
            overflow: visible;
        }

        .logo-frame img {
            width: 100%;
            height: 220px;
            object-fit: contain;
            display: block;
            border-radius: 16px;
            animation: logoFloat 4.2s ease-in-out infinite;
            transition: transform 0.35s ease, filter 0.35s ease;
        }

        .logo-frame img:hover {
            transform: scale(1.06);
            filter: drop-shadow(0 20px 32px rgba(251, 191, 36, 0.45));
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0px);
                filter: drop-shadow(0 14px 24px rgba(0, 0, 0, 0.45));
            }
            50% {
                transform: translateY(-9px);
                filter: drop-shadow(0 22px 32px rgba(251, 191, 36, 0.25));
            }
        }

        .logo-fallback-card {
            width: 100%;
            padding: 1rem 1.15rem;
            border-radius: 16px;
            background: rgba(255, 251, 235, 0.95);
            border: 1px dashed rgba(251, 191, 36, 0.7);
            text-align: center;
        }

        .logo-fallback-badge {
            display: inline-block;
            background: var(--crimson);
            color: #FDE68A;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            padding: 0.22rem 0.65rem;
            border-radius: 999px;
            margin-bottom: 0.45rem;
        }

        .logo-fallback-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--crimson);
            margin: 0 0 0.25rem 0;
        }

        .logo-fallback-sub {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--indigo-deep);
            margin: 0 0 0.45rem 0;
        }

        .logo-fallback-hint {
            font-size: 0.72rem;
            color: var(--text-muted);
            line-height: 1.35;
        }

        .logo-fallback-hint code {
            background: #FEF3C7;
            color: #0F172A;
            padding: 0.12rem 0.38rem;
            border-radius: 5px;
        }

        .brand-panel h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.55rem;
            font-weight: 800;
            margin: 0 0 0.45rem 0;
            color: #FFFFFF;
        }

        .brand-panel p {
            margin: 0;
            font-size: 0.88rem;
            color: #E2E8F0;
            line-height: 1.55;
            max-width: 360px;
        }

        /* PANEL DERECHO: ACCESO */
        .form-panel {
            padding: 2.75rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #FFFFFF;
        }

        .top-accent-bar {
            width: 64px;
            height: 5px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--crimson-bright), var(--gold-light), var(--cyan-accent));
            margin-bottom: 1rem;
        }

        .form-panel h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 800;
            margin: 0 0 0.55rem 0;
            color: var(--text-dark);
            line-height: 1.15;
        }

        .form-subtitle {
            color: var(--text-muted);
            font-size: 0.92rem;
            line-height: 1.6;
            margin: 0 0 1.6rem 0;
        }

        .feature-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-bottom: 1.85rem;
        }

        .feature-chip {
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            padding: 0.7rem 0.85rem;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease;
        }

        .feature-chip:hover {
            transform: translateY(-3px);
            border-color: rgba(217, 119, 6, 0.5);
            box-shadow: 0 10px 20px -10px rgba(15, 23, 42, 0.16);
        }

        .action-stack {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .btn-primary-premium {
            position: relative;
            overflow: hidden;
            width: 100%;
            text-align: center;
            text-decoration: none;
            padding: 0.92rem 1.25rem;
            border-radius: 14px;
            font-weight: 800;
            font-size: 0.94rem;
            color: #FFFFFF;
            background: linear-gradient(135deg, var(--crimson) 0%, var(--crimson-bright) 55%, var(--gold) 140%);
            box-shadow: 0 12px 24px -8px rgba(185, 28, 28, 0.45);
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }

        .btn-primary-premium::after {
            content: "";
            position: absolute;
            top: 0;
            left: -120%;
            width: 65%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.28), transparent);
            transform: skewX(-20deg);
            animation: shineSweep 4.5s ease-in-out infinite;
        }

        @keyframes shineSweep {
            0%, 72% { left: -120%; }
            100% { left: 160%; }
        }

        .btn-primary-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 30px -8px rgba(185, 28, 28, 0.58);
        }

        .btn-secondary-premium {
            width: 100%;
            text-align: center;
            text-decoration: none;
            padding: 0.86rem 1.25rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--indigo-deep);
            background: #EEF2FF;
            border: 1px solid #C7D2FE;
            transition: all 0.22s ease;
        }

        .btn-secondary-premium:hover {
            background: #E0E7FF;
            border-color: #818CF8;
            transform: translateY(-2px);
        }

        .store-link-row {
            margin-top: 1.35rem;
            padding-top: 1.1rem;
            border-top: 1px solid #F1F5F9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .store-link-row a {
            color: var(--cyan-accent);
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .store-link-row a:hover {
            color: var(--crimson-bright);
            text-decoration: underline;
        }

        @media (prefers-reduced-motion: reduce) {
            .ambient-orb,
            .bubble,
            .auth-shell,
            .brand-panel::before,
            .brand-ribbon,
            .logo-frame img,
            .btn-primary-premium::after {
                animation: none !important;
            }
        }

        @media (max-width: 880px) {
            .auth-shell { grid-template-columns: 1fr; }
            .brand-panel { padding: 2rem 1.5rem; }
            .form-panel { padding: 2rem 1.5rem; }
            .feature-list { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- LUCES ARTIFICIALES DE FONDO -->
    <div class="ambient-orb orb-1" aria-hidden="true"></div>
    <div class="ambient-orb orb-2" aria-hidden="true"></div>
    <div class="ambient-orb orb-3" aria-hidden="true"></div>

    <!-- BURBUJAS FLOTANTES -->
    <div class="bubbles-layer" aria-hidden="true">
        <span class="bubble bubble--gold b1"></span>
        <span class="bubble bubble--cyan b2"></span>
        <span class="bubble bubble--crimson b3"></span>
        <span class="bubble bubble--gold b4"></span>
        <span class="bubble bubble--cyan b5"></span>
        <span class="bubble bubble--crimson b6"></span>
        <span class="bubble bubble--gold b7"></span>
        <span class="bubble bubble--cyan b8"></span>
        <span class="bubble bubble--gold b9"></span>
        <span class="bubble bubble--crimson b10"></span>
    </div>

    <div class="auth-shell">
        <!-- IZQUIERDA: LOGO OFICIAL DE CORACORA -->
        <section class="brand-panel">
            <span class="brand-ribbon">✦ Coracora · Tierra de Arte, Cultura y Tradición</span>

            <div class="logo-frame">
                <img id="coracoraLogoImg"
                     src="{{ asset('images/' . rawurlencode('logo_original-.png')) }}"
                     alt="Gestión y Comercialización de Productos Artesanales - Coracora"
                     data-fallbacks='[
                         "{{ asset("images/logo_original-.png") }}",
                         "{{ asset("images/logo-coracora.png") }}",
                         "{{ asset("images/" . rawurlencode("logo original.jpeg")) }}"
                     ]'
                     onerror="handleLogoFallback(this)">
            </div>

            <h2>Juntos Impulsamos lo Nuestro</h2>
            <p>Plataforma centralizada para la gestión de artesanos, control de inventario y comercialización de productos hechos a mano.</p>
        </section>

        <!-- DERECHA: ACCESO AL SISTEMA -->
        <section class="form-panel">
            <div class="top-accent-bar"></div>
            <h1>Gestión de Artesanos</h1>
            <p class="form-subtitle">
                Bienvenido al sistema centralizado de gestión. Administra productos, controla inventarios y gestiona usuarios.
            </p>

            <div class="feature-list">
                <div class="feature-chip">🧶 Control de Stock</div>
                <div class="feature-chip">🎨 Catálogo Artesanal</div>
                <div class="feature-chip">👥 Gestión de Usuarios</div>
                <div class="feature-chip">🌎 Multiidioma ES/EN/QU</div>
            </div>

            <div class="action-stack">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn-primary-premium">Iniciar Sesión</a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-secondary-premium">Registrarse</a>
                @endif
            </div>

            <div class="store-link-row">
                <span>¿Solo deseas explorar los productos?</span>
                @if (Route::has('catalogo'))
                    <a href="{{ route('catalogo') }}">Ir a la Tienda Pública →</a>
                @endif
            </div>
        </section>
    </div>

    <script>
        function handleLogoFallback(imgEl) {
            try {
                const list = JSON.parse(imgEl.getAttribute('data-fallbacks') || '[]');
                const idx = Number(imgEl.getAttribute('data-fb-idx') || '0');
                if (idx < list.length) {
                    imgEl.setAttribute('data-fb-idx', String(idx + 1));
                    imgEl.src = list[idx];
                    return;
                }
            } catch (e) {}

            imgEl.parentElement.innerHTML = `
                <div class="logo-fallback-card">
                    <span class="logo-fallback-badge">Coracora · Identidad Oficial</span>
                    <div class="logo-fallback-title">Productos Artesanales</div>
                    <div class="logo-fallback-sub">Juntos impulsamos lo nuestro</div>
                    <div class="logo-fallback-hint">
                        Verifica que exista<br>
                        <code>public/images/logo_original-.png</code>
                    </div>
                </div>
            `;
        }
    </script>

</body>
</html>
