<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear una Cuenta | Gestión de Artesanos - Coracora</title>

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
            --danger: #DC2626;
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

        .ambient-orb {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(55px);
            z-index: 0;
            opacity: 0.55;
        }

        .orb-1 {
            width: 320px;
            height: 320px;
            top: -80px;
            left: -70px;
            background: rgba(220, 38, 38, 0.22);
            animation: driftOrbA 12s ease-in-out infinite alternate;
        }

        .orb-2 {
            width: 360px;
            height: 360px;
            bottom: -90px;
            right: -80px;
            background: rgba(8, 145, 178, 0.22);
            animation: driftOrbB 14s ease-in-out infinite alternate;
        }

        @keyframes driftOrbA {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(45px, 35px) scale(1.12); }
        }

        @keyframes driftOrbB {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-45px, -30px) scale(1.1); }
        }

        .register-shell {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1060px;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.92);
            border-radius: 30px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 0.98fr 1.02fr;
            box-shadow:
                0 32px 70px -18px rgba(30, 27, 75, 0.25),
                0 0 0 1px rgba(217, 119, 6, 0.16);
            animation: cardEntrance 0.65s cubic-bezier(0.22, 1, 0.36, 1) both,
                       shellFloat 7s ease-in-out 0.7s infinite;
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

        /* PANEL IZQUIERDO: IDENTIDAD VISUAL DE CORACORA */
        .brand-panel {
            background:
                radial-gradient(circle at 20% 15%, rgba(251, 191, 36, 0.24), transparent 45%),
                radial-gradient(circle at 85% 85%, rgba(6, 182, 212, 0.24), transparent 45%),
                linear-gradient(160deg, #1E1B4B 0%, #450A0A 58%, #0F172A 100%);
            color: #FFFFFF;
            padding: 2.5rem 2.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
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
            transform: scale(1.05);
            filter: drop-shadow(0 20px 30px rgba(251, 191, 36, 0.35));
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0px);
                filter: drop-shadow(0 14px 24px rgba(0, 0, 0, 0.45));
            }
            50% {
                transform: translateY(-9px);
                filter: drop-shadow(0 22px 30px rgba(0, 0, 0, 0.55));
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

        /* PANEL DERECHO: FORMULARIO DE REGISTRO */
        .form-panel {
            padding: 2.35rem 2.4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #FFFFFF;
        }

        .form-top-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .top-accent-bar {
            width: 64px;
            height: 5px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--crimson-bright), var(--gold-light), var(--cyan-accent));
        }

        .lang-switcher {
            display: inline-flex;
            align-items: center;
            background: #0F172A;
            padding: 3px;
            border-radius: 999px;
            border: 1px solid #1E293B;
        }

        .lang-btn {
            background: transparent;
            border: none;
            color: #94A3B8;
            font-family: inherit;
            font-size: 0.72rem;
            font-weight: 800;
            padding: 0.3rem 0.58rem;
            border-radius: 999px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .lang-btn:hover { color: #FFFFFF; }
        .lang-btn.active {
            background: linear-gradient(135deg, var(--crimson-bright), var(--gold));
            color: #FFFFFF;
        }

        .form-panel h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            font-weight: 800;
            margin: 0 0 0.3rem 0;
            color: var(--text-dark);
        }

        .form-subtitle {
            color: var(--text-muted);
            font-size: 0.88rem;
            margin: 0 0 1.3rem 0;
        }

        .field-group {
            margin-bottom: 0.92rem;
        }

        .field-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.35rem;
        }

        .field-input {
            width: 100%;
            padding: 0.74rem 0.92rem;
            border-radius: 13px;
            border: 1.5px solid #CBD5E1;
            background: #F8FAFC;
            font-family: inherit;
            font-size: 0.88rem;
            color: var(--text-dark);
            outline: none;
            transition: all 0.2s ease;
        }

        .field-input:focus {
            background: #FFFFFF;
            border-color: var(--crimson-bright);
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.12);
        }

        .error-text {
            color: var(--danger);
            font-size: 0.76rem;
            font-weight: 600;
            margin-top: 0.3rem;
        }

        .btn-submit-register {
            position: relative;
            overflow: hidden;
            width: 100%;
            border: none;
            margin-top: 0.45rem;
            padding: 0.9rem 1.25rem;
            border-radius: 14px;
            font-family: inherit;
            font-weight: 800;
            font-size: 0.94rem;
            color: #FFFFFF;
            background: linear-gradient(135deg, var(--crimson) 0%, var(--crimson-bright) 55%, var(--gold) 140%);
            box-shadow: 0 12px 24px -8px rgba(185, 28, 28, 0.45);
            cursor: pointer;
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }

        .btn-submit-register::after {
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

        .btn-submit-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 30px -8px rgba(185, 28, 28, 0.58);
        }

        .form-footer-links {
            margin-top: 1.2rem;
            padding-top: 1rem;
            border-top: 1px solid #F1F5F9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.6rem;
            font-size: 0.82rem;
        }

        .form-footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer-links a:hover {
            color: var(--crimson-bright);
            text-decoration: underline;
        }

        .form-footer-links a.highlight-link {
            color: var(--cyan-accent);
            font-weight: 700;
        }

        @media (prefers-reduced-motion: reduce) {
            .ambient-orb,
            .register-shell,
            .brand-ribbon,
            .logo-frame img,
            .btn-submit-register::after {
                animation: none !important;
            }
        }

        @media (max-width: 880px) {
            .register-shell { grid-template-columns: 1fr; }
            .brand-panel { padding: 2rem 1.5rem; }
            .form-panel { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>

    <div class="ambient-orb orb-1" aria-hidden="true"></div>
    <div class="ambient-orb orb-2" aria-hidden="true"></div>

    <div class="register-shell">
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
            <p>Crea tu cuenta para administrar productos, controlar stock y gestionar la plataforma de artesanos.</p>
        </section>

        <!-- DERECHA: FORMULARIO DE REGISTRO -->
        <section class="form-panel">
            <div class="form-top-row">
                <div class="top-accent-bar"></div>
                <div class="lang-switcher" title="Cambiar idioma">
                    <button type="button" class="lang-btn active" data-lang="es" onclick="setRegisterLang('es')">ES</button>
                    <button type="button" class="lang-btn" data-lang="en" onclick="setRegisterLang('en')">EN</button>
                    <button type="button" class="lang-btn" data-lang="qu" onclick="setRegisterLang('qu')">QU</button>
                </div>
            </div>

            <h1 data-i18n="title">Crear una Cuenta</h1>
            <p class="form-subtitle" data-i18n="subtitle">Regístrate para poder acceder al sistema de gestión.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field-group">
                    <label for="name" class="field-label" data-i18n="nameLabel">Nombre Completo</label>
                    <input id="name"
                           type="text"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           autofocus
                           autocomplete="name"
                           placeholder="Ej. César Augusto Guardia"
                           class="field-input">
                    @error('name')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="email" class="field-label" data-i18n="emailLabel">Correo Electrónico</label>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="username"
                           placeholder="correo@artesanos.com"
                           class="field-input">
                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="password" class="field-label" data-i18n="passwordLabel">Contraseña</label>
                    <input id="password"
                           type="password"
                           name="password"
                           required
                           autocomplete="new-password"
                           placeholder="••••••••"
                           class="field-input">
                    @error('password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="password_confirmation" class="field-label" data-i18n="confirmLabel">Confirmar Contraseña</label>
                    <input id="password_confirmation"
                           type="password"
                           name="password_confirmation"
                           required
                           autocomplete="new-password"
                           placeholder="••••••••"
                           class="field-input">
                    @error('password_confirmation')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit-register" data-i18n="submitBtn">Registrarse</button>
            </form>

            <div class="form-footer-links">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" data-i18n="hasAccount">¿Ya tienes cuenta? Inicia Sesión</a>
                @endif

                @if (Route::has('catalogo'))
                    <a href="{{ route('catalogo') }}" class="highlight-link" data-i18n="goStore">Ver Tienda Pública →</a>
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

        const REGISTER_I18N = {
            es: {
                title: 'Crear una Cuenta',
                subtitle: 'Regístrate para poder acceder al sistema de gestión.',
                nameLabel: 'Nombre Completo',
                emailLabel: 'Correo Electrónico',
                passwordLabel: 'Contraseña',
                confirmLabel: 'Confirmar Contraseña',
                submitBtn: 'Registrarse',
                hasAccount: '¿Ya tienes cuenta? Inicia Sesión',
                goStore: 'Ver Tienda Pública →'
            },
            en: {
                title: 'Create an Account',
                subtitle: 'Sign up to access the management system.',
                nameLabel: 'Full Name',
                emailLabel: 'Email Address',
                passwordLabel: 'Password',
                confirmLabel: 'Confirm Password',
                submitBtn: 'Register',
                hasAccount: 'Already have an account? Sign In',
                goStore: 'View Public Store →'
            },
            qu: {
                title: 'Musuq Cuenta Ruray',
                subtitle: 'Qillqakuy sistemaman yaykunaykipaq.',
                nameLabel: 'Hunt’asqa Suti',
                emailLabel: 'Correo Electrónico',
                passwordLabel: 'Pakasqa Simi',
                confirmLabel: 'Pakasqa Simita Takyay',
                submitBtn: 'Qillqakuy',
                hasAccount: '¿Kanchuñachu cuentayki? Yaykuy',
                goStore: 'Rantina Tiendata Rikuy →'
            }
        };

        const LANG_KEY = 'artesanos_store_lang_v1';

        function setRegisterLang(lang) {
            const chosen = REGISTER_I18N[lang] ? lang : 'es';
            localStorage.setItem(LANG_KEY, chosen);

            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.lang === chosen);
            });

            const dict = REGISTER_I18N[chosen];
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const k = el.getAttribute('data-i18n');
                if (dict[k]) el.textContent = dict[k];
            });
        }

        setRegisterLang(localStorage.getItem(LANG_KEY) || 'es');
    </script>

</body>
</html>
