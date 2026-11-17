<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - Gestión de Artesanos</title>
    <style>
        /* RESET BÁSICO */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', system-ui, sans-serif; background-color: #0f172a; color: #1e293b; }

        /* FONDO ANIMADO Y CUADRÍCULA */
        .reset-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image:
                radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%),
                radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%),
                radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
            position: relative;
            overflow: hidden;
            padding: 20px;
        }

        /* Cuadrícula sutil */
        .reset-wrapper::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: 1;
        }

        /* Luces flotantes de fondo */
        .bg-glow-1, .bg-glow-2 {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            filter: blur(90px);
            z-index: 1;
            animation: float 6s infinite alternate ease-in-out;
        }
        .bg-glow-1 { background: #2563eb; top: 10%; left: 15%; opacity: 0.4; }
        .bg-glow-2 { background: #10b981; bottom: 10%; right: 15%; opacity: 0.3; animation-delay: -3s; }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(40px, -40px) scale(1.2); }
        }

        /* TARJETA DE CRISTAL */
        .reset-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.7),
                0 0 0 1px rgba(255, 255, 255, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 1);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ICONO DEL CANDADO */
        .icon-container {
            width: 64px;
            height: 64px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #bfdbfe;
            transition: transform 0.3s ease;
        }
        .reset-card:hover .icon-container {
            transform: translateY(-5px) rotate(5deg) scale(1.05);
        }
        .icon-container svg { width: 32px; height: 32px; color: #2563eb; }

        /* TEXTOS */
        .title { text-align: center; font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem; letter-spacing: -0.5px; }
        .subtitle { text-align: center; font-size: 0.95rem; color: #64748b; margin-bottom: 2rem; }

        /* INPUTS */
        .input-group { position: relative; margin-bottom: 1.25rem; }
        .input-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            margin-left: 0.25rem;
        }
        .input-wrapper { position: relative; }
        .input-wrapper svg {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #94a3b8;
            transition: all 0.3s ease;
        }
        .input-wrapper input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            color: #1e293b;
            transition: all 0.3s ease;
            outline: none;
        }
        .input-wrapper input:focus {
            border-color: #3b82f6;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            transform: translateY(-2px);
        }
        .input-wrapper input:focus + svg,
        .input-wrapper input:not(:placeholder-shown) + svg { color: #2563eb; transform: translateY(-50%) scale(1.1); }

        /* BOTÓN CON BRILLO */
        .submit-btn {
            width: 100%;
            padding: 1rem;
            margin-top: 1rem;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            color: white;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
            position: relative;
            overflow: hidden;
        }
        .submit-btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
            transform: rotate(45deg);
            transition: all 0.5s ease;
            opacity: 0;
        }
        .submit-btn:hover::after {
            opacity: 1;
            left: 100%;
        }
        .submit-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 25px -5px rgba(37, 99, 235, 0.6);
        }
        .submit-btn:active { transform: translateY(0) scale(0.98); }
        .submit-btn svg { width: 20px; height: 20px; }

        /* ERRORES Y FOOTER */
        .error-msg { color: #ef4444; font-size: 0.8rem; margin-top: 5px; margin-left: 5px; display: block; }
        .footer-text { position: absolute; bottom: 20px; width: 100%; text-align: center; color: #64748b; font-size: 0.8rem; z-index: 10; }
    </style>
</head>
<body>
    <div class="reset-wrapper">
        <div class="bg-glow-1"></div>
        <div class="bg-glow-2"></div>

        <div class="reset-card">
            <div class="icon-container">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>

            <h2 class="title">Nueva Contraseña</h2>
            <p class="subtitle">Asegura tu cuenta con una clave fuerte.</p>

            <!-- Formulario apuntando a la ruta de Laravel -->
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="input-group">
                    <label>Correo Electrónico</label>
                    <div class="input-wrapper">
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" readonly style="background: #f1f5f9; color: #94a3b8; cursor: not-allowed;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    @if($errors->has('email')) <span class="error-msg">{{ $errors->first('email') }}</span> @endif
                </div>

                <div class="input-group">
                    <label>Nueva Contraseña</label>
                    <div class="input-wrapper">
                        <input id="password" type="password" name="password" required placeholder=" " autocomplete="new-password">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                    </div>
                    @if($errors->has('password')) <span class="error-msg">{{ $errors->first('password') }}</span> @endif
                </div>

                <div class="input-group">
                    <label>Confirmar Contraseña</label>
                    <div class="input-wrapper">
                        <input id="password_confirmation" type="password" name="password_confirmation" required placeholder=" " autocomplete="new-password">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    @if($errors->has('password_confirmation')) <span class="error-msg">{{ $errors->first('password_confirmation') }}</span> @endif
                </div>

                <button type="submit" class="submit-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Actualizar Contraseña
                </button>
            </form>
        </div>

        <div class="footer-text">
            &copy; {{ date('Y') }} Gestión de Artesanos. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
