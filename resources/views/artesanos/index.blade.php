<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Artesanos | Gestión Artesanos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; margin: 0; }
        .sidebar { min-height: 100vh; background: #2c3e50; color: white; width: 250px; position: fixed; padding-top: 20px; }
        .sidebar a { color: #bdc3c7; text-decoration: none; display: block; padding: 12px 20px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #34495e; color: white; border-left: 4px solid #1abc9c; }
        .sidebar h4 { padding-left: 20px; margin-bottom: 20px; color: #1abc9c; font-weight: bold; }
        .main-content { margin-left: 250px; padding: 20px; }
        .topbar { background: white; padding: 15px 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4><i class="bi bi-hammer"></i> Artesanos</h4>
        <a href="{{ route('panel') }}"><i class="bi bi-speedometer2"></i> Panel</a>
        <a href="{{ route('artesanos.index') }}" class="active"><i class="bi bi-people"></i> Artesanos</a>
        <a href="{{ route('productos.index') }}"><i class="bi bi-box"></i> Productos</a>
        <a href="{{ route('usuarios.index') }}"><i class="bi bi-person-badge"></i> Usuarios</a>
        <hr class="text-secondary">
        <a href="{{ url('/') }}"><i class="bi bi-box-arrow-left"></i> Salir</a>
    </div>

    <div class="main-content">
        <div class="topbar d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-secondary">👥 Lista de Artesanos ({{ $artesanos->count() }})</h4>
            <a href="{{ route('artesanos.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Agregar Nuevo Artesano
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- BUSCADOR Y FILTRO -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form action="{{ route('artesanos.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label fw-bold"><i class="bi bi-search"></i> Buscar</label>
                        <input type="text" name="buscar" class="form-control" placeholder="Nombre, apellido o DNI..." value="{{ request('buscar') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold"><i class="bi bi-funnel"></i> Filtrar por Especialidad</label>
                        <select name="especialidad" class="form-select">
                            <option value="">Todas las especialidades</option>
                            @foreach($especialidades as $esp)
                                <option value="{{ $esp }}" {{ request('especialidad') == $esp ? 'selected' : '' }}>
                                    {{ $esp }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                        <a href="{{ route('artesanos.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- TABLA -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                @if($artesanos->count() > 0)
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>DNI</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Teléfono</th>
                                <th>Especialidad</th>
                                <th>Dirección</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($artesanos as $artesano)
                                <tr>
                                    <td>{{ $artesano->id }}</td>
                                    <td>{{ $artesano->dni }}</td>
                                    <td>{{ $artesano->nombres }}</td>
                                    <td>{{ $artesano->apellidos }}</td>
                                    <td>{{ $artesano->telefono }}</td>
                                    <td><span class="badge bg-info">{{ $artesano->especialidad }}</span></td>
                                    <td>{{ $artesano->direccion }}</td>
                                    <td>
                                        <a href="{{ route('artesanos.edit', $artesano->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('artesanos.destroy', $artesano->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este artesano?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning text-center">
                        <i class="bi bi-search"></i> No se encontraron artesanos.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
