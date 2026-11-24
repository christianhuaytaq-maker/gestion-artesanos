<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Artesanos Perú | Tienda Oficial de Arte Hecho a Mano</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">

    @auth
        <script>window.LaravelUserId = {{ Auth::id() }};</script>
    @endauth

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        :root {
            --bg-main: #F8FAFC;
            --surface: #FFFFFF;
            --text-dark: #0F172A;
            --text-muted: #64748B;
            --primary: #4F46E5;
            --primary-dark: #3730A3;
            --secondary: #06B6D4;
            --accent: #F59E0B;
            --success: #10B981;
            --border-light: rgba(226, 232, 240, 0.85);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at 8% 12%, rgba(79, 70, 229, 0.10), transparent 34%),
                radial-gradient(circle at 92% 18%, rgba(6, 182, 212, 0.12), transparent 36%),
                linear-gradient(180deg, #F8FAFC 0%, #EEF2FF 60%, #F1F5F9 100%);
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
        }

        /* BARRA SUPERIOR PROMOCIONAL */
        .top-promo-bar {
            background: linear-gradient(90deg, #0F172A 0%, #312E81 50%, #0E7490 100%);
            color: #F8FAFC;
            font-size: 0.78rem;
            font-weight: 600;
            text-align: center;
            padding: 0.55rem 1rem;
            letter-spacing: 0.3px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        .top-promo-bar span.pill {
            background: rgba(255,255,255,0.16);
            padding: 0.18rem 0.65rem;
            border-radius: 999px;
            font-size: 0.72rem;
            color: #FDE68A;
        }
        .socket-status-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(15, 23, 42, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.2rem 0.65rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 700;
            color: #E2E8F0;
        }
        .socket-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #F59E0B;
        }
        .socket-dot.online {
            background: #10B981;
            box-shadow: 0 0 8px #10B981;
        }

        /* NAVBAR PROFESIONAL STICKY */
        .navbar-wrapper {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(18px) saturate(160%);
            -webkit-backdrop-filter: blur(18px) saturate(160%);
            border-bottom: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow: 0 8px 25px -10px rgba(15, 23, 42, 0.08);
        }
        .navbar {
            max-width: 1360px;
            margin: 0 auto;
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.85rem;
            flex-wrap: wrap;
        }
        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.42rem;
            font-weight: 800;
            color: var(--text-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 9px;
            white-space: nowrap;
        }
        .brand-logo {
            width: 34px;
            height: 34px;
            border-radius: 11px;
            background: linear-gradient(135deg, #4F46E5, #06B6D4);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            box-shadow: 0 6px 14px rgba(79, 70, 229, 0.3);
        }

        /* BUSCADOR EN NAVBAR */
        .nav-search {
            flex: 1;
            min-width: 200px;
            max-width: 270px;
            position: relative;
        }
        .nav-search input {
            width: 100%;
            padding: 0.56rem 0.9rem 0.56rem 2.25rem;
            border-radius: 999px;
            border: 1px solid #CBD5E1;
            background: #F8FAFC;
            font-family: inherit;
            font-size: 0.82rem;
            color: var(--text-dark);
            outline: none;
            transition: all 0.25s ease;
        }
        .nav-search input:focus {
            background: #FFFFFF;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
        }
        .nav-search svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            height: 15px;
            color: var(--text-muted);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.05rem;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.83rem;
            transition: color 0.2s;
            white-space: nowrap;
        }
        .nav-links a:hover { color: var(--primary); }

        /* SELECTOR DE IDIOMA ES | EN | QU */
        .lang-switcher {
            display: inline-flex;
            align-items: center;
            background: #0F172A;
            padding: 3px;
            border-radius: 999px;
            border: 1px solid #1E293B;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.14);
            flex-shrink: 0;
        }
        .lang-btn {
            background: transparent;
            border: none;
            color: #94A3B8;
            font-family: inherit;
            font-size: 0.72rem;
            font-weight: 800;
            padding: 0.34rem 0.62rem;
            border-radius: 999px;
            cursor: pointer;
            letter-spacing: 0.4px;
            transition: all 0.2s ease;
        }
        .lang-btn:hover { color: #FFFFFF; }
        .lang-btn.active {
            background: linear-gradient(135deg, #4F46E5, #06B6D4);
            color: #FFFFFF;
            box-shadow: 0 2px 8px rgba(6, 182, 212, 0.4);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            flex-shrink: 0;
        }
        .btn-cart-nav {
            position: relative;
            background: linear-gradient(135deg, #4F46E5, #06B6D4);
            color: white;
            border: 1px solid rgba(255,255,255,0.65);
            width: 39px;
            height: 39px;
            border-radius: 50%;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3);
            transition: all 0.25s ease;
        }
        .btn-cart-nav:hover { transform: translateY(-2px) scale(1.05); }
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #F59E0B;
            color: #0F172A;
            font-size: 0.68rem;
            font-weight: 800;
            min-width: 19px;
            height: 19px;
            padding: 0 4px;
            border-radius: 999px;
            border: 2px solid #FFFFFF;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* CHIP DE USUARIO LOGUEADO + DROPDOWN */
        .user-menu-wrapper { position: relative; }
        .user-pill-btn {
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            border-radius: 999px;
            padding: 0.26rem 0.72rem 0.26rem 0.3rem;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            font-family: inherit;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-dark);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06);
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .user-pill-btn:hover {
            border-color: var(--primary);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.14);
        }
        .user-avatar-badge {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4F46E5, #06B6D4);
            color: #FFFFFF;
            font-size: 0.76rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .user-name-text {
            max-width: 110px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 230px;
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 18px;
            box-shadow: 0 18px 38px -10px rgba(15, 23, 42, 0.22);
            padding: 0.55rem;
            display: none;
            z-index: 1500;
        }
        .user-dropdown.open { display: block; }
        .user-dropdown-header {
            padding: 0.55rem 0.75rem;
            border-bottom: 1px solid #F1F5F9;
            margin-bottom: 0.35rem;
        }
        .user-dropdown-header strong {
            display: block;
            font-size: 0.86rem;
            color: var(--text-dark);
        }
        .user-dropdown-header small {
            display: block;
            font-size: 0.73rem;
            color: var(--text-muted);
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dropdown-link-item {
            width: 100%;
            text-align: left;
            background: transparent;
            border: none;
            padding: 0.58rem 0.75rem;
            border-radius: 11px;
            font-family: inherit;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: background 0.15s ease;
        }
        .dropdown-link-item:hover { background: #F1F5F9; }
        .dropdown-logout-btn { color: #DC2626; }
        .dropdown-logout-btn:hover { background: #FEF2F2; }

        .btn-admin {
            background: #0F172A;
            color: white;
            padding: 0.54rem 1rem;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.78rem;
            white-space: nowrap;
            transition: all 0.25s ease;
        }
        .btn-admin:hover {
            background: var(--primary);
            transform: translateY(-1px);
        }
        .btn-login {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 700;
            font-size: 0.8rem;
            padding: 0.48rem 0.78rem;
            border-radius: 999px;
            border: 1px solid #CBD5E1;
            background: #FFFFFF;
            white-space: nowrap;
            transition: all 0.2s;
        }
        .btn-login:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* CARRUSEL HERO PRINCIPAL */
        .hero-container {
            max-width: 1280px;
            margin: 1.75rem auto 0 auto;
            padding: 0 1.75rem;
        }
        .hero-carousel {
            position: relative;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 24px 50px -15px rgba(15, 23, 42, 0.22);
            background: #0F172A;
            min-height: 410px;
        }
        .carousel-track {
            display: flex;
            transition: transform 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .carousel-slide {
            min-width: 100%;
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            align-items: center;
            padding: 3.25rem 4rem;
            gap: 2.5rem;
            position: relative;
        }
        .slide-1 {
            background:
                radial-gradient(circle at 85% 20%, rgba(6, 182, 212, 0.35), transparent 45%),
                linear-gradient(135deg, #0F172A 0%, #312E81 55%, #1E1B4B 100%);
        }
        .slide-2 {
            background:
                radial-gradient(circle at 85% 20%, rgba(245, 158, 11, 0.35), transparent 45%),
                linear-gradient(135deg, #1E1B4B 0%, #4C1D95 55%, #0F172A 100%);
        }
        .slide-3 {
            background:
                radial-gradient(circle at 85% 20%, rgba(16, 185, 129, 0.35), transparent 45%),
                linear-gradient(135deg, #0F172A 0%, #065F46 55%, #1E293B 100%);
        }

        .slide-content { color: white; z-index: 2; }
        .slide-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #FDE68A;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 0.4rem 0.9rem;
            border-radius: 999px;
            margin-bottom: 1.1rem;
        }
        .slide-content h1, .slide-content h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.85rem;
            font-weight: 800;
            line-height: 1.12;
            margin: 0 0 1rem 0;
            color: #FFFFFF;
        }
        .slide-content p {
            font-size: 1rem;
            line-height: 1.65;
            color: #CBD5E1;
            margin: 0 0 1.75rem 0;
            max-width: 520px;
        }
        .slide-cta-group {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            flex-wrap: wrap;
        }
        .btn-hero-primary {
            background: linear-gradient(135deg, #F59E0B, #FBBF24);
            color: #0F172A;
            padding: 0.85rem 1.6rem;
            border-radius: 14px;
            font-weight: 800;
            font-size: 0.92rem;
            text-decoration: none;
            box-shadow: 0 10px 24px rgba(245, 158, 11, 0.35);
            transition: transform 0.25s ease;
        }
        .btn-hero-primary:hover { transform: translateY(-2px); }
        .btn-hero-secondary {
            background: rgba(255, 255, 255, 0.12);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.85rem 1.4rem;
            border-radius: 14px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: background 0.25s ease;
        }
        .btn-hero-secondary:hover { background: rgba(255, 255, 255, 0.22); }

        .slide-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2;
        }
        .featured-showcase-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.28);
            border-radius: 24px;
            padding: 1rem;
            width: 100%;
            max-width: 330px;
            color: white;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        .featured-showcase-card img {
            width: 100%;
            height: 215px;
            object-fit: cover;
            border-radius: 16px;
            display: block;
            margin-bottom: 0.85rem;
        }
        .featured-showcase-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .featured-showcase-meta strong { font-size: 1.05rem; text-transform: capitalize; }
        .featured-showcase-meta span {
            background: #10B981;
            color: white;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
            font-weight: 800;
            font-size: 0.85rem;
        }

        /* CONTROLES DEL CARRUSEL */
        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.35);
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(8px);
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 5;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .carousel-arrow:hover { background: var(--primary); }
        .carousel-arrow.prev { left: 16px; }
        .carousel-arrow.next { right: 16px; }

        .carousel-dots {
            position: absolute;
            bottom: 16px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 5;
        }
        .carousel-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            border: none;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .carousel-dot.active {
            width: 28px;
            background: #FBBF24;
        }

        /* FRANJA DE BENEFICIOS DE TIENDA */
        .trust-strip {
            max-width: 1280px;
            margin: 1.75rem auto 0 auto;
            padding: 0 1.75rem;
        }
        .trust-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }
        .trust-item {
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid var(--border-light);
            border-radius: 18px;
            padding: 1rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
        }
        .trust-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(79,70,229,0.12), rgba(6,182,212,0.16));
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }
        .trust-item h4 { margin: 0; font-size: 0.88rem; font-weight: 700; }
        .trust-item p { margin: 2px 0 0 0; font-size: 0.76rem; color: var(--text-muted); }

        /* SECCIÓN DE CATÁLOGO */
        .catalog-section {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2.75rem 1.75rem 2rem 1.75rem;
        }
        .catalog-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .catalog-title-box h2 {
            font-size: 1.9rem;
            font-weight: 800;
            margin: 0;
            color: var(--text-dark);
        }
        .catalog-title-box p {
            margin: 4px 0 0 0;
            font-size: 0.88rem;
            color: var(--text-muted);
        }

        .sort-select {
            padding: 0.58rem 1rem;
            border-radius: 12px;
            border: 1px solid #CBD5E1;
            background: white;
            font-family: inherit;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
            cursor: pointer;
            outline: none;
        }

        /* PESTAÑAS DE CATEGORÍAS */
        .category-pills {
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }
        .cat-pill {
            background: white;
            border: 1px solid #E2E8F0;
            color: var(--text-muted);
            padding: 0.52rem 1.1rem;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .cat-pill:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        .cat-pill.active {
            background: linear-gradient(135deg, #4F46E5, #06B6D4);
            color: white;
            border-color: transparent;
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.28);
        }

        /* GRID DE PRODUCTOS */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.75rem;
        }

        .product-card {
            background: #FFFFFF;
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid var(--border-light);
            box-shadow: 0 8px 24px -8px rgba(15, 23, 42, 0.08);
            transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 22px 40px -12px rgba(79, 70, 229, 0.22);
            border-color: rgba(79, 70, 229, 0.35);
        }

        .product-image-container {
            height: 255px;
            overflow: hidden;
            position: relative;
            background: linear-gradient(135deg, #E0E7FF, #CFFAFE);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
            position: absolute;
            top: 0; left: 0;
            z-index: 1;
        }
        .product-card:hover .product-image { transform: scale(1.07); }

        .no-image-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #6366F1;
            z-index: 0;
        }
        .no-image-placeholder svg { width: 46px; height: 46px; margin-bottom: 8px; opacity: 0.6; }
        .no-image-placeholder span { font-size: 0.78rem; font-weight: 700; text-transform: uppercase; }

        .product-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(8px);
            padding: 0.38rem 0.8rem;
            border-radius: 999px;
            font-size: 0.68rem;
            font-weight: 800;
            color: #4338CA;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
            z-index: 2;
            max-width: 72%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-quick-view {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(15, 23, 42, 0.82);
            color: white;
            border: none;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            z-index: 3;
            opacity: 0;
            transform: translateY(6px);
            transition: all 0.25s ease;
        }
        .product-card:hover .btn-quick-view {
            opacity: 1;
            transform: translateY(0);
        }

        .product-info {
            padding: 1.35rem 1.45rem 1.45rem 1.45rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .product-category-label {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .product-info h3 {
            margin: 0 0 0.4rem 0;
            font-size: 1.18rem;
            font-weight: 800;
            color: var(--text-dark);
            text-transform: capitalize;
        }
        .product-desc-preview {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.45;
            margin: 0 0 0.75rem 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* INDICADOR DE STOCK */
        .stock-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.22rem 0.6rem;
            border-radius: 999px;
            margin-bottom: 0.75rem;
            width: fit-content;
        }
        .stock-ok {
            background: #ECFDF5;
            color: #047857;
            border: 1px solid #A7F3D0;
        }
        .stock-low {
            background: #FFFBEB;
            color: #B45309;
            border: 1px solid #FDE68A;
        }
        .stock-out {
            background: #FEF2F2;
            color: #B91C1C;
            border: 1px solid #FECACA;
        }

        .product-artisan {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-top: auto;
            margin-bottom: 1rem;
        }
        .product-artisan .avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4F46E5, #06B6D4);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 800;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.5rem;
            border-top: 1px solid #F1F5F9;
            padding-top: 0.95rem;
        }
        .price-block small {
            display: block;
            font-size: 0.68rem;
            color: var(--text-muted);
            font-weight: 600;
        }
        .product-price {
            font-size: 1.28rem;
            font-weight: 900;
            color: var(--text-dark);
        }
        .card-buttons {
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }
        .btn-add-cart {
            background: linear-gradient(135deg, #4F46E5, #06B6D4);
            color: white;
            border: none;
            padding: 0.6rem 0.88rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            box-shadow: 0 6px 14px rgba(79, 70, 229, 0.25);
            transition: all 0.22s ease;
        }
        .btn-add-cart:hover { transform: translateY(-2px); }
        .btn-add-cart:disabled {
            background: #CBD5E1;
            box-shadow: none;
            cursor: not-allowed;
            transform: none;
        }

        .btn-whatsapp {
            background: #22C55E;
            color: white;
            border: none;
            padding: 0.6rem 0.78rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.8rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 14px rgba(34, 197, 94, 0.24);
            transition: all 0.22s ease;
        }
        .btn-whatsapp:hover { background: #16A34A; transform: translateY(-2px); }

        .empty-filter-box {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem 1.5rem;
            background: #FFFFFF;
            border-radius: 22px;
            border: 1px solid #E2E8F0;
        }
        .btn-reset-filters {
            margin-top: 0.85rem;
            background: var(--primary);
            color: #FFFFFF;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.84rem;
            cursor: pointer;
        }

        /* SECCIÓN SOBRE NOSOTROS */
        .about-section {
            max-width: 1280px;
            margin: 2.5rem auto 0 auto;
            padding: 0 1.75rem;
        }
        .about-card {
            background: linear-gradient(135deg, #FFFFFF 0%, #EEF2FF 100%);
            border: 1px solid var(--border-light);
            border-radius: 28px;
            padding: 3rem;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 2.5rem;
            align-items: center;
            box-shadow: 0 14px 35px -15px rgba(15, 23, 42, 0.1);
        }
        .about-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.1rem;
            margin: 0.4rem 0 1rem 0;
        }
        .about-card p {
            color: var(--text-muted);
            line-height: 1.7;
            margin: 0 0 1.5rem 0;
        }
        .about-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
        .stat-box {
            background: white;
            padding: 1.1rem;
            border-radius: 16px;
            border: 1px solid #E2E8F0;
            text-align: center;
        }
        .stat-box strong {
            display: block;
            font-size: 1.45rem;
            font-weight: 900;
            color: var(--primary);
        }
        .stat-box span { font-size: 0.78rem; color: var(--text-muted); font-weight: 600; }

        .contact-cta-box {
            background: linear-gradient(135deg, #0F172A, #312E81);
            color: white;
            border-radius: 22px;
            padding: 2rem;
            text-align: center;
        }
        .contact-cta-box h3 { margin: 0 0 0.6rem 0; font-size: 1.35rem; }
        .contact-cta-box p { color: #CBD5E1; font-size: 0.88rem; margin-bottom: 1.35rem; }

        /* MODAL VISTA RÁPIDA DE PRODUCTO */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(6px);
            z-index: 2500;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
        }
        .modal-overlay.open { display: flex; }
        .quick-modal {
            background: white;
            border-radius: 24px;
            max-width: 760px;
            width: 100%;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 25px 60px rgba(15, 23, 42, 0.35);
            position: relative;
        }
        .quick-modal-img {
            width: 100%;
            height: 100%;
            min-height: 340px;
            object-fit: cover;
            background: #EEF2FF;
        }
        .quick-modal-body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .btn-close-modal {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: none;
            background: #F1F5F9;
            color: #0F172A;
            font-weight: 800;
            cursor: pointer;
            z-index: 5;
        }

        /* DRAWER LATERAL DEL CARRITO */
        .cart-drawer-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
            z-index: 2200;
            display: none;
            justify-content: flex-end;
        }
        .cart-drawer-backdrop.open { display: flex; }
        .cart-drawer {
            width: 100%;
            max-width: 410px;
            background: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: -15px 0 40px rgba(15, 23, 42, 0.2);
        }
        .cart-header {
            padding: 1.35rem 1.5rem;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cart-header h3 { margin: 0; font-size: 1.15rem; font-weight: 800; }
        .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 1.25rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .cart-item {
            display: flex;
            gap: 0.85rem;
            align-items: center;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            padding: 0.75rem;
        }
        .cart-item img {
            width: 62px;
            height: 62px;
            border-radius: 12px;
            object-fit: cover;
            background: #EEF2FF;
        }
        .cart-item-info { flex: 1; }
        .cart-item-info strong { display: block; font-size: 0.9rem; text-transform: capitalize; }
        .cart-item-info span { font-size: 0.82rem; color: var(--primary); font-weight: 700; }
        .qty-controls {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 6px;
        }
        .qty-btn {
            width: 24px;
            height: 24px;
            border-radius: 8px;
            border: 1px solid #CBD5E1;
            background: white;
            font-weight: 800;
            cursor: pointer;
        }
        .cart-footer {
            padding: 1.35rem 1.5rem;
            border-top: 1px solid #E2E8F0;
            background: #F8FAFC;
        }
        .cart-total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .cart-total-row span { font-size: 0.92rem; color: var(--text-muted); font-weight: 600; }
        .cart-total-row strong { font-size: 1.35rem; font-weight: 900; color: var(--text-dark); }
        .btn-checkout-wa {
            width: 100%;
            background: #22C55E;
            color: white;
            border: none;
            padding: 0.9rem;
            border-radius: 14px;
            font-weight: 800;
            font-size: 0.92rem;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(34, 197, 94, 0.28);
        }
        .btn-checkout-wa:hover { background: #16A34A; }

        /* FOOTER */
        footer {
            margin-top: 4rem;
            background: #0F172A;
            color: #94A3B8;
            padding: 3rem 1.75rem 2rem 1.75rem;
        }
        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            padding-bottom: 2rem;
        }
        .footer-brand {
            font-family: 'Playfair Display', serif;
            color: white;
            font-size: 1.4rem;
            font-weight: 800;
        }
        .footer-bottom {
            max-width: 1280px;
            margin: 1.25rem auto 0 auto;
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        @media (max-width: 960px) {
            .carousel-slide { grid-template-columns: 1fr; padding: 2.5rem 2rem; text-align: center; }
            .slide-content p { margin-left: auto; margin-right: auto; }
            .slide-cta-group { justify-content: center; }
            .trust-grid { grid-template-columns: repeat(2, 1fr); }
            .about-card { grid-template-columns: 1fr; padding: 2rem; }
            .quick-modal { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .nav-links { display: none; }
            .trust-grid { grid-template-columns: 1fr; }
            .slide-content h1, .slide-content h2 { font-size: 2.1rem; }
        }
    </style>
</head>
<body>

    @php
        $productosCollection = collect($productos ?? []);
        $whatsappNumber = '51961227162';
        $categoriasDisponibles = $productosCollection
            ->map(fn($p) => trim($p->categoria ?? ''))
            ->filter()
            ->unique()
            ->values();

        $resolverImagen = function ($ruta, $nombreProducto = '') {
            if (!empty($ruta)) {
                $texto = trim((string) $ruta);

                if (
                    str_starts_with($texto, 'data:image/') ||
                    str_starts_with($texto, 'http://') ||
                    str_starts_with($texto, 'https://')
                ) {
                    return $texto;
                }

                $limpia = ltrim(str_replace('\\', '/', $texto), '/');
                if (str_starts_with($limpia, 'public/')) {
                    $limpia = substr($limpia, 7);
                }

                $candidatas = [
                    str_starts_with($limpia, 'storage/') ? $limpia : 'storage/' . $limpia,
                    $limpia,
                    'images/' . $limpia,
                    'img/' . $limpia,
                    'uploads/' . $limpia,
                    'storage/productos/' . basename($limpia),
                    'images/productos/' . basename($limpia),
                ];

                foreach ($candidatas as $relativa) {
                    if (file_exists(public_path($relativa))) {
                        return asset($relativa);
                    }
                }
            }

            if (!empty($nombreProducto)) {
                $slug = \Illuminate\Support\Str::slug($nombreProducto);
                foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
                    foreach (["storage/productos/{$slug}.{$ext}", "images/{$slug}.{$ext}", "img/{$slug}.{$ext}"] as $relativa) {
                        if (file_exists(public_path($relativa))) {
                            return asset($relativa);
                        }
                    }
                }
            }

            return null;
        };
    @endphp

    <!-- BARRA SUPERIOR PROMOCIONAL -->
    <div class="top-promo-bar">
        <span class="pill" data-i18n="promoPill">COLECCIÓN ARTESANAL 2026</span>
        <span data-i18n="promoText">Envíos seguros a todo el Perú · Piezas únicas tejidas a mano por maestros artesanos</span>
        <span>WhatsApp: +{{ $whatsappNumber }}</span>
        <span class="socket-status-chip" id="socketStatusChip" title="Estado de conexión en tiempo real">
            <span class="socket-dot" id="socketStatusDot"></span>
            <span id="socketStatusLabel">WebSocket: Conectando...</span>
        </span>
    </div>

    <!-- NAVBAR STICKY -->
    <div class="navbar-wrapper">
        <nav class="navbar">
            <a href="{{ url('/') }}" class="brand">
                <span class="brand-logo">✦</span>
                <span>Artesanos<span style="color: var(--primary);">Store</span></span>
            </a>

            <div class="nav-search">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
                </svg>
                <input type="text" id="searchInput" placeholder="Buscar chalinas, ponchos o artesanos..." oninput="filtrarYOrdenarProductos()">
            </div>

            <div class="nav-links">
                <a href="#inicio" data-i18n="navHome">Inicio</a>
                <a href="#catalogo" data-i18n="navCatalog">Catálogo</a>
                <a href="#nosotros" data-i18n="navAbout">Sobre Nosotros</a>
                <a href="#contacto" data-i18n="navContact">Contacto</a>
            </div>

            <!-- SELECTOR DE IDIOMA ES | EN | QU -->
            <div class="lang-switcher" title="Cambiar idioma / Change language / Simi akllay">
                <button type="button" class="lang-btn active" data-lang="es" onclick="setLanguage('es', true)">ES</button>
                <button type="button" class="lang-btn" data-lang="en" onclick="setLanguage('en', true)">EN</button>
                <button type="button" class="lang-btn" data-lang="qu" onclick="setLanguage('qu', true)">QU</button>
            </div>

            <div class="nav-actions">
                <button type="button" class="btn-cart-nav" onclick="toggleCartDrawer(true)" title="Ver carrito">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="cart-badge" id="cartCountBadge">0</span>
                </button>

                @auth
                    @php
                        $usuarioActual = Auth::user();
                        $iniciales = collect(explode(' ', trim($usuarioActual->name ?? 'U')))
                            ->filter()
                            ->take(2)
                            ->map(fn($parte) => mb_strtoupper(mb_substr($parte, 0, 1)))
                            ->implode('');
                    @endphp
                    <div class="user-menu-wrapper" id="userMenuWrapper">
                        <button type="button" class="user-pill-btn" onclick="toggleUserDropdown(event)" aria-expanded="false">
                            <span class="user-avatar-badge">{{ $iniciales ?: 'U' }}</span>
                            <span class="user-name-text">{{ $usuarioActual->name }}</span>
                            <span style="font-size:0.65rem;color:#64748B;">▼</span>
                        </button>

                        <div class="user-dropdown" id="userDropdown">
                            <div class="user-dropdown-header">
                                <strong>{{ $usuarioActual->name }}</strong>
                                <small>{{ $usuarioActual->email }}</small>
                            </div>

                            @if (Route::has('profile.edit'))
                                <a href="{{ route('profile.edit') }}" class="dropdown-link-item">
                                    <span>👤</span>
                                    <span data-i18n="profileLink">Mi Perfil</span>
                                </a>
                            @endif

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="dropdown-link-item">
                                    <span>🔑</span>
                                    <span data-i18n="recoverPassLink">Recuperar Contraseña</span>
                                </a>
                            @endif

                            <a href="{{ url('/panel') }}" class="dropdown-link-item">
                                <span>📊</span>
                                <span data-i18n="goPanel">Ir al Panel</span>
                            </a>

                            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                @csrf
                                <button type="submit" class="dropdown-link-item dropdown-logout-btn">
                                    <span>🚪</span>
                                    <span data-i18n="logoutBtn">Cerrar Sesión</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-login" data-i18n="loginBtn">Ingresar</a>
                    <a href="{{ url('/panel') }}" class="btn-admin" data-i18n="panelBtn">Panel</a>
                @endauth
            </div>
        </nav>
    </div>

    <!-- CARRUSEL HERO PRINCIPAL -->
    <section class="hero-container" id="inicio">
        <div class="hero-carousel" id="heroCarousel">
            <div class="carousel-track" id="carouselTrack">
                <!-- SLIDE 1 -->
                <div class="carousel-slide slide-1">
                    <div class="slide-content">
                        <span class="slide-tag" data-i18n="slide1Tag">✦ Arte Textil & Tradición Viva</span>
                        <h1 data-i18n="slide1Title">Piezas Únicas Hechas a Mano con Alma Peruana</h1>
                        <p data-i18n="slide1Desc">
                            Descubre creaciones auténticas elaboradas por maestros artesanos. Cada tejido, bordado y detalle conserva siglos de historia y cultura.
                        </p>
                        <div class="slide-cta-group">
                            <a href="#catalogo" class="btn-hero-primary" data-i18n="slide1Btn1">Explorar Catálogo</a>
                            <a href="#nosotros" class="btn-hero-secondary" data-i18n="slide1Btn2">Conocer Artesanos</a>
                        </div>
                    </div>
                    <div class="slide-visual">
                        @php $destacado1 = $productosCollection->first(); @endphp
                        @if($destacado1)
                            @php $img1 = $resolverImagen($destacado1->imagen ?? null, $destacado1->nombre ?? ''); @endphp
                            <div class="featured-showcase-card">
                                @if($img1)
                                    <img src="{{ $img1 }}" alt="{{ $destacado1->nombre }}" onerror="this.style.display='none';">
                                @endif
                                <div class="featured-showcase-meta">
                                    <strong>{{ $destacado1->nombre }}</strong>
                                    <span>S/ {{ number_format($destacado1->precio, 2) }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- SLIDE 2 -->
                <div class="carousel-slide slide-2">
                    <div class="slide-content">
                        <span class="slide-tag" data-i18n="slide2Tag">✦ Pedidos Personalizados</span>
                        <h2 data-i18n="slide2Title">Arma tu Pedido en el Carrito Virtual</h2>
                        <p data-i18n="slide2Desc">
                            Selecciona varios productos, ajusta cantidades y envía tu orden completa en un clic directo a nuestro canal empresarial de WhatsApp.
                        </p>
                        <div class="slide-cta-group">
                            <button type="button" onclick="toggleCartDrawer(true)" class="btn-hero-primary" style="border:none;cursor:pointer;" data-i18n="slide2Btn1">
                                Abrir Mi Carrito
                            </button>
                            <a href="#catalogo" class="btn-hero-secondary" data-i18n="slide2Btn2">Seguir Comprando</a>
                        </div>
                    </div>
                    <div class="slide-visual">
                        @php $destacado2 = $productosCollection->skip(1)->first() ?? $destacado1; @endphp
                        @if($destacado2)
                            @php $img2 = $resolverImagen($destacado2->imagen ?? null, $destacado2->nombre ?? ''); @endphp
                            <div class="featured-showcase-card">
                                @if($img2)
                                    <img src="{{ $img2 }}" alt="{{ $destacado2->nombre }}" onerror="this.style.display='none';">
                                @endif
                                <div class="featured-showcase-meta">
                                    <strong>{{ $destacado2->nombre }}</strong>
                                    <span>S/ {{ number_format($destacado2->precio, 2) }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- SLIDE 3 -->
                <div class="carousel-slide slide-3">
                    <div class="slide-content">
                        <span class="slide-tag" data-i18n="slide3Tag">✦ Impacto Social Directo</span>
                        <h2 data-i18n="slide3Title">Apoya Directamente a Familias Artesanas</h2>
                        <p data-i18n="slide3Desc">
                            Sin intermediarios abusivos: cada compra impulsa talleres locales, preserva técnicas ancestrales y fortalece la economía familiar.
                        </p>
                        <div class="slide-cta-group">
                            <a href="#catalogo" class="btn-hero-primary" data-i18n="slide3Btn1">Ver Productos</a>
                            <a href="#contacto" class="btn-hero-secondary" data-i18n="slide3Btn2">Contactar Asesor</a>
                        </div>
                    </div>
                    <div class="slide-visual">
                        @php $destacado3 = $productosCollection->last(); @endphp
                        @if($destacado3)
                            @php $img3 = $resolverImagen($destacado3->imagen ?? null, $destacado3->nombre ?? ''); @endphp
                            <div class="featured-showcase-card">
                                @if($img3)
                                    <img src="{{ $img3 }}" alt="{{ $destacado3->nombre }}" onerror="this.style.display='none';">
                                @endif
                                <div class="featured-showcase-meta">
                                    <strong>{{ $destacado3->nombre }}</strong>
                                    <span>S/ {{ number_format($destacado3->precio, 2) }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <button type="button" class="carousel-arrow prev" onclick="moveSlide(-1)" aria-label="Anterior">‹</button>
            <button type="button" class="carousel-arrow next" onclick="moveSlide(1)" aria-label="Siguiente">›</button>

            <div class="carousel-dots" id="carouselDots">
                <button type="button" class="carousel-dot active" onclick="goToSlide(0)" aria-label="Slide 1"></button>
                <button type="button" class="carousel-dot" onclick="goToSlide(1)" aria-label="Slide 2"></button>
                <button type="button" class="carousel-dot" onclick="goToSlide(2)" aria-label="Slide 3"></button>
            </div>
        </div>
    </section>

    <!-- FRANJA DE CONFIANZA -->
    <section class="trust-strip">
        <div class="trust-grid">
            <div class="trust-item">
                <div class="trust-icon">🧶</div>
                <div>
                    <h4 data-i18n="trust1Title">100% Hecho a Mano</h4>
                    <p data-i18n="trust1Desc">Fibras naturales seleccionadas</p>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon">🤝</div>
                <div>
                    <h4 data-i18n="trust2Title">Comercio Justo</h4>
                    <p data-i18n="trust2Desc">Trato directo con artesanos</p>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon">📦</div>
                <div>
                    <h4 data-i18n="trust3Title">Envíos Nacionales</h4>
                    <p data-i18n="trust3Desc">Embalaje seguro garantizado</p>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon">💬</div>
                <div>
                    <h4 data-i18n="trust4Title">Atención Inmediata</h4>
                    <p data-i18n="trust4Desc">Soporte y pedidos por WhatsApp</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CATÁLOGO DE PRODUCTOS -->
    <section class="catalog-section" id="catalogo">
        <div class="catalog-toolbar">
            <div class="catalog-title-box">
                <h2 data-i18n="catalogTitle">Nuestros Productos</h2>
                <p id="catalogCountText">Mostrando {{ $productosCollection->count() }} productos artesanales disponibles</p>
            </div>

            <select id="sortSelect" class="sort-select" onchange="filtrarYOrdenarProductos()">
                <option value="default" data-i18n="sortDefault">Ordenar por: Destacados</option>
                <option value="price-asc" data-i18n="sortPriceAsc">Precio: Menor a Mayor</option>
                <option value="price-desc" data-i18n="sortPriceDesc">Precio: Mayor a Menor</option>
                <option value="name-asc" data-i18n="sortNameAsc">Nombre: A - Z</option>
            </select>
        </div>

        <!-- PESTAÑAS DE CATEGORÍAS -->
        <div class="category-pills" id="categoryPills">
            <button type="button" class="cat-pill active" data-category="all" onclick="selectCategory('all', this)">
                <span data-i18n="allCategories">Todos</span> ({{ $productosCollection->count() }})
            </button>
            @foreach($categoriasDisponibles as $cat)
                <button type="button" class="cat-pill" data-category="{{ mb_strtolower($cat) }}" onclick="selectCategory('{{ mb_strtolower($cat) }}', this)">
                    {{ $cat }}
                </button>
            @endforeach
        </div>

        <div class="product-grid" id="productGrid">
            @forelse($productosCollection as $producto)
                @php
                    $imgUrl = $resolverImagen($producto->imagen ?? null, $producto->nombre ?? '');
                    $artesanoNombre = $producto->artesano->nombre ?? 'Maestro Artesano';
                    $inicial = mb_strtoupper(mb_substr($artesanoNombre, 0, 1));
                    $categoriaTexto = $producto->categoria ?? 'Artesanía';
                    $stockVal = (int) ($producto->stock ?? 10);
                    $msgWa = rawurlencode("Hola, deseo consultar/comprar el producto artesanal: {$producto->nombre} (S/ " . number_format($producto->precio, 2) . ").");
                @endphp

                <article class="product-card"
                         data-id="{{ $producto->id }}"
                         data-name="{{ mb_strtolower($producto->nombre) }}"
                         data-category="{{ mb_strtolower($categoriaTexto) }}"
                         data-artisan="{{ mb_strtolower($artesanoNombre) }}"
                         data-price="{{ (float) $producto->precio }}"
                         data-stock="{{ $stockVal }}">

                    <div class="product-image-container" onclick="openQuickView({{ $producto->id }})">
                        <span class="product-badge">{{ $categoriaTexto }}</span>

                        <div class="no-image-placeholder">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span data-i18n="noImage">Sin imagen</span>
                        </div>

                        @if($imgUrl)
                            <img src="{{ $imgUrl }}"
                                 alt="{{ $producto->nombre }}"
                                 class="product-image"
                                 onerror="this.style.display='none';">
                        @endif

                        <button type="button" class="btn-quick-view" onclick="event.stopPropagation(); openQuickView({{ $producto->id }})" data-i18n="quickView">
                            👁 Vista rápida
                        </button>
                    </div>

                    <div class="product-info">
                        <div class="product-category-label">{{ $categoriaTexto }}</div>
                        <h3>{{ $producto->nombre }}</h3>

                        @if(!empty($producto->descripcion))
                            <p class="product-desc-preview">{{ $producto->descripcion }}</p>
                        @endif

                        @if($stockVal <= 0)
                            <span class="stock-pill stock-out" data-stock-badge>● <span data-i18n="outOfStock">Agotado</span></span>
                        @elseif($stockVal <= 3)
                            <span class="stock-pill stock-low" data-stock-badge>● <span data-i18n="lastUnits">Últimas</span> {{ $stockVal }} <span data-i18n="unitsWord">unid.</span></span>
                        @else
                            <span class="stock-pill stock-ok" data-stock-badge>● <span data-i18n="inStock">Disponible</span> ({{ $stockVal }})</span>
                        @endif

                        <div class="product-artisan">
                            <span class="avatar">{{ $inicial }}</span>
                            <span><strong data-i18n="byArtisan">Por</strong> {{ $artesanoNombre }}</span>
                        </div>

                        <div class="product-footer">
                            <div class="price-block">
                                <small data-i18n="unitPrice">Precio unitario</small>
                                <div class="product-price" data-price-label>S/ {{ number_format($producto->precio, 2) }}</div>
                            </div>

                            <div class="card-buttons">
                                <button type="button"
                                        class="btn-add-cart"
                                        data-add-btn
                                        {{ $stockVal <= 0 ? 'disabled' : '' }}
                                        onclick="addToCart({{ $producto->id }})">
                                    <span>+</span>
                                    <span data-i18n="addBtn">Agregar</span>
                                </button>

                                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $msgWa }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="btn-whatsapp"
                                   title="Consultar por WhatsApp"
                                   aria-label="Consultar por WhatsApp">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M12.031 2c-5.516 0-9.969 4.453-9.969 9.969 0 1.763.461 3.484 1.336 5.008L2 22l5.148-1.352A9.92 9.92 0 0 0 12.031 22c5.516 0 9.969-4.453 9.969-9.969S17.547 2 12.031 2zm5.813 14.125c-.242.68-1.406 1.305-1.93 1.383-.492.07-1.133.102-1.828-.117-.422-.133-.961-.312-1.648-.609-2.906-1.25-4.805-4.188-4.953-4.383-.141-.195-1.18-1.57-1.18-2.992 0-1.422.742-2.125 1.008-2.414.266-.289.578-.359.773-.359.195 0 .391.008.563.016.18.008.422-.07.664.508.242.578.828 2.016.906 2.164.078.148.125.32.023.516-.094.195-.148.32-.289.492-.148.172-.305.383-.438.516-.148.148-.305.313-.133.609.172.297.766 1.258 1.641 2.039 1.125 1.0 2.07 1.313 2.367 1.461.297.148.469.125.641-.07.172-.195.742-.867.938-1.164.195-.297.398-.25.664-.148.273.094 1.711.805 2.008.953.297.148.492.219.563.344.07.125.07.727-.172 1.406z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-filter-box">
                    <h3 data-i18n="emptyCatalogTitle">Aún no hay productos publicados</h3>
                    <p style="color: var(--text-muted);" data-i18n="emptyCatalogDesc">Pronto nuestros artesanos cargarán nuevas creaciones en el catálogo.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- SOBRE NOSOTROS -->
    <section class="about-section" id="nosotros">
        <div class="about-card">
            <div>
                <span class="product-category-label" data-i18n="aboutLabel">NUESTRA IDENTIDAD</span>
                <h2 data-i18n="aboutTitle">Preservando el Arte Popular del Perú</h2>
                <p data-i18n="aboutDesc">
                    Somos una plataforma dedicada a visibilizar y comercializar el trabajo de artesanos locales. Cada pieza refleja identidad, dedicación y comercio justo sin intermediarios.
                </p>
                <div class="about-stats">
                    <div class="stat-box">
                        <strong>100%</strong>
                        <span data-i18n="statHandmade">Artesanal</span>
                    </div>
                    <div class="stat-box">
                        <strong>{{ $productosCollection->count() }}+</strong>
                        <span data-i18n="statPieces">Creaciones</span>
                    </div>
                    <div class="stat-box">
                        <strong>Perú</strong>
                        <span data-i18n="statOrigin">Origen Local</span>
                    </div>
                </div>
            </div>

            <div class="contact-cta-box" id="contacto">
                <h3 data-i18n="contactTitle">¿Buscas pedidos al por mayor o regalos corporativos?</h3>
                <p data-i18n="contactDesc">Escríbenos directamente a nuestro WhatsApp oficial para cotizaciones personalizadas y envíos a todo el país.</p>
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ rawurlencode('Hola ArtesanosStore, deseo información sobre pedidos y catálogo.') }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="btn-hero-primary"
                   style="display:inline-block;"
                   data-i18n="contactBtn">
                    Chatear por WhatsApp
                </a>
            </div>
        </div>
    </section>

    <!-- MODAL VISTA RÁPIDA -->
    <div class="modal-overlay" id="quickViewModal" onclick="if(event.target === this) closeQuickView()">
        <div class="quick-modal">
            <button type="button" class="btn-close-modal" onclick="closeQuickView()">✕</button>
            <img id="qvImage" src="" alt="" class="quick-modal-img" onerror="this.style.display='none';">
            <div class="quick-modal-body">
                <div>
                    <div class="product-category-label" id="qvCategory"></div>
                    <h3 id="qvTitle" style="margin:0.25rem 0 0.65rem 0;font-size:1.5rem;font-weight:800;text-transform:capitalize;"></h3>
                    <p id="qvDesc" style="color:var(--text-muted);font-size:0.9rem;line-height:1.6;margin:0 0 1rem 0;"></p>
                    <div style="font-size:0.85rem;color:var(--text-muted);margin-bottom:1rem;">
                        <strong data-i18n="artisanLabel">Artesano:</strong> <span id="qvArtisan"></span>
                    </div>
                </div>

                <div>
                    <div id="qvPrice" style="font-size:1.65rem;font-weight:900;color:var(--text-dark);margin-bottom:1rem;"></div>
                    <div style="display:flex;gap:0.65rem;">
                        <button type="button" id="qvAddCartBtn" class="btn-add-cart" style="flex:1;justify-content:center;padding:0.8rem;" data-i18n="addToCart">
                            Agregar al carrito
                        </button>
                        <a id="qvWaLink" href="#" target="_blank" rel="noopener noreferrer" class="btn-whatsapp" style="padding:0.8rem 1rem;gap:6px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12.031 2c-5.516 0-9.969 4.453-9.969 9.969 0 1.763.461 3.484 1.336 5.008L2 22l5.148-1.352A9.92 9.92 0 0 0 12.031 22c5.516 0 9.969-4.453 9.969-9.969S17.547 2 12.031 2zm5.813 14.125c-.242.68-1.406 1.305-1.93 1.383-.492.07-1.133.102-1.828-.117-.422-.133-.961-.312-1.648-.609-2.906-1.25-4.805-4.188-4.953-4.383-.141-.195-1.18-1.57-1.18-2.992 0-1.422.742-2.125 1.008-2.414.266-.289.578-.359.773-.359.195 0 .391.008.563.016.18.008.422-.07.664.508.242.578.828 2.016.906 2.164.078.148.125.32.023.516-.094.195-.148.32-.289.492-.148.172-.305.383-.438.516-.148.148-.305.313-.133.609.172.297.766 1.258 1.641 2.039 1.125 1.0 2.07 1.313 2.367 1.461.297.148.469.125.641-.07.172-.195.742-.867.938-1.164.195-.297.398-.25.664-.148.273.094 1.711.805 2.008.953.297.148.492.219.563.344.07.125.07.727-.172 1.406z"/>
                            </svg>
                            <span>WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DRAWER CARRITO DE COMPRAS -->
    <div class="cart-drawer-backdrop" id="cartDrawerBackdrop" onclick="if(event.target === this) toggleCartDrawer(false)">
        <aside class="cart-drawer">
            <div class="cart-header">
                <h3 data-i18n="cartTitle">🛒 Tu Carrito Artesanal</h3>
                <button type="button" class="qty-btn" style="width:32px;height:32px;" onclick="toggleCartDrawer(false)">✕</button>
            </div>

            <div class="cart-items" id="cartItemsContainer"></div>

            <div class="cart-footer">
                <div class="cart-total-row">
                    <span data-i18n="estimatedTotal">Total estimado</span>
                    <strong id="cartTotalAmount">S/ 0.00</strong>
                </div>

                <!-- FORMULARIO PARA FINALIZAR COMPRA -->
                <div style="margin-bottom: 1rem;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; display: block;">DNI para la compra:</label>
                    <input type="text" id="dniClienteInput" maxlength="8" placeholder="Ingresa tu DNI (8 dígitos)" style="width: 100%; padding: 0.7rem; border-radius: 10px; border: 1px solid #CBD5E1; font-family: inherit; font-size: 0.9rem; outline: none;">
                </div>

                <button type="button" class="btn-checkout-wa" style="background: linear-gradient(135deg, #4F46E5, #06B6D4); margin-bottom: 0.5rem;" onclick="procesarCompra()" id="btnComprar">
                    Comprar Ahora
                </button>

                <button type="button" class="btn-checkout-wa" style="background: #22C55E;" onclick="checkoutWhatsApp()" data-i18n="sendOrderWa">
                    Consultar por WhatsApp
                </button>
            </div>
        </aside>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div>
                <div class="footer-brand">Artesanos<span style="color:#38BDF8;">Store</span></div>
                <p style="margin:0.35rem 0 0 0;font-size:0.85rem;" data-i18n="footerTagline">Arte tradicional peruano hecho a mano con pasión.</p>
            </div>
            <div style="font-size:0.85rem;">
                <strong style="color:white;" data-i18n="directChannel">Canal directo:</strong> +{{ $whatsappNumber }}
            </div>
        </div>
        <div class="footer-bottom">
            <span>© {{ date('Y') }} ArtesanosStore · <span data-i18n="rightsReserved">Todos los derechos reservados.</span></span>
            <span data-i18n="madeWithLove">Hecho con ❤️ impulsando el talento local</span>
        </div>
    </footer>

    @php
        $productosJson = $productosCollection->map(function($p) use ($whatsappNumber, $resolverImagen) {
            $img = $resolverImagen($p->imagen ?? null, $p->nombre ?? '');
            $artesano = $p->artesano->nombre ?? 'Maestro Artesano';
            return [
                'id' => $p->id,
                'nombre' => $p->nombre,
                'categoria' => $p->categoria ?? 'Artesanía',
                'descripcion' => $p->descripcion ?? 'Pieza artesanal elaborada a mano con dedicación y técnicas tradicionales.',
                'precio' => (float) $p->precio,
                'stock' => (int) ($p->stock ?? 10),
                'artesano' => $artesano,
                'imagen' => $img,
                'wa' => 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode("Hola, deseo consultar/comprar: {$p->nombre} (S/ " . number_format($p->precio, 2) . ").")
            ];
        })->values();
    @endphp

    <script>
        const PRODUCTS_DATA = @json($productosJson);
        const WHATSAPP_NUMBER = "{{ $whatsappNumber }}";
        const CART_STORAGE_KEY = 'artesanos_store_cart_v1';
        const LANG_STORAGE_KEY = 'artesanos_store_lang_v1';
        const AUTH_USER_NAME = @auth "{{ addslashes(Auth::user()->name ?? 'Usuario') }}" @else "Usuario" @endauth;
        const IS_AUTHENTICATED = @auth true @else false @endauth;

        const I18N = {
            es: {
                promoPill: 'COLECCIÓN ARTESANAL 2026',
                promoText: 'Envíos seguros a todo el Perú · Piezas únicas tejidas a mano por maestros artesanos',
                navHome: 'Inicio',
                navCatalog: 'Catálogo',
                navAbout: 'Sobre Nosotros',
                navContact: 'Contacto',
                loginBtn: 'Ingresar',
                panelBtn: 'Panel',
                profileLink: 'Mi Perfil',
                recoverPassLink: 'Recuperar Contraseña',
                goPanel: 'Ir al Panel',
                logoutBtn: 'Cerrar Sesión',
                searchPlaceholder: 'Buscar chalinas, ponchos o artesanos...',
                slide1Tag: '✦ Arte Textil & Tradición Viva',
                slide1Title: 'Piezas Únicas Hechas a Mano con Alma Peruana',
                slide1Desc: 'Descubre creaciones auténticas elaboradas por maestros artesanos. Cada tejido, bordado y detalle conserva siglos de historia y cultura.',
                slide1Btn1: 'Explorar Catálogo',
                slide1Btn2: 'Conocer Artesanos',
                slide2Tag: '✦ Pedidos Personalizados',
                slide2Title: 'Arma tu Pedido en el Carrito Virtual',
                slide2Desc: 'Selecciona varios productos, ajusta cantidades y envía tu orden completa en un clic directo a nuestro canal empresarial de WhatsApp.',
                slide2Btn1: 'Abrir Mi Carrito',
                slide2Btn2: 'Seguir Comprando',
                slide3Tag: '✦ Impacto Social Directo',
                slide3Title: 'Apoya Directamente a Familias Artesanas',
                slide3Desc: 'Sin intermediarios abusivos: cada compra impulsa talleres locales, preserva técnicas ancestrales y fortalece la economía familiar.',
                slide3Btn1: 'Ver Productos',
                slide3Btn2: 'Contactar Asesor',
                trust1Title: '100% Hecho a Mano',
                trust1Desc: 'Fibras naturales seleccionadas',
                trust2Title: 'Comercio Justo',
                trust2Desc: 'Trato directo con artesanos',
                trust3Title: 'Envíos Nacionales',
                trust3Desc: 'Embalaje seguro garantizado',
                trust4Title: 'Atención Inmediata',
                trust4Desc: 'Soporte y pedidos por WhatsApp',
                catalogTitle: 'Nuestros Productos',
                sortDefault: 'Ordenar por: Destacados',
                sortPriceAsc: 'Precio: Menor a Mayor',
                sortPriceDesc: 'Precio: Mayor a Menor',
                sortNameAsc: 'Nombre: A - Z',
                allCategories: 'Todos',
                noImage: 'Sin imagen',
                quickView: '👁 Vista rápida',
                outOfStock: 'Agotado',
                lastUnits: 'Últimas',
                unitsWord: 'unid.',
                inStock: 'Disponible',
                byArtisan: 'Por',
                unitPrice: 'Precio unitario',
                addBtn: 'Agregar',
                emptyCatalogTitle: 'Aún no hay productos publicados',
                emptyCatalogDesc: 'Pronto nuestros artesanos cargarán nuevas creaciones en el catálogo.',
                aboutLabel: 'NUESTRA IDENTIDAD',
                aboutTitle: 'Preservando el Arte Popular del Perú',
                aboutDesc: 'Somos una plataforma dedicada a visibilizar y comercializar el trabajo de artesanos locales. Cada pieza refleja identidad, dedicación y comercio justo sin intermediarios.',
                statHandmade: 'Artesanal',
                statPieces: 'Creaciones',
                statOrigin: 'Origen Local',
                contactTitle: '¿Buscas pedidos al por mayor o regalos corporativos?',
                contactDesc: 'Escríbenos directamente a nuestro WhatsApp oficial para cotizaciones personalizadas y envíos a todo el país.',
                contactBtn: 'Chatear por WhatsApp',
                artisanLabel: 'Artesano:',
                addToCart: 'Agregar al carrito',
                cartTitle: '🛒 Tu Carrito Artesanal',
                estimatedTotal: 'Total estimado',
                sendOrderWa: 'Enviar Pedido por WhatsApp',
                footerTagline: 'Arte tradicional peruano hecho a mano con pasión.',
                directChannel: 'Canal directo:',
                rightsReserved: 'Todos los derechos reservados.',
                madeWithLove: 'Hecho con ❤️ impulsando el talento local',
                showingPrefix: 'Mostrando',
                showingSuffix: 'productos artesanales disponibles',
                emptyCartText: 'Tu carrito está vacío. Agrega productos artesanales para armar tu pedido.',
                noMatchTitle: 'No se encontraron productos',
                noMatchDesc: 'Intenta con otra palabra clave o cambia la categoría seleccionada.',
                clearFilters: 'Limpiar filtros',
                addedToast: 'agregado al carrito',
                emptyCartAlert: 'Tu carrito está vacío. Agrega al menos un producto antes de enviar por WhatsApp.'
            },
            en: {
                promoPill: 'ARTISAN COLLECTION 2026',
                promoText: 'Safe shipping across Peru · One-of-a-kind pieces handwoven by master artisans',
                navHome: 'Home',
                navCatalog: 'Catalog',
                navAbout: 'About Us',
                navContact: 'Contact',
                loginBtn: 'Sign In',
                panelBtn: 'Dashboard',
                profileLink: 'My Profile',
                recoverPassLink: 'Forgot Password',
                goPanel: 'Go to Dashboard',
                logoutBtn: 'Log Out',
                searchPlaceholder: 'Search scarves, ponchos or artisans...',
                slide1Tag: '✦ Textile Art & Living Tradition',
                slide1Title: 'Unique Handmade Pieces with Peruvian Soul',
                slide1Desc: 'Discover authentic creations crafted by master artisans. Every weave, embroidery, and detail preserves centuries of history and culture.',
                slide1Btn1: 'Explore Catalog',
                slide1Btn2: 'Meet Artisans',
                slide2Tag: '✦ Custom Orders',
                slide2Title: 'Build Your Order in the Virtual Cart',
                slide2Desc: 'Select multiple items, adjust quantities, and send your complete order in one click straight to our business WhatsApp.',
                slide2Btn1: 'Open My Cart',
                slide2Btn2: 'Keep Shopping',
                slide3Tag: '✦ Direct Social Impact',
                slide3Title: 'Directly Support Artisan Families',
                slide3Desc: 'No unfair middlemen: every purchase empowers local workshops, preserves ancestral techniques, and strengthens family economies.',
                slide3Btn1: 'View Products',
                slide3Btn2: 'Contact Advisor',
                trust1Title: '100% Handmade',
                trust1Desc: 'Selected natural fibers',
                trust2Title: 'Fair Trade',
                trust2Desc: 'Direct relationship with artisans',
                trust3Title: 'Nationwide Shipping',
                trust3Desc: 'Guaranteed safe packaging',
                trust4Title: 'Instant Support',
                trust4Desc: 'Assistance & orders via WhatsApp',
                catalogTitle: 'Our Products',
                sortDefault: 'Sort by: Featured',
                sortPriceAsc: 'Price: Low to High',
                sortPriceDesc: 'Price: High to Low',
                sortNameAsc: 'Name: A - Z',
                allCategories: 'All',
                noImage: 'No image',
                quickView: '👁 Quick view',
                outOfStock: 'Out of stock',
                lastUnits: 'Only',
                unitsWord: 'left',
                inStock: 'In stock',
                byArtisan: 'By',
                unitPrice: 'Unit price',
                addBtn: 'Add',
                emptyCatalogTitle: 'No products published yet',
                emptyCatalogDesc: 'Our artisans will soon upload new creations to the catalog.',
                aboutLabel: 'OUR IDENTITY',
                aboutTitle: 'Preserving Peruvian Folk Art',
                aboutDesc: 'We are a platform dedicated to showcasing and selling the work of local artisans. Every piece reflects identity, dedication, and fair trade.',
                statHandmade: 'Handmade',
                statPieces: 'Creations',
                statOrigin: 'Local Origin',
                contactTitle: 'Looking for wholesale orders or corporate gifts?',
                contactDesc: 'Message our official WhatsApp directly for custom quotes and nationwide shipping.',
                contactBtn: 'Chat on WhatsApp',
                artisanLabel: 'Artisan:',
                addToCart: 'Add to cart',
                cartTitle: '🛒 Your Artisan Cart',
                estimatedTotal: 'Estimated total',
                sendOrderWa: 'Send Order via WhatsApp',
                footerTagline: 'Traditional Peruvian art handmade with passion.',
                directChannel: 'Direct line:',
                rightsReserved: 'All rights reserved.',
                madeWithLove: 'Made with ❤️ empowering local talent',
                showingPrefix: 'Showing',
                showingSuffix: 'artisan products available',
                emptyCartText: 'Your cart is empty. Add artisan products to build your order.',
                noMatchTitle: 'No products found',
                noMatchDesc: 'Try another keyword or switch the selected category.',
                clearFilters: 'Clear filters',
                addedToast: 'added to cart',
                emptyCartAlert: 'Your cart is empty. Add at least one product before sending via WhatsApp.'
            },
            qu: {
                promoPill: 'MAKI RURAY HUÑU 2026',
                promoText: 'Tukuy Peruman apayku · Yachaq maki ruraqkunap awasqan sapan rurukuna',
                navHome: 'Qallariy',
                navCatalog: 'Rurukuna',
                navAbout: 'Ñoqaykumanta',
                navContact: 'Willanakuy',
                loginBtn: 'Yaykuy',
                panelBtn: 'Panel',
                profileLink: 'Ñoqapa Perfilniy',
                recoverPassLink: 'Pakasqa Simi Kutichiy',
                goPanel: 'Panelman Riy',
                logoutBtn: 'Lloqsiy',
                searchPlaceholder: 'Chalinakuna, ponchokuna icha maki ruraq maskay...',
                slide1Tag: '✦ Maki Awana & Kawsay Kawsachiy',
                slide1Title: 'Piruw Sunquwan Makiwan Rurasqa Sapan Rurukuna',
                slide1Desc: 'Yachaq maki ruraqkunap sumaq rurasqankunata riqsiy. Sapa away, qillqay ima unay kawsayninchikta waqaychan.',
                slide1Btn1: 'Rurukunata Rikuy',
                slide1Btn2: 'Ruraqkunata Riqsiy',
                slide2Tag: '✦ Munayniyki Ruraykuna',
                slide2Title: 'Carrito Virtualpi Rantisqaykita Huñuy',
                slide2Desc: 'Achka rurukunata akllay, hayk’achus kasqanta allichay, hinaspataq WhatsApp nisqawan hukllapi apachiy.',
                slide2Btn1: 'Carritoyta Kichay',
                slide2Btn2: 'Rantispalla Puriy',
                slide3Tag: '✦ Ayllukunata Yanapay',
                slide3Title: 'Maki Ruraq Ayllukunata Chiqaptapuni Yanapay',
                slide3Desc: 'Mana chawpi runakunawan: sapa rantiymi llaqta talleresta kallpanchan, ñawpa yachaykunatataq waqaychan.',
                slide3Btn1: 'Rurukunata Rikuy',
                slide3Btn2: 'Yanapuqwan Rimay',
                trust1Title: '100% Maki Rurasqa',
                trust1Desc: 'Sumaq millwakunawan awasqa',
                trust2Title: 'Chaninchasqa Rantiy',
                trust2Desc: 'Maki ruraqkunawan chiqan rimay',
                trust3Title: 'Tukuy Llaqtaman Apay',
                trust3Desc: 'Allin waqaychasqa apayku',
                trust4Title: 'Chaniqlla Yanapay',
                trust4Desc: 'WhatsApp nisqawan yanapay',
                catalogTitle: 'Rurukuna',
                sortDefault: 'Ñawpaqchasqa',
                sortPriceAsc: 'Chanin: Uraymanta Hananman',
                sortPriceDesc: 'Chanin: Hananmanta Urayman',
                sortNameAsc: 'Suti: A - Z',
                allCategories: 'Llapan',
                noImage: 'Mana rikchay kan',
                quickView: '👁 Usqaylla qaway',
                outOfStock: 'Tukusqa',
                lastUnits: 'Pisi',
                unitsWord: 'kan',
                inStock: 'Kachkanmi',
                byArtisan: 'Ruraq:',
                unitPrice: 'Hukpa chanin',
                addBtn: 'Yapay',
                emptyCatalogTitle: 'Manaraqmi rurukuna kanchu',
                emptyCatalogDesc: 'Ñoqaykupa maki ruraqniykunaqa pisi tiempollapi musuq rurukunata churamunqaku.',
                aboutLabel: 'ÑOQAYKUPA KAWSAYNIYKU',
                aboutTitle: 'Piruw Maki Rurayta Waqaychaspa',
                aboutDesc: 'Llaqtanchikpi maki ruraqkunap llank’ayninta rikuchinapaq rantinapaqwan llamk’ayku. Sapa ruruqa sunquwan rurasqam.',
                statHandmade: 'Maki Rurasqa',
                statPieces: 'Rurukuna',
                statOrigin: 'Llaqtanchikmanta',
                contactTitle: '¿Achkatachu rantiyta munanki icha regalokunatachu?',
                contactDesc: 'WhatsApp nisqaykuman qillqamuy, hinaspataq tukuy suyuman apachimusqayku.',
                contactBtn: 'WhatsApp-pi Rimay',
                artisanLabel: 'Ruraq:',
                addToCart: 'Carritoman yapay',
                cartTitle: '🛒 Maki Ruray Carritoyki',
                estimatedTotal: 'Llapan chanin',
                sendOrderWa: 'WhatsApp-wan Apachiy',
                footerTagline: 'Piruw ñawpa maki ruray munaywan awasqa.',
                directChannel: 'Chiqan willanakuy:',
                rightsReserved: 'Llapan hayñikuna waqaychasqa.',
                madeWithLove: 'Munaywan rurasqa ❤️ llaqtanchikta kallpanchaspa',
                showingPrefix: 'Rikuchkan',
                showingSuffix: 'maki ruraq rurukuna kachkan',
                emptyCartText: 'Carritoykiqa ch’usaqmi. Rurukunata yapay rantiykipaq.',
                noMatchTitle: 'Manam rurukuna tarikuytachu atirqan',
                noMatchDesc: 'Huk simiwan maskay icha huk rikch’ayta akllay.',
                clearFilters: 'Maskayta pichay',
                addedToast: 'carritoman yapasqa',
                emptyCartAlert: 'Carritoykiqa ch’usaqmi. Huk rurutaraq yapay WhatsApp-wan apachinaykipaq.'
            }
        };

        function resolveInitialLang() {
            const urlLang = new URLSearchParams(window.location.search).get('lang');
            if (urlLang && I18N[urlLang]) {
                localStorage.setItem(LANG_STORAGE_KEY, urlLang);
                return urlLang;
            }
            const saved = localStorage.getItem(LANG_STORAGE_KEY);
            if (saved && I18N[saved]) {
                return saved;
            }
            return 'es';
        }

        let currentLang = resolveInitialLang();
        let currentSlide = 0;
        const totalSlides = 3;
        let carouselTimer = null;
        let selectedCategory = 'all';
        let currentVisibleCount = {{ $productosCollection->count() }};
        let cart = [];
        let welcomeVoiceQueue = null;
        let socketArtesanosBound = false;
        let hasUserInteracted = false;

        function armarBienvenidaTienda(nombreUsuario = AUTH_USER_NAME) {
            const usuario = (nombreUsuario && String(nombreUsuario).trim())
                ? String(nombreUsuario).trim()
                : AUTH_USER_NAME;

            if (currentLang === 'en') {
                return `Welcome to our store ${usuario}, thank you for trusting us. If you have any questions, don't forget to contact the administrator.`;
            }
            if (currentLang === 'qu') {
                return `Allillanchu tiendaykuman ${usuario}, ñuqaykupi confiasqaykimanta añay. Tapukuyniyki kaptinqa, ama qonqaychu administradorwan rimayta.`;
            }
            return `Bienvenidos a nuestra tienda ${usuario}, gracias por confiar con nosotros. Si tienes alguna duda, no te olvides comunicarte con el administrador.`;
        }

        function getSpeechLang() {
            return currentLang === 'en' ? 'en-US' : 'es-PE';
        }

        function hablarEnVozAlta(texto) {
            if (!('speechSynthesis' in window) || !texto) return false;
            try {
                const utterance = new SpeechSynthesisUtterance(texto);
                utterance.lang = getSpeechLang();
                utterance.rate = 1;
                utterance.pitch = 1;
                window.speechSynthesis.cancel();
                window.speechSynthesis.speak(utterance);
                return true;
            } catch (e) {
                return false;
            }
        }
        window.hablarEnVozAlta = hablarEnVozAlta;

        function unlockAndSpeakQueuedVoice() {
            hasUserInteracted = true;
            if (welcomeVoiceQueue && 'speechSynthesis' in window) {
                const msg = welcomeVoiceQueue;
                welcomeVoiceQueue = null;
                hablarEnVozAlta(msg);
            }
        }

        document.addEventListener('pointerdown', unlockAndSpeakQueuedVoice, { passive: true });
        document.addEventListener('keydown', unlockAndSpeakQueuedVoice, { passive: true });
        document.addEventListener('click', unlockAndSpeakQueuedVoice, { passive: true });

        function t(key) {
            return (I18N[currentLang] && I18N[currentLang][key]) || I18N.es[key] || key;
        }

        function updateCatalogCountLabel() {
            const label = document.getElementById('catalogCountText');
            if (label) {
                label.textContent = `${t('showingPrefix')} ${currentVisibleCount} ${t('showingSuffix')}`;
            }
        }

        function setLanguage(lang, notifyVoice = false) {
            currentLang = I18N[lang] ? lang : 'es';
            localStorage.setItem(LANG_STORAGE_KEY, currentLang);
            document.documentElement.lang = currentLang;

            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.lang === currentLang);
            });

            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (I18N[currentLang] && I18N[currentLang][key]) {
                    el.textContent = I18N[currentLang][key];
                }
            });

            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.placeholder = t('searchPlaceholder');
            }

            updateCatalogCountLabel();
            renderCart();
            initSocketStatusIndicator();

            if (notifyVoice && hasUserInteracted) {
                hablarEnVozAlta(armarBienvenidaTienda(AUTH_USER_NAME));
            }
        }

        function toggleUserDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('userDropdown');
            const btn = event.currentTarget;
            if (!dropdown) return;
            const isOpen = dropdown.classList.toggle('open');
            btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        }

        document.addEventListener('click', (event) => {
            const dropdown = document.getElementById('userDropdown');
            const wrapper = document.getElementById('userMenuWrapper');
            if (dropdown && wrapper && !wrapper.contains(event.target)) {
                dropdown.classList.remove('open');
            }
        });

        function goToSlide(index) {
            currentSlide = (index + totalSlides) % totalSlides;
            const track = document.getElementById('carouselTrack');
            if (track) {
                track.style.transform = `translateX(-${currentSlide * 100}%)`;
            }
            document.querySelectorAll('#carouselDots .carousel-dot').forEach((dot, idx) => {
                dot.classList.toggle('active', idx === currentSlide);
            });
            resetCarouselAutoplay();
        }

        function moveSlide(step) {
            goToSlide(currentSlide + step);
        }

        function resetCarouselAutoplay() {
            clearInterval(carouselTimer);
            carouselTimer = setInterval(() => moveSlide(1), 5500);
        }

        function selectCategory(category, btnElement) {
            selectedCategory = category;
            document.querySelectorAll('#categoryPills .cat-pill').forEach(b => b.classList.remove('active'));
            if (btnElement) btnElement.classList.add('active');
            filtrarYOrdenarProductos();
        }

        function resetAllFilters() {
            const searchInput = document.getElementById('searchInput');
            const sortSelect = document.getElementById('sortSelect');
            if (searchInput) searchInput.value = '';
            if (sortSelect) sortSelect.value = 'default';
            selectedCategory = 'all';
            document.querySelectorAll('#categoryPills .cat-pill').forEach((b, i) => {
                b.classList.toggle('active', i === 0);
            });
            filtrarYOrdenarProductos();
        }

        function filtrarYOrdenarProductos() {
            const query = (document.getElementById('searchInput')?.value || '').trim().toLowerCase();
            const sortBy = document.getElementById('sortSelect')?.value || 'default';
            const grid = document.getElementById('productGrid');
            if (!grid) return;

            const cards = Array.from(grid.querySelectorAll('.product-card'));
            const existingEmpty = grid.querySelector('.empty-filter-box');
            if (existingEmpty) existingEmpty.remove();

            const matched = cards.filter(card => {
                const name = card.dataset.name || '';
                const category = card.dataset.category || '';
                const artisan = card.dataset.artisan || '';
                const matchesCat = selectedCategory === 'all' || category === selectedCategory;
                const matchesQuery = !query || name.includes(query) || category.includes(query) || artisan.includes(query);
                return matchesCat && matchesQuery;
            });

            if (sortBy !== 'default') {
                matched.sort((a, b) => {
                    if (sortBy === 'price-asc') return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                    if (sortBy === 'price-desc') return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                    if (sortBy === 'name-asc') return (a.dataset.name || '').localeCompare(b.dataset.name || '');
                    return 0;
                });
            }

            cards.forEach(c => c.style.display = 'none');
            matched.forEach(c => {
                c.style.display = 'flex';
                grid.appendChild(c);
            });

            currentVisibleCount = matched.length;
            updateCatalogCountLabel();

            if (matched.length === 0 && cards.length > 0) {
                const box = document.createElement('div');
                box.className = 'empty-filter-box';
                box.innerHTML = `
                    <h3>${t('noMatchTitle')}</h3>
                    <p style="color: var(--text-muted);">${t('noMatchDesc')}</p>
                    <button type="button" class="btn-reset-filters" onclick="resetAllFilters()">${t('clearFilters')}</button>
                `;
                grid.appendChild(box);
            }
        }

        function openQuickView(productId) {
            const prod = PRODUCTS_DATA.find(p => Number(p.id) === Number(productId));
            if (!prod) return;

            document.getElementById('qvCategory').textContent = prod.categoria;
            document.getElementById('qvTitle').textContent = prod.nombre;
            document.getElementById('qvDesc').textContent = prod.descripcion;
            document.getElementById('qvArtisan').textContent = prod.artesano;
            document.getElementById('qvPrice').textContent = `S/ ${Number(prod.precio).toFixed(2)}`;
            document.getElementById('qvWaLink').href = prod.wa;

            const imgEl = document.getElementById('qvImage');
            if (prod.imagen) {
                imgEl.src = prod.imagen;
                imgEl.style.display = 'block';
            } else {
                imgEl.style.display = 'none';
            }

            const addBtn = document.getElementById('qvAddCartBtn');
            addBtn.disabled = Number(prod.stock) <= 0;
            addBtn.onclick = () => {
                addToCart(prod.id);
                closeQuickView();
            };

            document.getElementById('quickViewModal').classList.add('open');
        }

        function closeQuickView() {
            document.getElementById('quickViewModal').classList.remove('open');
        }

        function loadCart() {
            try {
                const raw = localStorage.getItem(CART_STORAGE_KEY);
                cart = raw ? JSON.parse(raw) : [];
            } catch (e) {
                cart = [];
            }
            renderCart();
        }

        function saveCart() {
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
            renderCart();
        }

        function addToCart(productId) {
            const prod = PRODUCTS_DATA.find(p => Number(p.id) === Number(productId));
            if (!prod || Number(prod.stock) <= 0) return;

            const existing = cart.find(item => Number(item.id) === Number(productId));
            if (existing) {
                if (existing.qty < Number(prod.stock)) {
                    existing.qty += 1;
                }
            } else {
                cart.push({
                    id: prod.id,
                    nombre: prod.nombre,
                    precio: Number(prod.precio),
                    imagen: prod.imagen,
                    qty: 1
                });
            }
            saveCart();
            showToastLocal(`${prod.nombre} ${t('addedToast')}.`);
        }

        function updateQty(productId, delta) {
            const item = cart.find(i => Number(i.id) === Number(productId));
            if (!item) return;
            item.qty += delta;
            if (item.qty <= 0) {
                cart = cart.filter(i => Number(i.id) !== Number(productId));
            }
            saveCart();
        }

        function renderCart() {
            const container = document.getElementById('cartItemsContainer');
            const badge = document.getElementById('cartCountBadge');
            const totalEl = document.getElementById('cartTotalAmount');

            const totalQty = cart.reduce((acc, item) => acc + item.qty, 0);
            const totalPrice = cart.reduce((acc, item) => acc + (item.qty * item.precio), 0);

            if (badge) badge.textContent = totalQty;
            if (totalEl) totalEl.textContent = `S/ ${totalPrice.toFixed(2)}`;
            if (!container) return;

            if (cart.length === 0) {
                container.innerHTML = `
                    <div style="text-align:center;padding:2.5rem 1rem;color:var(--text-muted);">
                        <div style="font-size:2.2rem;margin-bottom:0.5rem;">🧺</div>
                        <p style="margin:0;font-size:0.9rem;">${t('emptyCartText')}</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = cart.map(item => `
                <div class="cart-item">
                    ${item.imagen ? `<img src="${item.imagen}" alt="${item.nombre}" onerror="this.style.display='none';">` : `<div style="width:62px;height:62px;border-radius:12px;background:#EEF2FF;display:flex;align-items:center;justify-content:center;">🧶</div>`}
                    <div class="cart-item-info">
                        <strong>${item.nombre}</strong>
                        <span>S/ ${(item.precio * item.qty).toFixed(2)}</span>
                        <div class="qty-controls">
                            <button type="button" class="qty-btn" onclick="updateQty(${item.id}, -1)">-</button>
                            <span style="font-size:0.84rem;font-weight:700;padding:0 4px;">${item.qty}</span>
                            <button type="button" class="qty-btn" onclick="updateQty(${item.id}, 1)">+</button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function toggleCartDrawer(open) {
            const backdrop = document.getElementById('cartDrawerBackdrop');
            if (!backdrop) return;
            backdrop.classList.toggle('open', Boolean(open));
        }

        function checkoutWhatsApp() {
            if (cart.length === 0) {
                alert(t('emptyCartAlert'));
                return;
            }
            let lines = ['Hola ArtesanosStore, tengo una consulta sobre el siguiente pedido:'];
            let total = 0;
            cart.forEach(item => {
                const sub = item.precio * item.qty;
                total += sub;
                lines.push(`• ${item.nombre} x${item.qty} = S/ ${sub.toFixed(2)}`);
            });
            lines.push(`Total estimado: S/ ${total.toFixed(2)}`);
            const url = `https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(lines.join('\n'))}`;
            window.open(url, '_blank', 'noopener,noreferrer');
        }

        async function procesarCompra() {
            if (cart.length === 0) {
                alert("Tu carrito está vacío.");
                return;
            }

            // 1. Validar si está logueado
            if (!IS_AUTHENTICATED) {
                window.location.href = "{{ route('login') }}";
                return;
            }

            // 2. Validar DNI
            const dniInput = document.getElementById('dniClienteInput').value.trim();
            if (dniInput.length !== 8 || isNaN(dniInput)) {
                alert("Por favor, ingresa un DNI válido de 8 dígitos.");
                return;
            }

            // 3. Preparar datos para enviar a Laravel
            const btn = document.getElementById('btnComprar');
            const originalText = btn.innerText;
            btn.innerText = 'Procesando...';
            btn.disabled = true;

            const payload = {
                dni_cliente: dniInput,
                productos: cart.map(item => ({ id: item.id, cantidad: item.qty }))
            };

            try {
                // 4. Enviar petición POST a la ruta /comprar que configuramos en web.php
                const response = await fetch("{{ route('ventas.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (data.success) {
                    alert('¡Compra realizada con éxito! Gracias por tu apoyo.');
                    cart = []; // Limpiar carrito
                    saveCart();
                    toggleCartDrawer(false); // Cerrar modal
                    window.location.reload(); // Recargar para actualizar stock
                } else {
                    alert('Error: ' + data.message);
                    btn.innerText = originalText;
                    btn.disabled = false;
                }
            } catch (error) {
                alert('Hubo un error de conexión al procesar tu compra.');
                btn.innerText = originalText;
                btn.disabled = false;
            }
        }

        function showToastLocal(message, title = 'ArtesanosStore') {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                bottom: 24px;
                right: 24px;
                background: linear-gradient(135deg, #0F172A, #312E81);
                color: white;
                padding: 0.9rem 1.2rem;
                border-radius: 16px;
                border: 1px solid rgba(251, 191, 36, 0.45);
                font-size: 0.85rem;
                font-weight: 600;
                box-shadow: 0 16px 32px rgba(15, 23, 42, 0.28);
                z-index: 3000;
                max-width: 340px;
            `;
            toast.innerHTML = `
                <div style="font-size:0.7rem;font-weight:800;color:#FDE68A;text-transform:uppercase;margin-bottom:2px;">${title}</div>
                <div style="line-height:1.4;">${message}</div>
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 4200);
        }

        function actualizarStockEnVista(productId, nuevoStock) {
            const stockNum = Number(nuevoStock);
            const prod = PRODUCTS_DATA.find(p => Number(p.id) === Number(productId));
            if (prod) prod.stock = stockNum;

            const card = document.querySelector(`.product-card[data-id="${productId}"]`);
            if (!card) return;

            card.dataset.stock = stockNum;
            const badge = card.querySelector('[data-stock-badge]');
            const addBtn = card.querySelector('[data-add-btn]');

            if (badge) {
                badge.className = 'stock-pill ' + (stockNum <= 0 ? 'stock-out' : (stockNum <= 3 ? 'stock-low' : 'stock-ok'));
                if (stockNum <= 0) {
                    badge.innerHTML = `● <span>${t('outOfStock')}</span>`;
                } else if (stockNum <= 3) {
                    badge.innerHTML = `● <span>${t('lastUnits')}</span> ${stockNum} <span>${t('unitsWord')}</span>`;
                } else {
                    badge.innerHTML = `● <span>${t('inStock')}</span> (${stockNum})`;
                }
            }

            if (addBtn) {
                addBtn.disabled = stockNum <= 0;
            }
        }
        window.actualizarStockEnVista = actualizarStockEnVista;

        async function saludarUsuarioDesdeApi() {
            @auth
                const sessionFlag = `artesanos_welcomed_user_{{ Auth::id() }}`;
                if (sessionStorage.getItem(sessionFlag)) return;

                let nombreUsuario = AUTH_USER_NAME;
                try {
                    const resp = await fetch('/api/user', {
                        headers: { 'Accept': 'application/json' },
                        credentials: 'include'
                    });
                    if (resp.ok) {
                        const data = await resp.json();
                        if (data && data.name) nombreUsuario = data.name;
                    }
                } catch (e) {}

                const mensaje = armarBienvenidaTienda(nombreUsuario);
                sessionStorage.setItem(sessionFlag, '1');
                welcomeVoiceQueue = mensaje;

                hablarEnVozAlta(mensaje);

                setTimeout(() => {
                    if (welcomeVoiceQueue && window.speechSynthesis && !window.speechSynthesis.speaking) {
                        hablarEnVozAlta(welcomeVoiceQueue);
                    }
                }, 450);
            @endauth
        }

        function escucharEventosApiEnSocket() {
            if (!window.Echo || socketArtesanosBound) return;
            socketArtesanosBound = true;

            const canal = window.Echo.channel('artesanos');

            const handler = (e) => {
                const usuarioEvento = (e && (e.usuario || e.user_name))
                    ? (e.usuario || e.user_name)
                    : AUTH_USER_NAME;
                const msg = armarBienvenidaTienda(usuarioEvento);

                showToastLocal(msg, 'WebSocket en vivo');

                if (hasUserInteracted) {
                    hablarEnVozAlta(msg);
                } else {
                    welcomeVoiceQueue = msg;
                }
            };

            // Escucha ambas variantes por si el backend usa o no broadcastAs()
            canal.listen('ArtesanoActualizado', handler);
            canal.listen('.ArtesanoActualizado', handler);
        }

        function initSocketStatusIndicator() {
            const dot = document.getElementById('socketStatusDot');
            const label = document.getElementById('socketStatusLabel');

            if (!window.Echo) {
                if (label) label.textContent = 'WebSocket: Sin Echo';
                if (dot) dot.classList.remove('online');
                return;
            }

            escucharEventosApiEnSocket();

            const connector = window.Echo.connector;
            if (connector && connector.pusher && connector.pusher.connection) {
                const conn = connector.pusher.connection;
                const updateConnState = (state) => {
                    if (state === 'connected') {
                        if (dot) dot.classList.add('online');
                        if (label) label.textContent = 'WebSocket: En Vivo';
                        escucharEventosApiEnSocket();
                    } else {
                        if (dot) dot.classList.remove('online');
                        if (label) label.textContent = `WebSocket: ${state}`;
                    }
                };
                updateConnState(conn.state);
                conn.bind('state_change', (states) => updateConnState(states.current));
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadCart();
            resetCarouselAutoplay();
            setLanguage(currentLang, false);
            initSocketStatusIndicator();
            saludarUsuarioDesdeApi();
            escucharEventosApiEnSocket();
        });
    </script>
</body>
</html>
