<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Correo - Gestión de Artesanos</title>
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
            max-width: 480px;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.7),
                0 0 0 1px rgba(255, 255, 255, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 1);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            text-align: center;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ICONO DEL SOBRE */
        .icon-container {
            width: 70px;
            height: 70px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #bfdbfe;
            transition: transform 0.3s ease;
        }
        .reset-card:hover .icon-container {
            transform: translateY(-5px) scale(1.05);
        }
        .icon-container svg { width: 35px; height: 35px; color: #2563eb; }

        /* TEXTOS */
        .title { text-align: center; font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem; letter-spacing: -0.5px; }
        .subtitle { text-align: center; font-size: 0.9rem; color: #64748b; margin-bottom: 1.5rem; line-height: 1.5; }

        /* SEPARADOR */
        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: #94a3b8;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .separator::before, .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }
        .separator::before { margin-right: 10px; }
        .separator::after { margin-left: 10px; }

        /* BOTONES */
        .btn-primary {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.3);
            text-decoration: none;
            margin-bottom: 0.5rem;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(37, 99, 235, 0.5);
        }

        .btn-warning {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px -2px rgba(245, 158, 11, 0.4);
            margin-bottom: 1rem;
        }
        .btn-warning:hover {
            transform: translateY(-2px);
        }

        .btn-success {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-success:hover { transform: translateY(-2px); }

        /* INPUT OTP */
        .otp-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #cbd5e1;
            border-radius: 12px;
            font-size: 1.5rem;
            text-align: center;
            letter-spacing: 0.5rem;
            font-weight: bold;
            margin-bottom: 0.75rem;
            outline: none;
            transition: border-color 0.3s ease;
        }
        .otp-input:focus { border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15); }

        /* ALERTAS */
        .alert-success {
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .alert-danger {
            background-color: #fee2e2;
            border: 1px solid #f87171;
            color: #b91c1c;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        /* ENLACE DE CERRAR SESIÓN */
        .logout-link {
            display: inline-block;
            margin-top: 1rem;
            font-size: 0.85rem;
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .logout-link:hover { color: #ef4444; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="reset-wrapper">
        <div class="bg-glow-1"></div>
        <div class="bg-glow-2"></div>

        <div class="reset-card">
            <div class="icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>

            <h2 class="title">Verifica tu Correo</h2>
            <p class="subtitle">
                Hemos enviado un enlace de verificación a tu correo electrónico. Por favor, revísalo y haz clic en el enlace.
            </p>

            @if (session('status'))
                <div class="alert-success">{{ session('status') }}</div>
            @endif

            @if ($errors->has('code'))
                <div class="alert-danger">{{ $errors->first('code') }}</div>
            @endif

            <!-- OPCIÓN 1: FLUJO NORMAL (LINK) -->
            <a href="https://mail.google.com" target="_blank" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 1.2rem; height: 1.2rem;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
                Gmail
            </a>
                <form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit" style="background: none; border: none; cursor: pointer; font-family: inherit; font-size: 0.85rem; color: #64748b; letter-spacing: 0.5px; padding: 0.5rem 1rem; margin-top: 0.5rem; margin-bottom: 0.5rem; transition: color 0.3s ease;" onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#64748b'">
        ¿No te llegó? <span style="text-decoration: underline;">Reenviar correo</span>
    </button>
</form>

            <!-- OPCIÓN 2: FLUJO DE EXCEPCIÓN (SOPORTE) -->
            <div class="separator">O si no tienes acceso</div>

            <p style="font-size: 0.8rem; color: #64748b; margin-bottom: 1rem;">
                Si perdiste acceso a tu correo solicita un código al administrador.
            </p>

            <form method="POST" action="{{ route('verify.code.generate') }}">
                @csrf
                <button type="submit" class="btn-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 1.1rem; height: 1.1rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Solicitar Código al Administrador
                </button>
            </form>

            <form method="POST" action="{{ route('verify.code.check') }}">
                @csrf
                <input type="text" name="code" maxlength="6" placeholder="000000" required class="otp-input">
                <button type="submit" class="btn-success">
                    Validar Código
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-link" style="background: none; border: none; cursor: pointer; font-family: inherit;">
                    Finalizar sesión
                </button>
            </form>
        </div>
    </div>
</body>
</html>
