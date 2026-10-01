<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto | Gestión Artesanos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; margin: 0; }
        .sidebar { min-height: 100vh; background: #2c3e50; color: white; width: 250px; position: fixed; padding-top: 20px; }
        .sidebar a { color: #bdc3c7; text-decoration: none; display: block; padding: 12px 20px; }
        .sidebar a:hover, .sidebar a.active { background: #34495e; color: white; border-left: 4px solid #1abc9c; }
        .sidebar h4 { padding-left: 20px; margin-bottom: 20px; color: #1abc9c; font-weight: bold; }
        .main-content { margin-left: 250px; padding: 20px; }
        .topbar { background: white; padding: 15px 20px; margin-bottom: 20px; border-radius: 8px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4><i class="bi bi-hammer"></i> Artesanos</h4>
        <a href="{{ route('panel') }}"><i class="bi bi-speedometer2"></i> Panel</a>
        <a href="{{ route('artesanos.index') }}"><i class="bi bi-people"></i> Artesanos</a>
        <a href="{{ route('productos.index') }}" class="active"><i class="bi bi-box"></i> Productos</a>
        <a href="{{ route('usuarios.index') }}"><i class="bi bi-person-badge"></i> Usuarios</a>
        <hr class="text-secondary">
        <a href="{{ url('/') }}"><i class="bi bi-box-arrow-left"></i> Salir</a>
    </div>

    <div class="main-content">
        <div class="topbar d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-secondary">✏️ Editar Producto</h4>
            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Artesano *</label>
                            <select name="artesano_id" class="form-select" required>
                                @foreach($artesanos as $artesano)
                                    <option value="{{ $artesano->id }}" {{ $producto->artesano_id == $artesano->id ? 'selected' : '' }}>
                                        {{ $artesano->nombres }} {{ $artesano->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nombre *</label>
                            <input type="text" name="nombre" class="form-control" required value="{{ $producto->nombre }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3">{{ $producto->descripcion }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Precio (S/) *</label>
                            <input type="number" name="precio" class="form-control" step="0.01" min="0" required value="{{ $producto->precio }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Categoría *</label>
                            <input type="text" name="categoria" class="form-control" required value="{{ $producto->categoria }}">
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save"></i> Actualizar
                        </button>
                        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
