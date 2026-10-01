<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel | Gestión Artesanos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; margin: 0; }
        .sidebar { min-height: 100vh; background: #2c3e50; color: white; width: 250px; position: fixed; padding-top: 20px; }
        .sidebar a { color: #bdc3c7; text-decoration: none; display: block; padding: 12px 20px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #34495e; color: white; border-left: 4px solid #1abc9c; }
        .sidebar h4 { padding-left: 20px; margin-bottom: 20px; color: #1abc9c; font-weight: bold; }
        .main-content { margin-left: 250px; padding: 20px; }
        .topbar { background: white; padding: 15px 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px; border-radius: 8px; }
        .stat-card { border: none; color: white; border-radius: 10px; padding: 20px; }
        .bg-verde { background: #1abc9c; }
        .bg-azul { background: #3498db; }
        .bg-amarillo { background: #f1c40f; }
        .stat-card .icon { font-size: 3rem; opacity: 0.6; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4><i class="bi bi-hammer"></i> Artesanos</h4>
        <a href="{{ route('panel') }}" class="active"><i class="bi bi-speedometer2"></i> Panel</a>
        <a href="{{ route('artesanos.index') }}"><i class="bi bi-people"></i> Artesanos</a>
        <a href="{{ route('productos.index') }}"><i class="bi bi-box"></i> Productos</a>
        <a href="{{ route('usuarios.index') }}"><i class="bi bi-person-badge"></i> Usuarios</a>
        <hr class="text-secondary">
        <a href="{{ url('/') }}"><i class="bi bi-box-arrow-left"></i> Salir</a>
    </div>
    <div class="main-content">
        <div class="topbar">
            <h4 class="mb-0 text-secondary">📊 Panel de Administración</h4>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="stat-card bg-verde">
                    <div class="d-flex justify-content-between align-items-center">
                        <div><h6>ARTESANOS</h6><h2>{{ $totalArtesanos }}</h2></div>
                        <i class="bi bi-people icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card bg-azul">
                    <div class="d-flex justify-content-between align-items-center">
                        <div><h6>PRODUCTOS</h6><h2>{{ $totalProductos }}</h2></div>
                        <i class="bi bi-box icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card bg-amarillo">
                    <div class="d-flex justify-content-between align-items-center">
                        <div><h6>USUARIOS</h6><h2>{{ $totalUsuarios }}</h2></div>
                        <i class="bi bi-person-badge icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
