<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Gestión Artesanos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; margin: 0; }
        .sidebar { min-height: 100vh; background: #2c3e50; color: white; width: 250px; position: fixed; padding-top: 20px; }
        .sidebar a { color: #bdc3c7; text-decoration: none; display: block; padding: 12px 20px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #34495e; color: white; border-left: 4px solid #1abc9c; }
        .sidebar h4 { padding-left: 20px; margin-bottom: 20px; color: #1abc9c; font-weight: bold; }
        .main-content { margin-left: 250px; padding: 20px; }
        .topbar { background: white; padding: 15px 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; }
        .card-menu { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); transition: 0.3s; color: white; }
        .card-menu:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.15); }
        .card-menu .icon { font-size: 3rem; opacity: 0.7; }
        .bg-verde { background: linear-gradient(135deg, #1abc9c, #16a085); }
        .bg-azul { background: linear-gradient(135deg, #3498db, #2980b9); }
        .bg-amarillo { background: linear-gradient(135deg, #f39c12, #e67e22); }
        .bg-rojo { background: linear-gradient(135deg, #e74c3c, #c0392b); }
        .bg-morado { background: linear-gradient(135deg, #9b59b6, #8e44ad); }
        .bg-info-custom { background: linear-gradient(135deg, #17a2b8, #138496); }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4><i class="bi bi-hammer"></i> Artesanos</h4>
        <a href="{{ route('dashboard') }}" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a>

        @if(Auth::user()->rol === 'administrador')
            <a href="{{ route('panel') }}"><i class="bi bi-grid"></i> Panel</a>
            <a href="{{ route('artesanos.index') }}"><i class="bi bi-people"></i> Artesanos</a>
            <a href="{{ route('productos.index') }}"><i class="bi bi-box"></i> Productos</a>
            <a href="{{ route('usuarios.index') }}"><i class="bi bi-person-badge"></i> Usuarios</a>
        @else
            <a href="{{ route('catalogo') }}"><i class="bi bi-shop"></i> Catálogo</a>
        @endif

        <hr class="text-secondary">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-start text-decoration-none w-100" style="color:#bdc3c7;">
                <i class="bi bi-box-arrow-left"></i> Cerrar Sesión
            </button>
        </form>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h4 class="mb-0 text-secondary">👋 Bienvenido, {{ Auth::user()->nombre }}</h4>
            <span class="badge bg-{{ Auth::user()->rol === 'administrador' ? 'danger' : 'secondary' }} fs-6">
                {{ ucfirst(Auth::user()->rol) }}
            </span>
        </div>

        <!-- MENSAJE VERDE DE ÉXITO AL REGISTRARSE -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-left: 5px solid #198754;">
                <i class="bi bi-check-circle-fill me-2"></i> <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- MENSAJES DE ERROR (ROJO) -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-left: 5px solid #dc3545;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Por favor corrige los siguientes errores:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h3>🎉 ¡Bienvenido al Sistema de Gestión de Artesanos!</h3>
                <p class="text-muted mb-0">
                    Has iniciado sesión como <strong>{{ Auth::user()->rol }}</strong>.
                    @if(Auth::user()->rol === 'administrador')
                        Desde aquí puedes administrar artesanos, productos y usuarios.
                    @else
                        Desde aquí puedes ver el catálogo de productos disponibles.
                    @endif
                </p>
            </div>
        </div>

        <h5 class="text-secondary fw-bold mb-3">🚀 Accesos Rápidos</h5>

        <div class="row g-3">
            @if(Auth::user()->rol === 'administrador')
                <div class="col-md-3">
                    <a href="{{ route('panel') }}" class="text-decoration-none">
                        <div class="card card-menu bg-verde p-4 text-center h-100">
                            <i class="bi bi-grid icon"></i>
                            <h5 class="mt-2 mb-0">Panel</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('artesanos.index') }}" class="text-decoration-none">
                        <div class="card card-menu bg-azul p-4 text-center h-100">
                            <i class="bi bi-people icon"></i>
                            <h5 class="mt-2 mb-0">Artesanos</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('productos.index') }}" class="text-decoration-none">
                        <div class="card card-menu bg-amarillo p-4 text-center h-100">
                            <i class="bi bi-box icon"></i>
                            <h5 class="mt-2 mb-0">Productos</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('usuarios.index') }}" class="text-decoration-none">
                        <div class="card card-menu bg-rojo p-4 text-center h-100">
                            <i class="bi bi-person-badge icon"></i>
                            <h5 class="mt-2 mb-0">Usuarios</h5>
                        </div>
                    </a>
                </div>
            @else
                <div class="col-md-6">
                    <a href="{{ route('catalogo') }}" class="text-decoration-none">
                        <div class="card card-menu bg-info-custom p-4 text-center h-100">
                            <i class="bi bi-shop icon"></i>
                            <h5 class="mt-2 mb-0">Ver Catálogo de Productos</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="card bg-morado p-4 text-center h-100 text-white">
                        <i class="bi bi-info-circle icon"></i>
                        <h5 class="mt-2 mb-0">Próximamente: Mis Pedidos</h5>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Script de Bootstrap para que funcione el botón de cerrar (la X) en las alertas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
