<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;">
            <div style="display:flex;align-items:center;gap:0.7rem;">
                <span style="display:inline-block;width:10px;height:26px;border-radius:999px;background:linear-gradient(180deg,#DC2626,#FBBF24,#0891B2);"></span>
                <h2 style="font-weight:800;font-size:1.3rem;color:#0F172A;margin:0;letter-spacing:-0.01em;">
                    {{ __('profile.mi_perfil') }}
                </h2>
            </div>
            <span style="font-size:0.75rem;font-weight:800;color:#991B1B;background:#FEF3C7;border:1px solid #FDE68A;padding:0.3rem 0.75rem;border-radius:999px;">
                ✦ Coracora · Gestión de Artesanos
            </span>
        </div>
    </x-slot>

    <style>
        .coracora-profile-wrap {
            position: relative;
            padding: 2.25rem 1.25rem 3rem;
            min-height: 100vh;
            overflow: hidden;
            background:
                radial-gradient(circle at 12% 14%, rgba(220, 38, 38, 0.14), transparent 36%),
                radial-gradient(circle at 88% 18%, rgba(8, 145, 178, 0.16), transparent 38%),
                radial-gradient(circle at 50% 92%, rgba(217, 119, 6, 0.15), transparent 44%),
                linear-gradient(145deg, #FFFBEB 0%, #F8FAFC 50%, #EEF2FF 100%);
        }

        .coracora-profile-bubbles {
            position: fixed;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .coracora-bubble {
            position: absolute;
            bottom: -100px;
            border-radius: 50%;
            opacity: 0;
            animation: riseProfileBubble linear infinite;
            box-shadow:
                inset 0 0 12px rgba(255, 255, 255, 0.8),
                0 6px 18px rgba(30, 27, 75, 0.08);
        }

        .coracora-bubble.b-gold {
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.7), rgba(251, 191, 36, 0.22));
            border: 1px solid rgba(251, 191, 36, 0.42);
        }

        .coracora-bubble.b-cyan {
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.7), rgba(6, 182, 212, 0.22));
            border: 1px solid rgba(6, 182, 212, 0.4);
        }

        .coracora-bubble.b-crimson {
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.7), rgba(220, 38, 38, 0.2));
            border: 1px solid rgba(220, 38, 38, 0.36);
        }

        .cb1 { width: 26px; height: 26px; left: 8%;  animation-duration: 14s; animation-delay: 0s;   --sway: 22px;  --peak: 0.65; }
        .cb2 { width: 48px; height: 48px; left: 22%; animation-duration: 19s; animation-delay: -6s;  --sway: -30px; --peak: 0.55; }
        .cb3 { width: 20px; height: 20px; left: 45%; animation-duration: 12s; animation-delay: -3s;  --sway: 18px;  --peak: 0.7;  }
        .cb4 { width: 58px; height: 58px; left: 74%; animation-duration: 21s; animation-delay: -9s;  --sway: -34px; --peak: 0.5;  }
        .cb5 { width: 30px; height: 30px; left: 90%; animation-duration: 15s; animation-delay: -5s;  --sway: 24px;  --peak: 0.65; }

        @keyframes riseProfileBubble {
            0% { transform: translateY(0) translateX(0) scale(0.85); opacity: 0; }
            12% { opacity: var(--peak, 0.6); }
            50% { transform: translateY(-50vh) translateX(var(--sway, 20px)) scale(1.04); }
            88% { opacity: var(--peak, 0.6); }
            100% { transform: translateY(-110vh) translateX(calc(var(--sway, 20px) * -0.5)) scale(0.95); opacity: 0; }
        }

        .coracora-profile-inner {
            position: relative;
            z-index: 1;
            max-width: 820px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .coracora-profile-hero {
            background:
                radial-gradient(circle at 18% 20%, rgba(251, 191, 36, 0.25), transparent 45%),
                radial-gradient(circle at 85% 80%, rgba(6, 182, 212, 0.25), transparent 45%),
                linear-gradient(135deg, #1E1B4B 0%, #450A0A 60%, #0F172A 100%);
            color: #FFFFFF;
            border-radius: 22px;
            padding: 1.35rem 1.6rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
            flex-wrap: wrap;
            box-shadow: 0 20px 45px -16px rgba(30, 27, 75, 0.35);
            border: 1px solid rgba(251, 191, 36, 0.3);
        }

        .coracora-profile-logo {
            height: 76px;
            width: auto;
            max-width: 170px;
            object-fit: contain;
            animation: floatProfileLogo 4s ease-in-out infinite;
            filter: drop-shadow(0 10px 18px rgba(0, 0, 0, 0.45));
        }

        @keyframes floatProfileLogo {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }

        .coracora-profile-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 18px 40px -18px rgba(15, 23, 42, 0.16);
            border: 1px solid rgba(217, 119, 6, 0.18);
            border-top: 4px solid #991B1B;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .coracora-profile-card:nth-of-type(2) {
            border-top-color: #D97706;
        }

        .coracora-profile-card:nth-of-type(3) {
            border-top-color: #DC2626;
        }

        .coracora-profile-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 24px 48px -18px rgba(30, 27, 75, 0.22);
        }

        .coracora-profile-card button[type="submit"]:not(.bg-red-600) {
            background: linear-gradient(135deg, #991B1B 0%, #DC2626 55%, #D97706 140%) !important;
            border-color: transparent !important;
            color: #FFFFFF !important;
            font-weight: 800 !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 20px -8px rgba(185, 28, 28, 0.45) !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease !important;
        }

        .coracora-profile-card button[type="submit"]:not(.bg-red-600):hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 14px 24px -8px rgba(185, 28, 28, 0.55) !important;
        }

        @media (prefers-reduced-motion: reduce) {
            .coracora-bubble,
            .coracora-profile-logo,
            .coracora-profile-card {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>

    <div class="coracora-profile-bubbles" aria-hidden="true">
        <span class="coracora-bubble b-gold cb1"></span>
        <span class="coracora-bubble b-cyan cb2"></span>
        <span class="coracora-bubble b-crimson cb3"></span>
        <span class="coracora-bubble b-gold cb4"></span>
        <span class="coracora-bubble b-cyan cb5"></span>
    </div>

    <div class="coracora-profile-wrap">
        <div class="coracora-profile-inner">

            <!-- Banner con logo flotante de Coracora -->
            <div class="coracora-profile-hero">
                <img src="{{ asset('images/' . rawurlencode('logo_original-.png')) }}"
                     alt="Coracora · Gestión y Comercialización de Productos Artesanales"
                     class="coracora-profile-logo"
                     onerror="this.style.display='none'">
                <div>
                    <div style="font-size:0.72rem;font-weight:800;letter-spacing:0.8px;text-transform:uppercase;color:#FDE68A;margin-bottom:0.25rem;">
                        ✦ Juntos Impulsamos lo Nuestro
                    </div>
                    <div style="font-size:1.15rem;font-weight:800;line-height:1.25;">
                        {{ Auth::user()->name ?? __('profile.mi_perfil') }}
                    </div>
                    <div style="font-size:0.84rem;color:#E2E8F0;margin-top:0.2rem;">
                        Administra tus datos personales, contraseña y seguridad de tu cuenta.
                    </div>
                </div>
            </div>

            <!-- Formulario 1: Info del perfil -->
            <div class="coracora-profile-card">
                <div style="max-width: 600px; margin: 0 auto;">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Formulario 2: Contraseña -->
            <div class="coracora-profile-card">
                <div style="max-width: 600px; margin: 0 auto;">
                    @include('profile.partials.update-password-form')

                    @if (Route::has('password.request'))
                        <div style="margin-top:1.1rem;padding-top:0.95rem;border-top:1px solid #E2E8F0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.5rem;">
                            <span style="font-size:0.8rem;color:#475569;font-weight:600;">
                                ¿Olvidaste tu contraseña actual?
                            </span>
                            <a href="{{ route('password.request') }}"
                               style="font-size:0.82rem;font-weight:800;color:#0891B2;text-decoration:none;">
                                Recuperar contraseña →
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Formulario 3: Eliminar cuenta -->
            <div class="coracora-profile-card">
                <div style="max-width: 600px; margin: 0 auto;">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
